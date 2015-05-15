<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `user` (
	`userid` int(11) NOT NULL auto_increment,
	`langid` int(1) NOT NULL,
	`username` varchar(50) NOT NULL,
	`first_name` varchar(25) NOT NULL,
	`last_name` varchar(25) NOT NULL,
	`emailid` varchar(50) NOT NULL,
	`photo` varchar(50) NOT NULL,
	`status` enum('Active','Inactive') NOT NULL,
	`password` varchar(25) NOT NULL,
	`city` varchar(50) NOT NULL,
	`state` varchar(50) NOT NULL,
	`countryid` int(3) NOT NULL,
	`address` VARCHAR(255) NOT NULL,
	`zipcode` VARCHAR(255) NOT NULL, PRIMARY KEY  (`userid`));
*/

/**
* <b>user</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.6.3 / PHP4
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php4&wrapper=pog&objectName=user&attributeList=array+%28%0A++0+%3D%3E+%27langid%27%2C%0A++1+%3D%3E+%27username%27%2C%0A++2+%3D%3E+%27first_name%27%2C%0A++3+%3D%3E+%27last_name%27%2C%0A++4+%3D%3E+%27emailid%27%2C%0A++5+%3D%3E+%27photo%27%2C%0A++6+%3D%3E+%27status%27%2C%0A++7+%3D%3E+%27password%27%2C%0A++8+%3D%3E+%27city%27%2C%0A++9+%3D%3E+%27state%27%2C%0A++10+%3D%3E+%27countryid%27%2C%0A++11+%3D%3E+%27address%27%2C%0A++12+%3D%3E+%27zipcode%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27int%281%29%27%2C%0A++1+%3D%3E+%27varchar%2850%29%27%2C%0A++2+%3D%3E+%27varchar%2825%29%27%2C%0A++3+%3D%3E+%27varchar%2825%29%27%2C%0A++4+%3D%3E+%27varchar%2850%29%27%2C%0A++5+%3D%3E+%27varchar%2850%29%27%2C%0A++6+%3D%3E+%27enum%28%5C%5C%5C%27Active%5C%5C%5C%27%2C%5C%5C%5C%27Inactive%5C%5C%5C%27%29%27%2C%0A++7+%3D%3E+%27varchar%2825%29%27%2C%0A++8+%3D%3E+%27varchar%2850%29%27%2C%0A++9+%3D%3E+%27varchar%2850%29%27%2C%0A++10+%3D%3E+%27int%283%29%27%2C%0A++11+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++12+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
class user
{
	var $userId = '';

	/**
	 * @var int(1)
	 */
	var $langid;
	
	/**
	 * @var varchar(50)
	 */
	var $username;
	
	/**
	 * @var varchar(25)
	 */
	var $first_name;
	
	/**
	 * @var varchar(25)
	 */
	var $last_name;
	
	/**
	 * @var varchar(50)
	 */
	var $emailid;
	
	/**
	 * @var varchar(50)
	 */
	var $photo;
	
	/**
	 * @var enum('Active','Inactive')
	 */
	var $status;
	
	/**
	 * @var varchar(25)
	 */
	var $password;
	
	/**
	 * @var varchar(50)
	 */
	var $city;
	
	/**
	 * @var varchar(50)
	 */
	var $state;
	
	/**
	 * @var int(3)
	 */
	var $countryid;
	
	/**
	 * @var VARCHAR(255)
	 */
	var $address;
	
	/**
	 * @var VARCHAR(255)
	 */
	var $zipcode;
	
	var $pog_attribute_type = array(
		"userId" => array("NUMERIC", "INT"),
		"langid" => array("NUMERIC", "INT", "1"),
		"username" => array("TEXT", "VARCHAR", "50"),
		"first_name" => array("TEXT", "VARCHAR", "25"),
		"last_name" => array("TEXT", "VARCHAR", "25"),
		"emailid" => array("TEXT", "VARCHAR", "50"),
		"photo" => array("TEXT", "VARCHAR", "50"),
		"status" => array("SET", "ENUM", "'Active','Inactive'"),
		"password" => array("TEXT", "VARCHAR", "25"),
		"city" => array("TEXT", "VARCHAR", "50"),
		"state" => array("TEXT", "VARCHAR", "50"),
		"countryid" => array("NUMERIC", "INT", "3"),
		"address" => array("TEXT", "VARCHAR", "255"),
		"zipcode" => array("TEXT", "VARCHAR", "255"),
		);
	var $pog_query;
	
	function user($langid='', $username='', $first_name='', $last_name='', $emailid='', $photo='', $status='', $password='', $city='', $state='', $countryid='', $address='', $zipcode='')
	{
		$this->langid = $langid;
		$this->username = $username;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->emailid = $emailid;
		$this->photo = $photo;
		$this->status = $status;
		$this->password = $password;
		$this->city = $city;
		$this->state = $state;
		$this->countryid = $countryid;
		$this->address = $address;
		$this->zipcode = $zipcode;
	}
	
	
	/**
	* Gets object from database
	* @param integer $userId 
	* @return object $user
	*/
	function Get($userId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `user` where `userid`='".intval($userId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->userId = $Database->Result(0, "userid");
		$this->langid = ($Database->Result(0, "langid"));
		$this->username = ($Database->Result(0, "username"));
		$this->first_name = ($Database->Result(0, "first_name"));
		$this->last_name = ($Database->Result(0, "last_name"));
		$this->emailid = ($Database->Result(0, "emailid"));
		$this->photo = ($Database->Result(0, "photo"));
		$this->status = $Database->Result(0, "status");
		$this->password = ($Database->Result(0, "password"));
		$this->city = ($Database->Result(0, "city"));
		$this->state = ($Database->Result(0, "state"));
		$this->countryid = ($Database->Result(0, "countryid"));
		$this->address = ($Database->Result(0, "address"));
		$this->zipcode = ($Database->Result(0, "zipcode"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $userList
	*/
	function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$userList = Array();
			$Database = new DatabaseConnection();
			$this->pog_query = "select userid from `user` where ";
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
			$this->pog_query .= " order by userid asc $sqlLimit";
			$Database->Query($this->pog_query);
			$thisObjectName = get_class($this);
			for ($i=0; $i < $Database->Rows(); $i++)
			{
				$user = new $thisObjectName();
				$user->Get($Database->Result($i, "userid"));
				$userList[] = $user;
			}
			if ($sortBy != '')
			{
				$f = '';
				$user = new user();
				if (isset($user->pog_attribute_type[$sortBy]) && ($user->pog_attribute_type[$sortBy][0] == "NUMERIC" || $user->pog_attribute_type[$sortBy][0] == "SET"))
				{
					$f = 'return $user1->'.$sortBy.' > $user2->'.$sortBy.';';
				}
				else if (isset($user->pog_attribute_type[$sortBy]))
				{
					$f = 'return strcmp(strtolower($user1->'.$sortBy.'), strtolower($user2->'.$sortBy.'));';
				}
				usort($userList, create_function('$user1, $user2', $f));
				if (!$ascending)
				{
					$userList = array_reverse($userList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($userList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($userList, 0, $limit);
					}
				}
			}
			return $userList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $userId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select `userid` from `user` where `userid`='".$this->userId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `user` set 
			`langid`='".($this->langid)."', 
			`username`='".($this->username)."', 
			`first_name`='".($this->first_name)."', 
			`last_name`='".($this->last_name)."', 
			`emailid`='".($this->emailid)."', 
			`photo`='".($this->photo)."', 
			`status`='".$this->status."', 
			`password`='".($this->password)."', 
			`city`='".($this->city)."', 
			`state`='".($this->state)."', 
			`countryid`='".($this->countryid)."', 
			`address`='".($this->address)."', 
			`zipcode`='".($this->zipcode)."' where `userid`='".$this->userId."'";
		}
		else
		{
			$this->pog_query = "insert into `user` (`langid`, `username`, `first_name`, `last_name`, `emailid`, `photo`, `status`, `password`, `city`, `state`, `countryid`, `address`, `zipcode` ) values (
			'".($this->langid)."', 
			'".($this->username)."', 
			'".($this->first_name)."', 
			'".($this->last_name)."', 
			'".($this->emailid)."', 
			'".($this->photo)."', 
			'".$this->status."', 
			'".($this->password)."', 
			'".($this->city)."', 
			'".($this->state)."', 
			'".($this->countryid)."', 
			'".($this->address)."', 
			'".($this->zipcode)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->userId == "")
		{
			$this->userId = $Database->GetCurrentId();
		}
		return $this->userId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $userId
	*/
	function SaveNew()
	{
		$this->userId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `user` where `userid`='".$this->userId."'";
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
			$pog_query = "delete from `user` where ";
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