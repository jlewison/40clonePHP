<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `filter` (
	`filterid` int(11) NOT NULL auto_increment,
	`word` varchar(20) NOT NULL,
	`extra1` varchar(15) NOT NULL, PRIMARY KEY  (`filterid`));
*/

/**
* <b>filter</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=filter&attributeList=array+%28%0A++0+%3D%3E+%27word%27%2C%0A++1+%3D%3E+%27extra1%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27varchar%2820%29%27%2C%0A++1+%3D%3E+%27varchar%2815%29%27%2C%0A%29
*/
class filter
{
	var $filterId = '';

	/**
	 * @var varchar(20)
	 */
	var $word;
	
	/**
	 * @var varchar(15)
	 */
	var $extra1;
	
	var $pog_attribute_type = array(
		"filterId" => array("NUMERIC", "INT"),
		"word" => array("TEXT", "VARCHAR", "20"),
		"extra1" => array("TEXT", "VARCHAR", "15"),
		);
	var $pog_query;
	
	function filter($word='', $extra1='')
	{
		$this->word = $word;
		$this->extra1 = $extra1;
	}
	
	
	/**
	* Gets object from database
	* @param integer $filterId 
	* @return object $filter
	*/
	function Get($filterId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `filter` where `filterid`='".intval($filterId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->filterId = $Database->Result(0, "filterid");
		$this->word = ($Database->Result(0, "word"));
		$this->extra1 = ($Database->Result(0, "extra1"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $filterList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$filterList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select filterid from `filter` where ";
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
			$this->pog_query .= " order by filterid asc $sqlLimit";
			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$filter = new $thisObjectName();
				$filter->Get($Database->Result($i, "filterid"));
				$filterList[] = $filter;
			}
			if ($sortBy != '')
			{
				$f = '';
				$filter = new filter();
				if (isset($filter->pog_attribute_type[$sortBy]) && ($filter->pog_attribute_type[$sortBy][0] == "NUMERIC" || $filter->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $filter1->'.$sortBy.' > $filter2->'.$sortBy.';';
				}
				else if (isset($filter->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($filter1->'.$sortBy.'), strtolower($filter2->'.$sortBy.'));';
				}
				usort($filterList, create_function('$filter1, $filter2', $f));
				if (!$ascending)
				{
					$filterList = array_reverse($filterList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($filterList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($filterList, 0, $limit);
					}
				}
			}
			return $filterList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $filterId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `filterid` from `filter` where `filterid`='".$this->filterId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `filter` set 
			`word`='".($this->word)."', 
			`extra1`='".($this->extra1)."' where `filterid`='".$this->filterId."'";
		}
		else
		{
			$this->pog_query = "insert into `filter` (`word`, `extra1` ) values (
			'".($this->word)."', 
			'".($this->extra1)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->filterId == "")
		{
			$this->filterId = $Database->GetCurrentId();
		}
		return $this->filterId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $filterId
	*/
	function SaveNew()
	{
		$this->filterId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `filter` where `filterid`='".$this->filterId."'";
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
			$pog_query = "delete from `filter` where ";
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