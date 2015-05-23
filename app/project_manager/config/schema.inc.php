<?php

$sqlList = [];

$db1 = 'projectcontrol_' . \sub_url();
$db2 = 'projectcontrol';

$sqlList['revision']['classMetaData']                = 'models\entities\Core\Revision';
$sqlList['revision']['table']                        = 'revision';
$sqlList['revision']['db']                           =  $db2;
$sqlList['revision']['root']                         =  true;


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


$sqlList['country']['classMetaData']                = 'models\entities\Core\Country';
$sqlList['country']['table']                        = 'country';
$sqlList['country']['db']                           =  $db2;
$sqlList['country']['root']                         =  true;


/* CLIENTS TABLE */

$sqlList['revision_client']['classMetaData']        = 'models\entities\Revision';
$sqlList['revision_client']['table']                = 'revision_client';
$sqlList['revision_client']['db']                   =  $db1;
$sqlList['revision_client']['root']                 =  false;


$sqlList['users']['classMetaData']                  = 'models\entities\Users';
$sqlList['users']['table']                          = 'users';
$sqlList['users']['db']                             =  $db1;
$sqlList['users']['root']                           =  false;


$sqlList['usergroupdefinition']['classMetaData']    = 'models\entities\User\UserGroupDefinition';
$sqlList['usergroupdefinition']['table']            = 'user_group_definition';
$sqlList['usergroupdefinition']['db']               =  $db1;
$sqlList['usergroupdefinition']['root']             =  false;


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

$sqlList['company']['classMetaData']                = 'models\entities\Company';
$sqlList['company']['table']                        = 'company';
$sqlList['company']['db']                           =  $db1;
$sqlList['company']['root']                         =  false;





