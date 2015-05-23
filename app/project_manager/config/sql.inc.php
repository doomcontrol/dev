<?php

$sql = [];

$sub = \sub_url();

$sql['user_group_definition'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`,`icon`) VALUES ('Super_Project_Manager',1,'main/group/1.jpg')";
$sql['user_group_definition'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`,`icon`) VALUES ('Project_Manager',1,'main/group/2.jpg')";
$sql['user_group_definition'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`,`icon`) VALUES ('Team_Member',1,'main/group/3.jpg')";
$sql['user_group_definition'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`,`icon`) VALUES ('Company_Member',1,'main/group/4.jpg')";
$sql['user_group_definition'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`,`icon`) VALUES ('Visitor_Member',1,'main/group/5.jpg')";




$sql['privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('full',1,1,1,1,1,1,1)";
$sql['privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('internal',1,1,1,1,1,1,0)";
$sql['privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('team',1,1,1,1,1,0,0)";
$sql['privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('starter',1,1,0,0,1,0,0)";
$sql['privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('client',1,1,0,0,0,0,0)";
$sql['privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('guest',1,0,0,0,0,0,0)";
$sql['privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('none',0,0,0,0,0,0,0)";




$sql['user_group_definition_privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_privilegies` (`groupDefinitionId`,`privilegyId`) VALUES (1,1)";
$sql['user_group_definition_privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_privilegies` (`groupDefinitionId`,`privilegyId`) VALUES (2,2)";
$sql['user_group_definition_privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_privilegies` (`groupDefinitionId`,`privilegyId`) VALUES (3,3)";
$sql['user_group_definition_privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_privilegies` (`groupDefinitionId`,`privilegyId`) VALUES (4,5)";
$sql['user_group_definition_privilegies'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_privilegies` (`groupDefinitionId`,`privilegyId`) VALUES (5,6)";




$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (1,1)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (1,2)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (1,3)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (1,4)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (1,5)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (2,1)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (2,2)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (2,3)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (2,4)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (2,5)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (3,1)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (3,2)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (3,3)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (3,4)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (3,5)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (4,4)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (4,5)";
$sql['user_group_definition_modules'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (5,4)";

$sql['user_group_definition_modules'][4][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (1,6)";
$sql['user_group_definition_modules'][4][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition_modules` (`groupDefinitionId`,`moduleId`) VALUES (2,6)";





