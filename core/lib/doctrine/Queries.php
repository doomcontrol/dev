<?php namespace lib\doctrine;


class Queries {
    
    private $core;
    
    private $newPosition;
    
    public function __construct() {
        global $core;
        $this->core = $core;
    }
    
    
    public function Sort($entity, $itemID, $prevItemID, $table){

        $newPosition = 0;
        
        $model = $this->core->em->getRepository( $entity );
        
        $item = $this->core->em->getReference( $entity , $itemID);  
        
        if( ! $item ) return;
        
        if($prevItemID)
            $prevItem = $this->core->em->getReference( $entity , $prevItemID );
        else 
            $prevItem = null;
      
        
        if( ! $prevItem) 
        $newPosition = 0; else $newPosition = $prevItem->getPosition();
        
        $oldPosition = $item->getPosition();
        
        $this->detachPosition( $item );

        $oldPosition < $newPosition ?  
                
            $this->sortUp( $oldPosition, $newPosition, $table ) 
                : 
            $this->sortDown( $oldPosition, $newPosition, $table );
        
        $this->AttachPosition($item);
        
        return $item;
    }
    
    private function detachPosition($item){
        $item->setPosition(0);
        $this->core->em->persist($item);
        $this->core->em->flush();
    }
    
    public function AttachPosition($item){
        $item->setPosition($this->newPosition);
        $this->core->em->persist($item);
        $this->core->em->flush();
    }
    
    public function sortUp($oldPosition, $newPosition, $table){
       
        if($oldPosition < 2) $oldPosition = 2;

        
        if($newPosition == $oldPosition){
            $oldPosition++;
            if($newPosition < 1) $newPosition = 1;
        }
        
        $strSql = "UPDATE $table SET position = position - 1 WHERE position <= $newPosition AND position >= $oldPosition";
        
        \doctrine_sql( $strSql );
        
        $this->newPosition = $newPosition;
        
    }
    
    public function sortDown($oldPosition, $newPosition, $table){
        
        if($newPosition == $oldPosition){
            $newPosition--;
            if($newPosition < 1) $newPosition = 1;
            
            if($newPosition == $oldPosition) $newPosition--;
            if($newPosition < 1) $newPosition = 1;
        }
        
        if($newPosition == $oldPosition){
            $newPosition--;
            if($newPosition < 1) $newPosition = 1;
            
            if($newPosition == $oldPosition) $newPosition--;
            if($newPosition < 1) $newPosition = 1;
        }
        
        
        
        $strSql = "UPDATE $table SET position = position + 1 WHERE position >= ".($newPosition+1)." AND position <= $oldPosition";
        
        \doctrine_sql( $strSql );
        
        $this->newPosition = $newPosition+1;
        
    }
    
}