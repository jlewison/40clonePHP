<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `rating` (
	`ratingid` int(11) NOT NULL auto_increment,
	`ratingdate` varchar(15) NOT NULL,
	`ipaddress` int(12) NOT NULL,
	`albumid` int(5) NOT NULL,
	`rate` int(1) NOT NULL,
	`extra1` varchar(50) NOT NULL, PRIMARY KEY  (`ratingid`));
*/

/**
* <b>rating</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.1 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=rating&attributeList=array+%28%0A++0+%3D%3E+%27ratingdate%27%2C%0A++1+%3D%3E+%27ipaddress%27%2C%0A++2+%3D%3E+%27albumid%27%2C%0A++3+%3D%3E+%27rate%27%2C%0A++4+%3D%3E+%27extra1%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27bigint%2815%29%27%2C%0A++1+%3D%3E+%27int%2812%29%27%2C%0A++2+%3D%3E+%27int%285%29%27%2C%0A++3+%3D%3E+%27int%281%29%27%2C%0A++4+%3D%3E+%27varchar%2850%29%27%2C%0A%29
*/
class rating
{
	var $ratingId = '';

	/**
	 * @var varchar(15)
	 */
	var $ratingdate;
	
	/**
	 * @var int(12)
	 */
	var $ipaddress;
	
	/**
	 * @var int(5)
	 */
	var $albumid;
	
	/**
	 * @var int(1)
	 */
	var $rate;
	
	/**
	 * @var varchar(50)
	 */
	var $extra1;
	
	var $pog_attribute_type = array(
		"ratingId" => array("NUMERIC", "INT"),
		"ratingdate" => array("TEXT", "VARCHAR", "15"),
		"ipaddress" => array("NUMERIC", "INT", "12"),
		"albumid" => array("NUMERIC", "INT", "5"),
		"rate" => array("NUMERIC", "INT", "1"),
		"extra1" => array("TEXT", "VARCHAR", "50"),
		);
	var $pog_query;
	
	function rating($ratingdate='', $ipaddress='', $albumid='', $rate='', $extra1='')
	{
		$this->ratingdate = $ratingdate;
		$this->ipaddress = $ipaddress;
		$this->albumid = $albumid;
		$this->rate = $rate;
		$this->extra1 = $extra1;
	}
	
	
	/**
	* Gets object from database
	* @param integer $ratingId 
	* @return object $rating
	*/
	function Get($ratingId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `rating` where `ratingid`='".intval($ratingId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->ratingId = $Database->Result(0, "ratingid");
		$this->ratingdate = ($Database->Result(0, "ratingdate"));
		$this->ipaddress = ($Database->Result(0, "ipaddress"));
		$this->albumid = ($Database->Result(0, "albumid"));
		$this->rate = ($Database->Result(0, "rate"));
		$this->extra1 = ($Database->Result(0, "extra1"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $ratingList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$ratingList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select ratingid from `rating` where ";
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
			$this->pog_query .= " order by ratingid asc $sqlLimit";
			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$rating = new $thisObjectName();
				$rating->Get($Database->Result($i, "ratingid"));
				$ratingList[] = $rating;
			}
			if ($sortBy != '')
			{
				$f = '';
				$rating = new rating();
				if (isset($rating->pog_attribute_type[$sortBy]) && ($rating->pog_attribute_type[$sortBy][0] == "NUMERIC" || $rating->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $rating1->'.$sortBy.' > $rating2->'.$sortBy.';';
				}
				else if (isset($rating->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($rating1->'.$sortBy.'), strtolower($rating2->'.$sortBy.'));';
				}
				usort($ratingList, create_function('$rating1, $rating2', $f));
				if (!$ascending)
				{
					$ratingList = array_reverse($ratingList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($ratingList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($ratingList, 0, $limit);
					}
				}
			}
			return $ratingList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $ratingId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `ratingid` from `rating` where `ratingid`='".$this->ratingId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `rating` set 
			`ratingdate`='".($this->ratingdate)."', 
			`ipaddress`='".($this->ipaddress)."', 
			`albumid`='".($this->albumid)."', 
			`rate`='".($this->rate)."', 
			`extra1`='".($this->extra1)."' where `ratingid`='".$this->ratingId."'";
		}
		else
		{
			$this->pog_query = "insert into `rating` (`ratingdate`, `ipaddress`, `albumid`, `rate`, `extra1` ) values (
			'".($this->ratingdate)."', 
			'".($this->ipaddress)."', 
			'".($this->albumid)."', 
			'".($this->rate)."', 
			'".($this->extra1)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->ratingId == "")
		{
			$this->ratingId = $Database->GetCurrentId();
		}
		return $this->ratingId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $ratingId
	*/
	function SaveNew()
	{
		$this->ratingId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `rating` where `ratingid`='".$this->ratingId."'";
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
			$pog_query = "delete from `rating` where ";
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