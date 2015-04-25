<?php

$sqlList = [];

$db1 = 'projectcontrol_' . \sub_url();
$db2 = 'projectcontrol';

$sqlList['users']['classMetaData']                  = 'models\entities\Users';
$sqlList['users']['table']                          = 'users';
$sqlList['users']['db']                             =  $db1;


$sqlList['usergroupdefinition']['classMetaData']    = 'models\entities\User\UserGroupDefinition';
$sqlList['usergroupdefinition']['table']            = 'user_group_definition';
$sqlList['usergroupdefinition']['db']               =  $db1;


$sqlList['usergroup']['classMetaData']              = 'models\entities\User\UserGroup';
$sqlList['usergroup']['table']                      = 'user_group';
$sqlList['usergroup']['db']                         =  $db1;


$sqlList['usersmessage']['classMetaData']           = 'models\entities\UsersMessage';
$sqlList['usersmessage']['table']                   = 'usersMessage';
$sqlList['usersmessage']['db']                      =  $db1;

$sqlList['usersmessagemarkreaded']['classMetaData'] = 'models\entities\UserMessage\MarkReaded';
$sqlList['usersmessagemarkreaded']['table']         = 'usersMessageMarkReaded';
$sqlList['usersmessagemarkreaded']['db']            =  $db1;


$sqlList['process']['classMetaData']                = 'models\entities\Core\Process';
$sqlList['process']['table']                        = 'process';
$sqlList['process']['db']                           =  $db2;


$sqlList['owner']['classMetaData']                  = 'models\entities\Core\Owner';
$sqlList['owner']['table']                          = 'owner';
$sqlList['owner']['db']                             =  $db2;


$sqlList['packages']['classMetaData']               = 'models\entities\Core\Package';
$sqlList['packages']['table']                       = 'packages';
$sqlList['packages']['db']                          =  $db2;


$sqlList['language']['classMetaData']               = 'models\entities\Core\Language';
$sqlList['language']['table']                       = 'language';
$sqlList['language']['db']                          =  $db2;


$sqlList['guitext']['classMetaData']                = 'models\entities\Core\GuiText';
$sqlList['guitext']['table']                        = 'guiText';
$sqlList['guitext']['db']                           =  $db2;

