<?php

/**
* This file contains database information  
* Need of customized moodle database and title 
*        
* @author      Navdeep Bagga
* @authorEmail admin@navdeepbagga.com
* @category    database information
* @copyright   Copyright (c) August-September Testing and Consultancy Cell (http://www.navdeepbagga.com)
* @license     General Public License
* @version     $Id:Db.php 2013-09-08 $
*/

// Database information
$mdldatabase    = 'moodle';
$mdldbHost      = 'localhost';
$mdldbUser      = 'moodle';
$mdldbPass      = 'moodle';
$mdlconnection  = mysql_connect ($mdldbHost, $mdldbUser, $mdldbPass);
mysql_select_db ($mdldatabase, $mdlconnection);

//Moodle table prefix	
$prefixTable = 'm_';


//Tables
$quizTable         = $prefixTable . 'quiz';
$quizAttemptTable  = $prefixTable . 'quiz_attempts';
$quizGradeTable    = $prefixTable . 'quiz_grades';
$quesTable         = $prefixTable . 'question';
$quesAnsTable      = $prefixTable . 'question_answers';
$quesAttemptTable  = $prefixTable . 'question_attempts';
$quesUsageTable    = $prefixTable . 'question_usages';
$quesAtmptStpTable = $prefixTable . 'question_attempt_steps';
?>
