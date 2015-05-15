<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `watchlist` (
	`watchlistid` int(11) NOT NULL auto_increment,
	`userid` int(5) NOT NULL,
	`questionid` int(5) NOT NULL,
	`extra1` varchar(15) NOT NULL, PRIMARY KEY  (`watchlistid`));
*/

/**
* <b>watchlist</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=watchlist&attributeList=array+%28%0A++0+%3D%3E+%27userid%27%2C%0A++1+%3D%3E+%27questionid%27%2C%0A++2+%3D%3E+%27extra1%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27int%285%29%27%2C%0A++1+%3D%3E+%27int%285%29%27%2C%0A++2+%3D%3E+%27varchar%2815%29%27%2C%0A%29
*/
class watchlist
{
	var $watchlistId = '';

	/**
	 * @var int(5)
	 */
	var $userid;
	
	/**
	 * @var int(5)
	 */
	var $questionid;
	
	/**
	 * @var varchar(15)
	 */
	var $extra1;
	
	var $pog_attribute_type = array(
		"watchlistId" => array("NUMERIC", "INT"),
		"userid" => array("NUMERIC", "INT", "5"),
		"questionid" => array("NUMERIC", "INT", "5"),
		"extra1" => array("TEXT", "VARCHAR", "15"),
		);
	var $pog_query;
	
	function watchlist($userid='', $questionid='', $extra1='')
	{
		$this->userid = $userid;
		$this->questionid = $questionid;
		$this->extra1 = $extra1;
	}
	
	
	/**
	* Gets object from database
	* @param integer $watchlistId 
	* @return object $watchlist
	*/
	function Get($watchlistId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `watchlist` where `watchlistid`='".intval($watchlistId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->watchlistId = $Database->Result(0, "watchlistid");
		$this->userid = ($Database->Result(0, "userid"));
		$this->questionid = ($Database->Result(0, "questionid"));
		$this->extra1 = ($Database->Result(0, "extra1"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $watchlistList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$watchlistList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select watchlistid from `watchlist` where ";
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
			$this->pog_query .= " order by watchlistid asc $sqlLimit";
			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$watchlist = new $thisObjectName();
				$watchlist->Get($Database->Result($i, "watchlistid"));
				$watchlistList[] = $watchlist;
			}
			if ($sortBy != '')
			{
				$f = '';
				$watchlist = new watchlist();
				if (isset($watchlist->pog_attribute_type[$sortBy]) && ($watchlist->pog_attribute_type[$sortBy][0] == "NUMERIC" || $watchlist->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $watchlist1->'.$sortBy.' > $watchlist2->'.$sortBy.';';
				}
				else if (isset($watchlist->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($watchlist1->'.$sortBy.'), strtolower($watchlist2->'.$sortBy.'));';
				}
				usort($watchlistList, create_function('$watchlist1, $watchlist2', $f));
				if (!$ascending)
				{
					$watchlistList = array_reverse($watchlistList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($watchlistList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($watchlistList, 0, $limit);
					}
				}
			}
			return $watchlistList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $watchlistId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `watchlistid` from `watchlist` where `watchlistid`='".$this->watchlistId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `watchlist` set 
			`userid`='".($this->userid)."', 
			`questionid`='".($this->questionid)."', 
			`extra1`='".($this->extra1)."' where `watchlistid`='".$this->watchlistId."'";
		}
		else
		{
			$this->pog_query = "insert into `watchlist` (`userid`, `questionid`, `extra1` ) values (
			'".($this->userid)."', 
			'".($this->questionid)."', 
			'".($this->extra1)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->watchlistId == "")
		{
			$this->watchlistId = $Database->GetCurrentId();
		}
		return $this->watchlistId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $watchlistId
	*/
	function SaveNew()
	{
		$this->watchlistId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `watchlist` where `watchlistid`='".$this->watchlistId."'";
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
			$pog_query = "delete from `watchlist` where ";
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