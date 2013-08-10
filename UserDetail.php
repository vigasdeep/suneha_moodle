<?php

/**
* This file create instance of class 
* Call functions of class
* Display Output
*        
* @author      Navdeep Bagga
* @authorEmail admin@navdeepbagga.com
* @category    Function call
* @copyright   Copyright (c) June-July Testing and Consultancy Cell
* @license     General Public License
* @version     $Id:UserDetail.php 2012-01-08 $
*/

//Include database and class file
require_once 'Db.php';
require_once 'QuesProcess.php';

//Create object of class	
$Ques_Process_Obj = new Ques_Processor();

//static data			
$userId='9';
$quizId='2';
$userAns='a a a';

//Calling functions
//$userString='4-a b c a';	//mobile text
//list($quizId, $userAns) = explode("-",$userString);	//explosion of quizId & userAns 


///Calling functions
$surveyId      = $Ques_Process_Obj -> createColumn($quizId, $quizTable, $quesAnsTable, $userId, $userAns, $quesUsageTable,$quesAttemptTable,$quesTable, $quesAtmptStpTable, $quizAttemptTable, $quizGradeTable );
?>
