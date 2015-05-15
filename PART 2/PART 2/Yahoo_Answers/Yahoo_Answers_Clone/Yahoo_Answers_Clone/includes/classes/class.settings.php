<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `settings` (
	`settingsid` int(11) NOT NULL auto_increment,
	`title` varchar(20) NOT NULL,
	`value` varchar(25) NOT NULL,
	`key` varchar(15) NOT NULL,
	`extra1` varchar(15) NOT NULL, PRIMARY KEY  (`settingsid`));
*/

/**
* <b>settings</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=settings&attributeList=array+%28%0A++0+%3D%3E+%27title%27%2C%0A++1+%3D%3E+%27value%27%2C%0A++2+%3D%3E+%27key%27%2C%0A++3+%3D%3E+%27extra1%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27varchar%2820%29%27%2C%0A++1+%3D%3E+%27varchar%2825%29%27%2C%0A++2+%3D%3E+%27varchar%2815%29%27%2C%0A++3+%3D%3E+%27varchar%2815%29%27%2C%0A%29
*/
class settings
{
	var $settingsId = '';

	/**
	 * @var varchar(20)
	 */
	var $title;
	
	/**
	 * @var varchar(25)
	 */
	var $value;
	
	/**
	 * @var varchar(15)
	 */
	var $key;
	
	/**
	 * @var varchar(15)
	 */
	var $extra1;
	
	var $pog_attribute_type = array(
		"settingsId" => array("NUMERIC", "INT"),
		"title" => array("TEXT", "VARCHAR", "20"),
		"value" => array("TEXT", "VARCHAR", "25"),
		"key" => array("TEXT", "VARCHAR", "15"),
		"extra1" => array("TEXT", "VARCHAR", "15"),
		);
	var $pog_query;
	
	function settings($title='', $value='', $key='', $extra1='')
	{
		$this->title = $title;
		$this->value = $value;
		$this->key = $key;
		$this->extra1 = $extra1;
	}
	
	
	/**
	* Gets object from database
	* @param integer $settingsId 
	* @return object $settings
	*/
	function Get($settingsId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `settings` where `settingsid`='".intval($settingsId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->settingsId = $Database->Result(0, "settingsid");
		$this->title = ($Database->Result(0, "title"));
		$this->value = ($Database->Result(0, "value"));
		$this->key = ($Database->Result(0, "key"));
		$this->extra1 = ($Database->Result(0, "extra1"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $settingsList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$settingsList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select settingsid from `settings` where ";
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
			$this->pog_query .= " order by settingsid asc $sqlLimit";
			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$settings = new $thisObjectName();
				$settings->Get($Database->Result($i, "settingsid"));
				$settingsList[] = $settings;
			}
			if ($sortBy != '')
			{
				$f = '';
				$settings = new settings();
				if (isset($settings->pog_attribute_type[$sortBy]) && ($settings->pog_attribute_type[$sortBy][0] == "NUMERIC" || $settings->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $settings1->'.$sortBy.' > $settings2->'.$sortBy.';';
				}
				else if (isset($settings->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($settings1->'.$sortBy.'), strtolower($settings2->'.$sortBy.'));';
				}
				usort($settingsList, create_function('$settings1, $settings2', $f));
				if (!$ascending)
				{
					$settingsList = array_reverse($settingsList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($settingsList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($settingsList, 0, $limit);
					}
				}
			}
			return $settingsList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $settingsId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `settingsid` from `settings` where `settingsid`='".$this->settingsId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `settings` set 
			`title`='".($this->title)."', 
			`value`='".($this->value)."', 
			`key`='".($this->key)."', 
			`extra1`='".($this->extra1)."' where `settingsid`='".$this->settingsId."'";
		}
		else
		{
			$this->pog_query = "insert into `settings` (`title`, `value`, `key`, `extra1` ) values (
			'".($this->title)."', 
			'".($this->value)."', 
			'".($this->key)."', 
			'".($this->extra1)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->settingsId == "")
		{
			$this->settingsId = $Database->GetCurrentId();
		}
		return $this->settingsId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $settingsId
	*/
	function SaveNew()
	{
		$this->settingsId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `settings` where `settingsid`='".$this->settingsId."'";
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
			$pog_query = "delete from `settings` where ";
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