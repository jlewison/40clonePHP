<?php
/**
* <b>Database Connection</b> class.
* @author Php Object Generator
* @version POG 2.6.1 / PHP4
* @see http://www.phpobjectgenerator.com/
* @copyright Free for personal & commercial use. (Offered under the BSD license)
*/
Class DatabaseConnection
{
	var $connection;
	var $databaseName;
	var $result;

	// -------------------------------------------------------------
	function DatabaseConnection()
	{
		$this->databaseName = $GLOBALS['configuration']['db'];
		$serverName = $GLOBALS['configuration']['host'];
		$databaseUser = $GLOBALS['configuration']['user'];
		$databasePassword = $GLOBALS['configuration']['pass'];
		$databasePort = $GLOBALS['configuration']['port'];

		$this->connection = mysql_connect ($serverName.":".$databasePort, $databaseUser, $databasePassword) or die ('I cannot connect to the database. Please edit configuration.php with your database configuration.');
		mysql_select_db ($this->databaseName) or die ('I cannot find the specified database "'.$this->databaseName.'". Please edit configuration.php');
	}

	// -------------------------------------------------------------
	function Close()
	{
		mysql_close($this->connection);
	}

	// -------------------------------------------------------------
	function GetConnection() {
		return $this->connection;
	}

	// -------------------------------------------------------------
	function Query($query)
	{
		$this->result = mysql_query($query,$this->connection);
		return $this->result;
	}

	// -------------------------------------------------------------
	function Rows()
	{
		if ($this->result != false)
		{
			return mysql_num_rows($this->result);
		}
		return null;
	}

	// -------------------------------------------------------------
	function AffectedRows()
	{
		return mysql_affected_rows();
	}

	// -------------------------------------------------------------
	function Result($row,$name)
	{
		if ($this->Rows() > 0)
		{
			return mysql_result($this->result, $row, $name);
		}
		return null;
	}


	// -------------------------------------------------------------
	function InsertOrUpdate($query)
	{
		$this->result = mysql_query($query,$this->connection);
		return ($this->AffectedRows() > 0);
	}

	/**
	* This function will always try to encode $text to base64, except when $text is a number. This allows us to Escape all data before they're inserted in the database, regardless of attribute type.
	* @param string $text
	* @return string encoded to base64
	*/
/*	function Escape($text)
	{
		if ($GLOBALS['configuration']['db_encoding'] && !is_numeric($text))
		{
			return base64_encode($text);
		}
		return mysql_escape_string($text);
	}

	// -------------------------------------------------------------
	function Unescape($text)
	{
		if ($GLOBALS['configuration']['db_encoding'] && !is_numeric($text))
		{
			return base64_decode($text);
		}
		return stripcslashes($text);
	}*/

	// -------------------------------------------------------------
	function GetCurrentId()
	{
		return intval(mysql_insert_id($this->connection));
	}
}
?>
