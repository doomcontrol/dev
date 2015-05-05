<?php

$sqlList = [];

$db1 = 'projectcontrol_' . \sub_url();
$db2 = 'projectcontrol';



$sqlList['process']['classMetaData']                = 'models\entities\Core\Process';
$sqlList['process']['table']                        = 'process';
$sqlList['process']['db']                           =  $db2;
$sqlList['process']['root']                         =  true;


$sqlList['owner']['classMetaData']                  = 'models\entities\Core\Owner';
$sqlList['owner']['table']                          = 'owner';
$sqlList['owner']['db']                             =  $db2;
$sqlList['owner']['root']                           =  true;


$sqlList['packages']['classMetaData']               = 'models\entities\Core\Package';
$sqlList['packages']['table']                       = 'packages';
$sqlList['packages']['db']                          =  $db2;
$sqlList['packages']['root']                        =  true;


$sqlList['language']['classMetaData']               = 'models\entities\Core\Language';
$sqlList['language']['table']                       = 'language';
$sqlList['language']['db']                          =  $db2;
$sqlList['language']['root']                        =  true;


$sqlList['guitext']['classMetaData']                = 'models\entities\Core\GuiText';
$sqlList['guitext']['table']                        = 'guiText';
$sqlList['guitext']['db']                           =  $db2;
$sqlList['guitext']['root']                         =  true;


$sqlList['modules']['classMetaData']                = 'models\entities\Core\Module';
$sqlList['modules']['table']                        = 'modules';
$sqlList['modules']['db']                           =  $db2;
$sqlList['modules']['root']                         =  true;




$sqlList['users']['classMetaData']                  = 'models\entities\Users';
$sqlList['users']['table']                          = 'users';
$sqlList['users']['db']                             =  $db1;
$sqlList['users']['root']                           =  false;


$sqlList['usergroupdefinition']['classMetaData']    = 'models\entities\User\UserGroupDefinition';
$sqlList['usergroupdefinition']['table']            = 'user_group_definition';
$sqlList['usergroupdefinition']['db']               =  $db1;
$sqlList['usergroupdefinition']['root']             =  false;

/*
$sqlList['usergroup']['classMetaData']              = 'models\entities\User\UserGroup';
$sqlList['usergroup']['table']                      = 'user_group';
$sqlList['usergroup']['db']                         =  $db1;
$sqlList['usergroup']['root']                       =  false;
*/

$sqlList['usersmessage']['classMetaData']           = 'models\entities\UsersMessage';
$sqlList['usersmessage']['table']                   = 'usersMessage';
$sqlList['usersmessage']['db']                      =  $db1;
$sqlList['usersmessage']['root']                    =  false;


$sqlList['usersmessagemarkreaded']['classMetaData'] = 'models\entities\UserMessage\MarkReaded';
$sqlList['usersmessagemarkreaded']['table']         = 'usersMessageMarkReaded';
$sqlList['usersmessagemarkreaded']['db']            =  $db1;
$sqlList['usersmessagemarkreaded']['root']          =  false;


$sqlList['privilegies']['classMetaData']            = 'models\entities\Privilegies';
$sqlList['privilegies']['table']                    = 'privilegies';
$sqlList['privilegies']['db']                       =  $db1;
$sqlList['privilegies']['root']                     =  false;

/*
$sqlList['privilegyModules']['classMetaData']       = 'models\entities\Privilegy\Module';
$sqlList['privilegyModules']['table']               = 'privilegyModules';
$sqlList['privilegyModules']['db']                  =  $db1;
$sqlList['privilegyModules']['root']                =  false;
*/




