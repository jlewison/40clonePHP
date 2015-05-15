<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `answer` (
	`answerid` int(11) NOT NULL auto_increment,
	`langid` int(1) NOT NULL,
	`answer_text` text NOT NULL,
	`questionid` int(10) NOT NULL,
	`userid` int(5) NOT NULL,
	`date1` bigint(15) NOT NULL,
	`rate` float(2,1) NOT NULL,
	`bestans` enum('Yes','No') NOT NULL,
	`extra1` varchar(15) NOT NULL, PRIMARY KEY  (`answerid`));
*/

/**
* <b>answer</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=answer&attributeList=array+%28%0A++0+%3D%3E+%27langid%27%2C%0A++1+%3D%3E+%27answer_text%27%2C%0A++2+%3D%3E+%27questionid%27%2C%0A++3+%3D%3E+%27userid%27%2C%0A++4+%3D%3E+%27date1%27%2C%0A++5+%3D%3E+%27rate%27%2C%0A++6+%3D%3E+%27bestans%27%2C%0A++7+%3D%3E+%27extra1%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27int%281%29%27%2C%0A++1+%3D%3E+%27text%27%2C%0A++2+%3D%3E+%27int%2810%29%27%2C%0A++3+%3D%3E+%27int%285%29%27%2C%0A++4+%3D%3E+%27bigint%2815%29%27%2C%0A++5+%3D%3E+%27float%282%2C1%29%27%2C%0A++6+%3D%3E+%27enum%28%5C%5C%5C%27Yes%5C%5C%5C%27%2C%5C%5C%5C%27No%5C%5C%5C%27%29%27%2C%0A++7+%3D%3E+%27varchar%2815%29%27%2C%0A%29
*/
class answer
{
	var $answerId = '';

	/**
	 * @var int(1)
	 */
	var $langid;
	
	/**
	 * @var text
	 */
	var $answer_text;
	
	/**
	 * @var int(10)
	 */
	var $questionid;
	
	/**
	 * @var int(5)
	 */
	var $userid;
	
	/**
	 * @var bigint(15)
	 */
	var $date1;
	
	/**
	 * @var float(2,1)
	 */
	var $rate;
	
	/**
	 * @var enum('Yes','No')
	 */
	var $bestans;
	
	/**
	 * @var varchar(15)
	 */
	var $extra1;
	
	var $pog_attribute_type = array(
		"answerId" => array("NUMERIC", "INT"),
		"langid" => array("NUMERIC", "INT", "1"),
		"answer_text" => array("TEXT", "TEXT"),
		"questionid" => array("NUMERIC", "INT", "10"),
		"userid" => array("NUMERIC", "INT", "5"),
		"date1" => array("NUMERIC", "BIGINT", "15"),
		"rate" => array("NUMERIC", "FLOAT", "2,1"),
		"bestans" => array("SET", "ENUM", "'Yes','No'"),
		"extra1" => array("TEXT", "VARCHAR", "15"),
		);
	var $pog_query;
	
	function answer($langid='', $answer_text='', $questionid='', $userid='', $date1='', $rate='', $bestans='', $extra1='')
	{
		$this->langid = $langid;
		$this->answer_text = $answer_text;
		$this->questionid = $questionid;
		$this->userid = $userid;
		$this->date1 = $date1;
		$this->rate = $rate;
		$this->bestans = $bestans;
		$this->extra1 = $extra1;
	}
	
	
	/**
	* Gets object from database
	* @param integer $answerId 
	* @return object $answer
	*/
	function Get($answerId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `answer` where `answerid`='".intval($answerId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->answerId = $Database->Result(0, "answerid");
		$this->langid = ($Database->Result(0, "langid"));
		$this->answer_text = ($Database->Result(0, "answer_text"));
		$this->questionid = ($Database->Result(0, "questionid"));
		$this->userid = ($Database->Result(0, "userid"));
		$this->date1 = ($Database->Result(0, "date1"));
		$this->rate = ($Database->Result(0, "rate"));
		$this->bestans = $Database->Result(0, "bestans");
		$this->extra1 = ($Database->Result(0, "extra1"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $answerList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$answerList = Array();

			$Database = new DatabaseConnection();
			$this->pog_query = "select answerid from `answer` where ";
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
			$this->pog_query .= " order by answerid asc $sqlLimit";
			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$answer = new $thisObjectName();
				$answer->Get($Database->Result($i, "answerid"));
				$answerList[] = $answer;
			}
			if ($sortBy != '')
			{
				$f = '';
				$answer = new answer();
				if (isset($answer->pog_attribute_type[$sortBy]) && ($answer->pog_attribute_type[$sortBy][0] == "NUMERIC" || $answer->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $answer1->'.$sortBy.' > $answer2->'.$sortBy.';';
				}
				else if (isset($answer->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($answer1->'.$sortBy.'), strtolower($answer2->'.$sortBy.'));';
				}
				usort($answerList, create_function('$answer1, $answer2', $f));
				if (!$ascending)
				{
					$answerList = array_reverse($answerList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($answerList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($answerList, 0, $limit);
					}
				}
			}
			return $answerList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $answerId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `answerid` from `answer` where `answerid`='".$this->answerId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `answer` set 
			`langid`='".($this->langid)."', 
			`answer_text`='".($this->answer_text)."', 
			`questionid`='".($this->questionid)."', 
			`userid`='".($this->userid)."', 
			`date1`='".($this->date1)."', 
			`rate`='".($this->rate)."', 
			`bestans`='".$this->bestans."', 
			`extra1`='".($this->extra1)."' where `answerid`='".$this->answerId."'";
		}
		else
		{
			$this->pog_query = "insert into `answer` (`langid`, `answer_text`, `questionid`, `userid`, `date1`, `rate`, `bestans`, `extra1` ) values (
			'".($this->langid)."', 
			'".($this->answer_text)."', 
			'".($this->questionid)."', 
			'".($this->userid)."', 
			'".($this->date1)."', 
			'".($this->rate)."', 
			'".$this->bestans."', 
			'".($this->extra1)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->answerId == "")
		{
			$this->answerId = $Database->GetCurrentId();
		}
		return $this->answerId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $answerId
	*/
	function SaveNew()
	{
		$this->answerId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `answer` where `answerid`='".$this->answerId."'";
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
			$pog_query = "delete from `answer` where ";
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