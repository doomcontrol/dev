<?php

$sql = [];

$sub = \sub_url();

$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Project_Manager',1)";
$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Team_Member',1)";
$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Company_Member',1)";
$sql['user_group_definition'][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`) VALUES ('Visitor_Member',1)";


