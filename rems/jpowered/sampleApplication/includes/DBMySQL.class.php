<?php

class Database
{
	var $dbLink;

	var $dbServer;
	var $dbUser;
	var $dbPassword;
	var $dbDatabase;

	var $result;
	var $lastRow;

        var $errorState;
        var $errorMessage;

	/**
	 * Constructor
	 */
	function Database($dbServer   = "",
	                  $dbUser     = "",
	                  $dbPassword = "",
	                  $dbDatabase = "") {

		$this->dbServer   = $dbServer;
		$this->dbUser     = $dbUser;
		$this->dbPassword = $dbPassword;
		$this->dbDatabase = $dbDatabase;
                $this->errorState = false;


		$this->dbLink = mysql_connect($this->dbServer,
		                              $this->dbUser,
		                              $this->dbPassword);
		if (!$this->dbLink) {
			$this->errorState = true;
			$this->errorMessage = 'Could not connect: '.mysql_error();
			return false;
		}

		if (!mysql_select_db($this->dbDatabase, $this->dbLink)) {
			$this->errorState = true;
			$this->errorMessage = 'Could not select database: '.mysql_error();
			return false;
		}

                return true;


	}

	/**
	 * Opens a connection to the database
	 */
	function connect() {

		$this->dbLink = mysql_connect($this->dbServer,
		                              $this->dbUser,
		                              $this->dbPassword);
		if (!$this->dbLink) {
			$this->errorState = true;
			$this->errorMessage = 'Could not connect: '.mysql_error();
			return false;
		}

		if (!mysql_select_db($this->dbDatabase, $this->dbLink)) {
			$this->errorState = true;
			$this->errorMessage = 'Could not select database: '.mysql_error();
			return false;
		}

		return true;
	}

	/**
	 * Queries the database for a specific SQL query
	 */
	function query($sql) {
		if (!$this->result = mysql_query($sql, $this->dbLink)) {
			$this->errorState = true;
			$this->errorMessage = 'Query Error: '.mysql_error();
		}
		return $this->result;
	}

	/**
	 * Fetches a row from a result set
	 */
	function fetch(&$result) {
		return mysql_fetch_array($result,MYSQL_ASSOC);
	}

	/**
	 * Returns an associative array of all rows
	 */
	function fetchAll(&$result) {
		$resultArr = array();
		if ($result) {
			$resultArr = array();
			while ($row = $this->fetch($result)) {
				$resultArr[] = $row;
			}
		}

		return $resultArr;
	}

	function freeResult(&$result) {
		if ($result != true && $result != false) {
			mysql_free_result($result);
		}
		unset($result);
	}

	function getLastError() {
		return mysql_error();
	}

	function getNumRows(&$result) {
		$numRows = mysql_num_rows($result);
		return $numRows;
	}


        // return the error state
        function getErrorState() {
                return $this->errorState;
        }

        // set the error state
        function setErrorState($errorState) {
                $this->errorState = $errorState;
        }

	/**
	 * disconnect
	 */
	function close() {
		mysql_close($this->dbLink);
	}




}

?>