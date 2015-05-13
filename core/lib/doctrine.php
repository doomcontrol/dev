<?php namespace lib;

use \Doctrine\Common\ClassLoader,
    \Doctrine\ORM\Configuration,
    \Doctrine\ORM\EntityManager,
    \Doctrine\Common\Cache\ArrayCache,
    \Doctrine\DBAL\Logging\EchoSQLLogger;

class Doctrine extends \lib\doctrine\Queries {
    
    
    protected 
            $doctrineConfig, 
            $doctrineCache, 
            $doctrineDriverImpl;
    
    private 
            $config, 
            $sqlList,
            $sqlquery;
    
    public  $em, $em_root;
    
    public function __construct() {
        
        $this->register();
        
        parent::__construct();
        
    }
    
    
    
    public function register(){
        
        $config = []; 
         
        require_once APP . 'config/database.inc.php';
         
        $this->config = $config;
        
        $this->register_model('models');
        
        $this->register_proxi('proxies');
        
        $this->registerClassLoader();
        
        $this->register_configuration();
        
        $this->register_cache();
        
        $this->register_entities( APP . 'models/entities');
        
        $this->set_proxy('proxies');
        
        $this->register_connection( );
        
        $this->registerBeberlei();
        
        //TODO postaviti samo kod promene verzije da se ukljuci
        $this->loadSQL();
        
    }
    
    
    
    public function register_model( $models, $name = '' ){
        
        $entitiesClassLoader = new ClassLoader($name, APP.$models );
        $entitiesClassLoader->register();
        
    }
    
    
    
    public function register_proxi( $proxi ){
        $proxiesClassLoader = new ClassLoader('proxies', APP.'models/'.$proxi);
        $proxiesClassLoader->register();
        
        
        
    }
    
    
    public function registerClassLoader(){
        
       
        
        $classLoader = new \Doctrine\Common\ClassLoader('DoctrineExtensions', VENDOR . 'beberlei' . DIRECTORY_SEPARATOR . 'DoctrineExtensions' . DIRECTORY_SEPARATOR . 'src');
        $classLoader->register();
        
    }
    
    
    public function register_configuration(){
        
        $this->doctrineConfig = new Configuration;
    }
    
    
    
    public function register_cache(){
        
        $this->doctrineCache = new ArrayCache;
        $this->doctrineConfig->setMetadataCacheImpl( $this->doctrineCache );
        
    }
    
    
    
    public function register_entities( $entities ){
        
        $this->doctrineDriverImpl = $this->doctrineConfig->newDefaultAnnotationDriver( array($entities) );
        $this->doctrineConfig->setMetadataDriverImpl( $this->doctrineDriverImpl );
        $this->doctrineConfig->setQueryCacheImpl( $this->doctrineCache );
        
    }
    
    
    
    public function set_proxy($proxy){
        
        $this->doctrineConfig->setProxyDir( APP .'models/'.$proxy);
        $this->doctrineConfig->setProxyNamespace($proxy);
        
        $this->doctrineConfig->setAutoGenerateProxyClasses( ENVIRONMENT == "development" ? true : false );
        
    }
    
    
    
    public function register_connection( $connection = array()){
        
        
        $connectionOptions = array(
            'driver'        => $this->config['base']['driver'],
            'user'          => $this->config['base']['user'],
            'password'      => $this->config['base']['pass'],
            'host'          => $this->config['base']['host'],
            'dbname'        => $this->config['base']['database'],
            'charset'       => $this->config['base']['charset'],
            'driverOptions' => array(
                'charset'   => $this->config['base']['charset'],
            ),
        );
        
        
        
        $connectionOptions2 = array(
            'driver'        => $this->config['root']['driver'],
            'user'          => $this->config['root']['user'],
            'password'      => $this->config['root']['pass'],
            'host'          => $this->config['root']['host'],
            'dbname'        => $this->config['root']['database'],
            'charset'       => $this->config['root']['charset'],
            'driverOptions' => array(
                'charset'   => $this->config['root']['charset'],
            ),
        );
        
    
        
        global $core;
        
        $core->em = $this->em = EntityManager::create($connectionOptions, $this->doctrineConfig);
        
        $this->em_root = EntityManager::create($connectionOptions2, $this->doctrineConfig);
        
        
    }
    
