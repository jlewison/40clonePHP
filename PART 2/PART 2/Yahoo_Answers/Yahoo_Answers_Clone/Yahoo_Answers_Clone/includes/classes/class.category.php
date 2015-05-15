<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `category` (
	`categoryid` int(11) NOT NULL auto_increment,
	`langid` int(1) NOT NULL,
	`category_name` varchar(50) NOT NULL,
	`level` int(5) NOT NULL,
	`path` varchar(255) NOT NULL,
	`status` enum('Active','Inactive') NOT NULL,
	`extra1` varchar(15) NOT NULL, PRIMARY KEY  (`categoryid`));
*/

/**
* <b>category</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=category&attributeList=array+%28%0A++0+%3D%3E+%27langid%27%2C%0A++1+%3D%3E+%27category_name%27%2C%0A++2+%3D%3E+%27level%27%2C%0A++3+%3D%3E+%27path%27%2C%0A++4+%3D%3E+%27status%27%2C%0A++5+%3D%3E+%27extra1%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27int%281%29%27%2C%0A++1+%3D%3E+%27varchar%2850%29%27%2C%0A++2+%3D%3E+%27int%285%29%27%2C%0A++3+%3D%3E+%27varchar%28255%29%27%2C%0A++4+%3D%3E+%27enum%28%5C%5C%5C%27Active%5C%5C%5C%27%2C%5C%5C%5C%27Inactive%5C%5C%5C%27%29%27%2C%0A++5+%3D%3E+%27varchar%2815%29%27%2C%0A%29
*/
class category
{
	var $categoryId = '';

	/**
	 * @var int(1)
	 */
	var $langid;
	
	/**
	 * @var varchar(50)
	 */
	var $category_name;
	
	/**
	 * @var int(5)
	 */
	var $level;
	
	/**
	 * @var varchar(255)
	 */
	var $path;
	
	/**
	 * @var enum('Active','Inactive')
	 */
	var $status;
	
	/**
	 * @var varchar(15)
	 */
	var $extra1;
	
	var $pog_attribute_type = array(
		"categoryId" => array("NUMERIC", "INT"),
		"langid" => array("NUMERIC", "INT", "1"),
		"category_name" => array("TEXT", "VARCHAR", "50"),
		"level" => array("NUMERIC", "INT", "5"),
		"path" => array("TEXT", "VARCHAR", "255"),
		"status" => array("SET", "ENUM", "'Active','Inactive'"),
		"extra1" => array("TEXT", "VARCHAR", "15"),
		);
	var $pog_query;
	
	function category($langid='', $category_name='', $level='', $path='', $status='', $extra1='')
	{
		$this->langid = $langid;
		$this->category_name = $category_name;
		$this->level = $level;
		$this->path = $path;
		$this->status = $status;
		$this->extra1 = $extra1;
	}
	
	
	/**
	* Gets object from database
	* @param integer $categoryId 
	* @return object $category
	*/
	function Get($categoryId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `category` where `categoryid`='".intval($categoryId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->categoryId = $Database->Result(0, "categoryid");
		$this->langid = ($Database->Result(0, "langid"));
		$this->category_name = ($Database->Result(0, "category_name"));
		$this->level = ($Database->Result(0, "level"));
		$this->path = ($Database->Result(0, "path"));
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
	* @return array $categoryList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$categoryList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select categoryid from `category` where ";
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
			$this->pog_query .= " order by categoryid asc $sqlLimit";
			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$category = new $thisObjectName();
				$category->Get($Database->Result($i, "categoryid"));
				$categoryList[] = $category;
			}
			if ($sortBy != '')
			{
				$f = '';
				$category = new category();
				if (isset($category->pog_attribute_type[$sortBy]) && ($category->pog_attribute_type[$sortBy][0] == "NUMERIC" || $category->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $category1->'.$sortBy.' > $category2->'.$sortBy.';';
				}
				else if (isset($category->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($category1->'.$sortBy.'), strtolower($category2->'.$sortBy.'));';
				}
				usort($categoryList, create_function('$category1, $category2', $f));
				if (!$ascending)
				{
					$categoryList = array_reverse($categoryList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($categoryList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($categoryList, 0, $limit);
					}
				}
			}
			return $categoryList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $categoryId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `categoryid` from `category` where `categoryid`='".$this->categoryId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `category` set 
			`langid`='".($this->langid)."', 
			`category_name`='".($this->category_name)."', 
			`level`='".($this->level)."', 
			`path`='".($this->path)."', 
			`status`='".$this->status."', 
			`extra1`='".($this->extra1)."' where `categoryid`='".$this->categoryId."'";
		}
		else
		{
			$this->pog_query = "insert into `category` (`langid`, `category_name`, `level`, `path`, `status`, `extra1` ) values (
			'".($this->langid)."', 
			'".($this->category_name)."', 
			'".($this->level)."', 
			'".($this->path)."', 
			'".$this->status."', 
			'".($this->extra1)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->categoryId == "")
		{
			$this->categoryId = $Database->GetCurrentId();
		}
		return $this->categoryId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $categoryId
	*/
	function SaveNew()
	{
		$this->categoryId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `category` where `categoryid`='".$this->categoryId."'";
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
			$pog_query = "delete from `category` where ";
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