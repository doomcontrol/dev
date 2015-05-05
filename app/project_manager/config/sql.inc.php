<?php

$sql = [];

$sub = \sub_url();

$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Super_Project_Manager',1)";
$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Project_Manager',1)";
$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Team_Member',1)";
$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Company_Member',1)";
$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Visitor_Member',1)";





$sql['privilegies'][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('full',1,1,1,1,1,1,1)";
$sql['privilegies'][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('internal',1,1,1,1,1,1,0)";
$sql['privilegies'][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('team',1,1,1,1,1,0,0)";
$sql['privilegies'][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('starter',1,1,0,0,1,0,0)";
$sql['privilegies'][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('client',1,1,0,0,0,0,0)";
$sql['privilegies'][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('guest',1,0,0,0,0,0,0)";
$sql['privilegies'][] = "INSERT INTO `projectcontrol_$sub`.`privilegies` (`name`,`read`,`write`,`edit`,`delete`,`upload`,`viewInternal`,`manageAll`) VALUES ('none',0,0,0,0,0,0,0)";
