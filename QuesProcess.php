<?php

require_once 'Db.php';
require_once 'UserDetail.php';

class Ques_Processor
{	
	function createColumn($quizId, $quizTable, $quesAnsTable, $userId, $userAns,$quesUsageTable, $quesAttemptTable, $quesTable, $quesAtmptStpTable, $quizAttemptTable, $quizGradeTable )
    {
		$selectQuizQues = mysql_fetch_array(mysql_query("SELECT `questions` from $quizTable WHERE id = $quizId"));
		$fetchQuizQues = $selectQuizQues['questions'];
		$quesExplode = explode(",", $fetchQuizQues);
		$ansExplode = explode(" ", $userAns);
		$ansCounter=0;
		$quesAnsRow=0;
		$InsrtUsageId = mysql_query("INSERT INTO $quesUsageTable(contextid, component, preferredbehaviour)
         VALUES ('31','mod_quiz','deferredfeedback')");
        $slctUsageId = mysql_fetch_array(mysql_query("SELECT id from $quesUsageTable Order By id DESC LIMIT 1"));
        $ftchUsageId = $slctUsageId['id'];
        $slot = 0;
        $layout= "1";
        $layoutCounter = 1;
		foreach($quesExplode as $val)
        {
            if($val == 0)    
                continue;
			unset($ansRowId);
			$fetchQuesDetail = mysql_query("SELECT * from $quesAnsTable WHERE question=$val");
			while($selectQuesDetail = mysql_fetch_array($fetchQuesDetail))
			{
				$ansRowId = $selectQuesDetail['id'];
				$quesAnsRow++;
				$ansRowFraction = $selectQuesDetail['fraction'];
				if($selectQuesDetail['fraction'] == "1.0000000")
				{
					break;
				}
			}
			$corctAnsId=$ansExplode[$ansCounter];
			switch($corctAnsId){
				case "a":
				$i = 1;
				break;
				case "b":
				$i = 2;
				break;
				case "c":
				$i = 3;
				break;
				case "d":
				$i = 4;
				break;
			}
			$riteAns = "Some answer";
				$fetchQuesSumry = $selectQuesSumry['questiontext'];
			$selectQuesSumry = mysql_fetch_array(mysql_query("SELECT 'questiontext' from $quesTable WHERE id=$val"));
				$fetchQuesSumry = $selectQuesSumry['questiontext'];
			
            if($quesAnsRow == $i) {
                $slot++;
                echo "RIGHT RIGHT >> <br>";
                $quesAttemptQuery = "INSERT INTO $quesAttemptTable(questionusageid, slot, behaviour, questionid, variant, maxmark, minfraction,flagged,questionsummary, rightanswer, responsesummary,timemodified)
                         VALUES ('$ftchUsageId', '$slot','deferredfeedback', '$val','1','1.0000000','0.0000000','0','$fetchQuesSumry','$riteAns','ef','1376133652')";
                $quesAttmptRow = mysql_query($quesAttemptQuery);
                echo "<br><br>.".$quesAttemptQuery."<br><br>";
                if (!$quesAttmptRow) {
                        die('Invalid query: ' . mysql_error());
                }

				$slctAttmptId = mysql_fetch_array(mysql_query("SELECT id from $quesAttemptTable Order By id DESC LIMIT 1"));
				$ftchAttmptId = $slctAttmptId['id'];  
				$addAttmptStp = mysql_query("INSERT INTO $quesAtmptStpTable(`questionattemptid`, `sequencenumber`, `state`, `fraction`, `timecreated`, `userid`) VALUES ('$ftchAttmptId', 2, 'gradedright', '1.0000000', '1376133652' ,'$userId')");
				$m++;
				$calmark = $m;
				$calgrade = $calmark / 10;
				$percentage = $calgrade * 100;
				}
            else {
                $slot++;
                echo "WRONG WRONG >> <br>";
				$quesAttmptRow = mysql_query("INSERT INTO $quesAttemptTable(questionusageid, slot, behaviour, questionid, variant, maxmark, minfraction,flagged,questionsummary, rightanswer, responsesummary,timemodified)
         VALUES ('$ftchUsageId', '$slot','deferredfeedback', '$val','1','1.0000000','0.0000000','0','$fetchQuesSumry','$riteAns','ef','1376133652')");
				$slctAttmptId = mysql_fetch_array(mysql_query("SELECT id from $quesAttemptTable Order By id DESC LIMIT 1"));
				$ftchAttmptId = $slctAttmptId['id']; 
				$addAttmptStp = mysql_query("INSERT INTO `$quesAtmptStpTable` (`questionattemptid`, `sequencenumber`, `state`, `fraction`, `timecreated`,`userid`) VALUES
('$ftchAttmptId', 2, 'gradedwrong', '0.0000000', '1376133652', '$userId')");
				}
				$quesAnsRow=0;
                $ansCounter++;	
                $layoutCounter++;
                $layout .= ",".$layoutCounter;
        }
        $layout = substr($layout, 0, -2);
		$insrtQuizAtmpt = mysql_query("INSERT INTO `$quizAttemptTable` ( `quiz`, `userid`, `attempt`, `uniqueid`, `layout`, `currentpage`, `preview`, `state`, `timestart`, `timefinish`, `timemodified`, `timecheckstate`, `sumgrades`, `needsupgradetonewqe`) VALUES
( $quizId, $userId, 1, $ftchUsageId, '$layout', 1, 0, 'finished', 1375792791, 1375792820, 1375792820, NULL, $percentage, 0)");
$insrtgrade = mysql_query("INSERT INTO `$quizGradeTable`(quiz,userid,grade,timemodified) VALUES ($quizId,$userId,$percentage, 1376133652)");
echo "INSERT INTO `$quizGradeTable`(quiz,userid,grade,timemodified) VALUES ($quizId,$userId,$percentage, 1376133652)";
}
}
?>
