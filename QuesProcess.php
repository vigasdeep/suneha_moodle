<?php

require_once 'Db.php';
require_once 'UserDetail.php';


class Ques_Processor
{	
	function createColumn($quizId, $quizTable, $quesAnsTable)
    {
		$selectQuizQues = mysql_fetch_array(mysql_query("SELECT `questions` from $quizTable WHERE id = $quizId"));
		$fetchQuizQues = $selectQuizQues['questions'];
		$quesExplode = explode(",", $fetchQuizQues);
		foreach($quesExplode as $quesid)
		{
			$selectAnsId = mysql_fetch_array(mysql_query("SELECT `id` from $quesAnsTable WHERE question= $quesid"));
            $fetchAnsId[] = $selectAnsId['id'];
		}
		return $fetchAnsId;
		
	}

}
?>
