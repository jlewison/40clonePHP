<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `question` (
	`questionid` int(11) NOT NULL auto_increment,
	`langid` int(1) NOT NULL,
	`question_text` text NOT NULL,
	`userid` int(10) NOT NULL,
	`categoryid` int(5) NOT NULL,
	`title` varchar(50) NULL,
	`date1` bigint(15) NOT NULL,
	`status` enum('Active','Inactive') NOT NULL,
	`abuse` enum('Yes','No') NOT NULL,
	`rate` int(1) NOT NULL, PRIMARY KEY  (`questionid`));
*/

/**
* <b>question</b> class with integd CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=question&attributeList=array+%28%0A++0+%3D%3E+%27langid%27%2C%0A++1+%3D%3E+%27question_text%27%2C%0A++2+%3D%3E+%27userid%27%2C%0A++3+%3D%3E+%27categoryid%27%2C%0A++4+%3D%3E+%27date1%27%2C%0A++5+%3D%3E+%27status%27%2C%0A++6+%3D%3E+%27abuse%27%2C%0A++7+%3D%3E+%27rate%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27int%281%29%27%2C%0A++1+%3D%3E+%27text%27%2C%0A++2+%3D%3E+%27int%2810%29%27%2C%0A++3+%3D%3E+%27int%285%29%27%2C%0A++4+%3D%3E+%27bigint%2815%29%27%2C%0A++5+%3D%3E+%27enum%28%5C%5C%5C%27Active%5C%5C%5C%27%2C%5C%5C%5C%27Inactive%5C%5C%5C%27%29%27%2C%0A++6+%3D%3E+%27enum%28%5C%5C%5C%27Yes%5C%5C%5C%27%2C%5C%5C%5C%27No%5C%5C%5C%27%29%27%2C%0A++7+%3D%3E+%27varchar%2815%29%27%2C%0A%29
*/
class question
{
	var $questionId = '';

	/**
	 * @var int(1)
	 */
	var $langid;
	
	/**
	 * @var text
	 */
	var $question_text;
	
	/**
	 * @var int(10)
	 */
	var $userid;
	
	/**
	 * @var int(5)
	 */
	var $categoryid;
	
	/**
	 * @var varchar(50)
	 */	
	var $title;
	/**
	 * @var bigint(15)
	 */
	var $date1;
	
	/**
	 * @var enum('Active','Inactive')
	 */
	var $status;
	
	/**
	 * @var enum('Yes','No')
	 */
	var $abuse;
	
	/**
	 * @var varchar(15)
	 */
	var $rate;
	
	var $pog_attribute_type = array(
		"questionId" => array("NUMERIC", "INT"),
		"langid" => array("NUMERIC", "INT", "1"),
		"question_text" => array("TEXT", "TEXT"),
		"userid" => array("NUMERIC", "INT", "10"),
		"categoryid" => array("NUMERIC", "INT", "5"),
		"title" => array("TEXT", "VARCHAR", "50"),
		"date1" => array("NUMERIC", "BIGINT", "15"),
		"status" => array("SET", "ENUM", "'Active','Inactive'"),
		"abuse" => array("SET", "ENUM", "'Yes','No'"),
		"rate" => array("NUMERIC", "INT", "1"),
		);
	var $pog_query;
	
	function question($langid='', $question_text='', $userid='', $categoryid='',$title='', $date1='', $status='', $abuse='', $rate='')
	{
		$this->langid = $langid;
		$this->question_text = $question_text;
		$this->userid = $userid;
		$this->categoryid = $categoryid;
		$this->title = $title;
		$this->date1 = $date1;
		$this->status = $status;
		$this->abuse = $abuse;
		$this->rate = $rate;
	}
	
	
	/**
	* Gets object from database
	* @param integer $questionId 
	* @return object $question
	*/
	function Get($questionId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `question` where `questionid`='".intval($questionId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->questionId = $Database->Result(0, "questionid");
		$this->langid = ($Database->Result(0, "langid"));
		$this->question_text = ($Database->Result(0, "question_text"));
		$this->userid = ($Database->Result(0, "userid"));
		$this->categoryid = ($Database->Result(0, "categoryid"));
		$this->title = ($Database->Result(0, "title"));
		$this->date1 = ($Database->Result(0, "date1"));
		$this->status = $Database->Result(0, "status");
		$this->abuse = $Database->Result(0, "abuse");
		$this->rate = ($Database->Result(0, "rate"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $questionList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')

	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$questionList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select questionid from `question` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]) && $this->pog_attribute_type[$fcv_array[$i][0]][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]][0] != 'SET')
					{
						$this->pog_query .= "`".strtolower($fcv_array[$i][0])."` ".$fcv_array[$i][1]." '".($fcv_array[$i][2])."'";
					}
					else
					{
						$this->pog_query .= "`".strtolower($fcv_array[$i][0])."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			$this->pog_query .= " order by questionid DESC $sqlLimit";

			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$question = new $thisObjectName();
				$question->Get($Database->Result($i, "questionid"));
				$questionList[] = $question;
			}

			if ($sortBy != '')
			{
				$f = '';
				$question = new question();
				if (isset($question->pog_attribute_type[$sortBy]) && ($question->pog_attribute_type[$sortBy][0] == "NUMERIC" || $question->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $question1->'.$sortBy.' > $question2->'.$sortBy.';';
				}
				else if (isset($question->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($question1->'.$sortBy.'), strtolower($question2->'.$sortBy.'));';
				}
				usort($questionList, create_function('$question1, $question2', $f));
				if (!$ascending)
				{
					$questionList = array_reverse($questionList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($questionList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($questionList, 0, $limit);
					}
				}
			}
			return $questionList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $questionId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `questionid` from `question` where `questionid`='".$this->questionId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if($this->question_text==''){
		$this->pog_query = "update `question` set 
			`abuse`='".$this->abuse."'
			 where `questionid`='".$this->questionId."'";
		}
		else if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `question` set 
			`langid`='".($this->langid)."', 
			`question_text`='".($this->question_text)."', 
			`userid`='".($this->userid)."', 
			`categoryid`='".($this->categoryid)."', 
			`title`='".($this->title)."', 
			`date1`='".($this->date1)."', 
			`status`='".$this->status."', 
			`abuse`='".$this->abuse."', 
			`rate`='".($this->rate)."' where `questionid`='".$this->questionId."'";
		}
		else
		{
			$this->pog_query = "insert into `question` (`langid`, `question_text`, `userid`, `categoryid`,`title` ,`date1`, `status`, `abuse`, `rate` ) values (
			'".($this->langid)."', 
			'".($this->question_text)."', 
			'".($this->userid)."', 
			'".($this->categoryid)."', 
			'".($this->title)."', 
			'".($this->date1)."', 
			'".$this->status."', 
			'".$this->abuse."', 
			'".($this->rate)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->questionId == "")
		{
			$this->questionId = $Database->GetCurrentId();
		}
		return $this->questionId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $questionId
	*/
	function SaveNew()
	{
		$this->questionId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `question` where `questionid`='".$this->questionId."'";

		return $Database->Query($this->pog_query);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$Database = new DatabaseConnection();
			$pog_query = "delete from `question` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]) && $this->pog_attribute_type[$fcv_array[$i][0]][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return $Database->Query($pog_query);
		}
	}
}
?>