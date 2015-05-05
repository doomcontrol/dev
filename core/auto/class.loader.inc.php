<?php

if(!defined('VERSION')) die('No direct script access allowed!');

function ClassAutoloader( $namespace ){


   $listPath = array(
       CORE,
       APP,
       VENDOR,
       /*BEBERLEI*/
   );
   
   $stroPath     = ( str_replace('\\', DIRECTORY_SEPARATOR, $namespace) );
   $strPath     = strtolower( str_replace('\\', DIRECTORY_SEPARATOR, $namespace) );
   $strPath2    = ( str_replace('\\', DIRECTORY_SEPARATOR, $namespace) );
   $strPath3    = ucfirst( str_replace('\\', DIRECTORY_SEPARATOR, $namespace) );
   $strPath4    = ucwords( str_replace('\\', DIRECTORY_SEPARATOR, $namespace) );
   $strPath5    = strtoupper( str_replace('\\', DIRECTORY_SEPARATOR, $namespace) );
   
   foreach($listPath as $dir){ if(file_exists( $dir . $stroPath . ".php")){ include_once ($dir . $stroPath . ".php"); return;   }}
   foreach($listPath as $dir){ if(file_exists( $dir . $strPath . ".php")){ include_once ($dir . $strPath . ".php"); return;   }}
   foreach($listPath as $dir){ if(file_exists( $dir . $strPath2 . ".php")){ include_once ($dir . $strPath2 . ".php"); return; }}
   foreach($listPath as $dir){ if(file_exists( $dir . $strPath3 . ".php")){ include_once ($dir . $strPath3 . ".php"); return; }}
   foreach($listPath as $dir){ if(file_exists( $dir . $strPath4 . ".php")){ include_once ($dir . $strPath4 . ".php"); return; }}
   foreach($listPath as $dir){ if(file_exists( $dir . $strPath5 . ".php")){ include_once ($dir . $strPath5 . ".php"); return; }}
   
   
   if(ENVIRONMENT == 'production'){
        throw new Exception("Page not found. Please check url and try again.");
   } else {
       $errorTitle = "Class ($stroPath) not found";
       $errorMessage = "Try to find in:<em>".CORE."</em><em>".APP."</em><em>".VENDOR."</em>";
       
       \exception_message(1, $errorTitle, $errorMessage, __CLASS__, __FUNCTION__, __FILE__ );
   }

}

spl_autoload_register('ClassAutoloader');