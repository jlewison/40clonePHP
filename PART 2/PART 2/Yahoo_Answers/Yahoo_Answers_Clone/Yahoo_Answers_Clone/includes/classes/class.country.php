<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `country` (
	`countryid` int(11) NOT NULL auto_increment,
	`countryname` varchar(100) NOT NULL,
	`countrycode` int(3) NOT NULL,
	`extra1` VARCHAR(255) NOT NULL, PRIMARY KEY  (`countryid`));
*/

/**
* <b>country</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=country&attributeList=array+%28%0A++0+%3D%3E+%27countryname%27%2C%0A++1+%3D%3E+%27countrycode%27%2C%0A++2+%3D%3E+%27extra1%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27varchar%28100%29%27%2C%0A++1+%3D%3E+%27int%283%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
class country
{
	var $countryId = '';

	/**
	 * @var varchar(100)
	 */
	var $countryname;
	
	/**
	 * @var int(3)
	 */
	var $countrycode;
	
	/**
	 * @var VARCHAR(255)
	 */
	var $extra1;
	
	var $pog_attribute_type = array(
		"countryId" => array("NUMERIC", "INT"),
		"countryname" => array("TEXT", "VARCHAR", "100"),
		"countrycode" => array("TEXT", "VARCHAR", "3"),
		"extra1" => array("TEXT", "VARCHAR", "255"),
		);
	var $pog_query;
	
	function country($countryname='', $countrycode='', $extra1='')
	{
		$this->countryname = $countryname;
		$this->countrycode = $countrycode;
		$this->extra1 = $extra1;
	}
	
	
	/**
	* Gets object from database
	* @param integer $countryId 
	* @return object $country
	*/
	function Get($countryId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `country` where `countryid`='".intval($countryId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->countryId = $Database->Result(0, "countryid");
		$this->countryname = ($Database->Result(0, "countryname"));
		$this->countrycode = ($Database->Result(0, "countrycode"));
		$this->extra1 = ($Database->Result(0, "extra1"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $countryList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$countryList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select countryid from `country` where ";
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
			$this->pog_query .= " order by countryid asc $sqlLimit";
			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$country = new $thisObjectName();
				$country->Get($Database->Result($i, "countryid"));
				$countryList[] = $country;
			}
			if ($sortBy != '')
			{
				$f = '';
				$country = new country();
				if (isset($country->pog_attribute_type[$sortBy]) && ($country->pog_attribute_type[$sortBy][0] == "NUMERIC" || $country->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $country1->'.$sortBy.' > $country2->'.$sortBy.';';
				}
				else if (isset($country->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($country1->'.$sortBy.'), strtolower($country2->'.$sortBy.'));';
				}
				usort($countryList, create_function('$country1, $country2', $f));
				if (!$ascending)
				{
					$countryList = array_reverse($countryList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($countryList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($countryList, 0, $limit);
					}
				}
			}
			return $countryList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $countryId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `countryid` from `country` where `countryid`='".$this->countryId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `country` set 
			`countryname`='".($this->countryname)."', 
			`countrycode`='".($this->countrycode)."', 
			`extra1`='".($this->extra1)."' where `countryid`='".$this->countryId."'";
		}
		else
		{
			$this->pog_query = "insert into `country` (`countryname`, `countrycode`, `extra1` ) values (
			'".($this->countryname)."', 
			'".($this->countrycode)."', 
			'".($this->extra1)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->countryId == "")
		{
			$this->countryId = $Database->GetCurrentId();
		}
		return $this->countryId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $countryId
	*/
	function SaveNew()
	{
		$this->countryId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `country` where `countryid`='".$this->countryId."'";
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
			$pog_query = "delete from `country` where ";
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