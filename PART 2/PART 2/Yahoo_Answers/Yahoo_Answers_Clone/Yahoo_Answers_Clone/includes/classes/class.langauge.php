<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `language` (
	`languageid` int(11) NOT NULL auto_increment,
	`language_name` varchar(15) NOT NULL,
	`status` enum('Active','Inactive') NOT NULL,
	`extra1` varchar(15) NOT NULL, PRIMARY KEY  (`languageid`));
*/

/**
* <b>language</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=language&attributeList=array+%28%0A++0+%3D%3E+%27language_name%27%2C%0A++1+%3D%3E+%27status%27%2C%0A++2+%3D%3E+%27extra1%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27varchar%2815%29%27%2C%0A++1+%3D%3E+%27enum%28%5C%5C%5C%27Active%5C%5C%5C%27%2C%5C%5C%5C%27Inactive%5C%5C%5C%27%29%27%2C%0A++2+%3D%3E+%27varchar%2815%29%27%2C%0A%29
*/
class language
{
	var $languageId = '';

	/**
	 * @var varchar(15)
	 */
	var $language_name;
	
	/**
	 * @var enum('Active','Inactive')
	 */
	var $status;
	
	/**
	 * @var varchar(15)
	 */
	var $extra1;
	
	var $pog_attribute_type = array(
		"languageId" => array("NUMERIC", "INT"),
		"language_name" => array("TEXT", "VARCHAR", "15"),
		"status" => array("SET", "ENUM", "'Active','Inactive'"),
		"extra1" => array("TEXT", "VARCHAR", "15"),
		);
	var $pog_query;
	
	function language($language_name='', $status='', $extra1='')
	{
		$this->language_name = $language_name;
		$this->status = $status;
		$this->extra1 = $extra1;
	}
	
	
	/**
	* Gets object from database
	* @param integer $languageId 
	* @return object $language
	*/
	function Get($languageId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `language` where `languageid`='".intval($languageId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->languageId = $Database->Result(0, "languageid");
		$this->language_name = ($Database->Result(0, "language_name"));
		$this->status = $Database->Result(0, "status");
		$this->extra1 = ($Database->Result(0, "extra1"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $languageList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$languageList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select languageid from `language` where ";
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
			$this->pog_query .= " order by languageid asc $sqlLimit";

			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$language = new $thisObjectName();
				$language->Get($Database->Result($i, "languageid"));
				$languageList[] = $language;
			}
			if ($sortBy != '')
			{
				$f = '';
				$language = new language();
				if (isset($language->pog_attribute_type[$sortBy]) && ($language->pog_attribute_type[$sortBy][0] == "NUMERIC" || $language->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $language1->'.$sortBy.' > $language2->'.$sortBy.';';
				}
				else if (isset($language->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($language1->'.$sortBy.'), strtolower($language2->'.$sortBy.'));';
				}
				usort($languageList, create_function('$language1, $language2', $f));
				if (!$ascending)
				{
					$languageList = array_reverse($languageList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($languageList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($languageList, 0, $limit);
					}
				}
			}
			return $languageList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $languageId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `languageid` from `language` where `languageid`='".$this->languageId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `language` set 
			`language_name`='".($this->language_name)."', 
			`status`='".$this->status."', 
			`extra1`='".($this->extra1)."' where `languageid`='".$this->languageId."'";
		}
		else
		{
			$this->pog_query = "insert into `language` (`language_name`, `status`, `extra1` ) values (
			'".($this->language_name)."', 
			'".$this->status."', 
			'".($this->extra1)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->languageId == "")
		{
			$this->languageId = $Database->GetCurrentId();
		}
		return $this->languageId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $languageId
	*/
	function SaveNew()
	{
		$this->languageId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `language` where `languageid`='".$this->languageId."'";
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
			$pog_query = "delete from `language` where ";
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