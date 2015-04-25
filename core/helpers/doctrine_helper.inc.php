<?php

use Doctrine\ORM\Query\ResultSetMapping;

if(!function_exists('doctrine_dump')){
    
    function doctrine_dump( $result ) {
        
        \Doctrine\Common\Util\Debug::dump( $result );

    }
    
}



if(! function_exists('doctrine_sql')){
    
    function doctrine_sql($sql, $params = array()){
        
            global $core;
            
            $stmt = $core->em->getConnection()->prepare($sql);
            
            $i = 0;
            
            foreach($params as $p){
                $i++;
                $stmt->setParameter($i, $p);
            }

            $stmt->execute();
        
    }
}


if(!function_exists('generate_hash')){
    
    function generate_hash(){
        
        $hashString = 'Project ' . time() . 'Control' . rand(0,1000) . 'Hash';
        
        $hash = hash('ripemd160', $hashString);
        
        return $hash;
        
    }
    
}