    private function registerBeberlei(){
        
        $config = $this->em->getConfiguration();
        $config->addCustomStringFunction('RAND', 'DoctrineExtensions\Query\Mysql\Rand');
        
    }
    
    
    
    private function loadSQL(){
        
        $schemaPath =  APP . '/config/schema.inc.php';
        
        $sqlList = []; include_once $schemaPath;  $this->sqlList = $sqlList;
        
        $sqlPath =  APP . '/config/sql.inc.php';
        
        $sql = []; include_once $sqlPath;  $this->sql = $sql;
        
        
        $this->check_tables();
    }
    
    private $insertAll;
    private $numCurentRevision ;
    private $numClientRevision;
    
    
    /**
     * check_tables
     * ----------------------------------------
     * Check client revision number and if doesn not match do update or create sql schema and check revision sql strings with current revision and execute all older then current revision
     * 
     * @return type
     */
    private function check_tables(){

        $this->insertAll = false;
        $this->numCurentRevision = 0;
        $this->numClientRevision = 0;
        
        
        
        $sql    = "SHOW TABLES LIKE 'revision_client'";

        $stmt   = $this->em->getConnection()->prepare($sql);  $stmt->execute();
        
        $result = $stmt->fetchAll(); 
        
        $revisionModel = $this->em->getRepository('models\entities\Core\Revision');
        
        $curentRevision = $revisionModel->getRevision();

        if(! $curentRevision ) return;

        $this->numCurentRevision =  $curentRevision->getRevision();
        
        
        
        if(count($result)){

            

            $clientRevision = $revisionModel->getClientRevision();

            if(! $clientRevision ){
                $this->insertAll = true;
                $this->numClientRevision = 0;
               
            } else {
                $insertAll = false;
                $this->numClientRevision = $clientRevision->getRevision();
               
            }

            if($this->numClientRevision == $this->numCurentRevision && $this->insertAll == false) return;
        
        } else {
           
            $this->numClientRevision = 0;
        }
        
        
        foreach($this->sqlList as $key=>$table){

            if($table['root'] == false)
                $conn   = $this->em->getConnection();
            else 
                $conn   = $this->em_root->getConnection();
                
            $sql    = "SHOW TABLES LIKE '".$table['table']."'";

            $stmt   = $conn->prepare($sql);  $stmt->execute();

            try{ 
                $result = $stmt->fetchAll(); 
                
                if(count($result)){  $this->update_schema($table); } else {  $this->create_schema($table); }
                    
            } catch(\PDOException $e)  { die('nije proslo aut update'); }
        }
        
        $this->insert_Empty();
        
        $revisionModel->updateClientRevision($this->numCurentRevision);
    }
    
    
    
    
    
    private function create_schema($table){
        
        if($table['root'] == false){
                $tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
                $classes = array( $this->em->getClassMetadata($table['classMetaData']), );
        } else {
                $tool = new \Doctrine\ORM\Tools\SchemaTool($this->em_root);
                $classes = array( $this->em_root->getClassMetadata($table['classMetaData']), );
        }
        
        $key2 = ($table['table']);

        
        $tool->createSchema($classes);
            
    }
    
    
    
    private function update_schema($table){
        
        if($table['root'] == false){
                $tool       = new \Doctrine\ORM\Tools\SchemaTool( $this->em );
                $classes    = array( $this->em->getClassMetadata($table['classMetaData']), );
        } else {
                $tool       = new \Doctrine\ORM\Tools\SchemaTool( $this->em_root );
                $classes    = array( $this->em_root->getClassMetadata($table['classMetaData']), );
        }
        
        $sql                = $tool->getUpdateSchemaSql( $classes );
        $count              = count($sql);
        
        for($i=0; $i<$count; $i++){ if(substr($sql[$i], 0, 4) == 'DROP') unset($sql[$i]); }

        foreach($sql as $statement) { 
            
            if($table['root'] == false){ $this->em->getConnection()->exec( $statement );  } else { $this->em_root->getConnection()->exec( $statement );  }
            
        }
    }
    
    
    private function insert_Empty(){
        
        $forInsert = array();
        
        $checked = array();
        
        foreach($this->sql as $key => $sql)
                foreach($sql as $k=>$value)
                    foreach($value as $query) 
                        if($this->insertAll || $this->numClientRevision < $this->numCurentRevision)
                            if($k > $this->numClientRevision) \doctrine_sql ( $query );
                        
            
    }
    
    
}
