<?php


class processData {
    
    
    private static $processData = null;
    
    private static $guiText = [];
    
    
    
    public static function setProcessData( $val ) {  processData::$processData = $val; }
    
    public static function getProcessData() { return processData::$processData; }
    
    
    public static function setGuiText( $val ) { processData::$guiText = $val; }
    
    public static function getGuiText() { return processData::$guiText; }
    
    
    
    
    
}
