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
                $errorState = false;
    }

    /**
     * Opens a connection to the database
     */
    function connect() {

        if (function_exists("mysqli_connect"))
        {
            $this->dbLink = mysqli_connect($this->dbServer,$this->dbUser,$this->dbPassword,$this->dbDatabase);


            if (!$this->dbLink) {
                $this->errorState = true;
                $this->errorMessage = 'Could not connect: '.mysqli_error($this->dbLink);
                return false;
            }

        }
        else
        {

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
        }

        return true;
    }

    /**
     * Queries the database for a specific SQL query
     */
    function query($sql)
    {
        if (function_exists("mysqli_query"))
        {
            if (!$this->result = mysqli_query($this->dbLink, $sql))
            {
                $this->errorState = true;
                $this->errorMessage = 'Query Error: '.mysqli_error($this->dbLink);
            }
        }
        else
        {
            if (!$this->result = mysql_query($sql, $this->dbLink)) {
                $this->errorState = true;
                $this->errorMessage = 'Query Error: '.mysql_error();
            }
        }

        return $this->result;
    }

    /**
     * Fetches a row from a result set
     */
    function fetch(&$result) {

        if (function_exists("mysqli_fetch_array"))
        {
            $resultarray = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        else
        {
            $resultarray = mysql_fetch_array($result,MYSQL_ASSOC);
        }

        return $resultarray;
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

        if (function_exists("mysqli_free_result"))
        {
            mysqli_free_result($result);
        }
        else
        {
            if ($result != true && $result != false) {
                mysql_free_result($result);
            }
        }
        unset($result);
    }

    function getLastError() {

        if (function_exists("mysqli_error"))
        {
            return mysqli_error($this->dbLink);
        }
        else
        {
            return mysql_error();
        }
    }

    function getNumRows(&$result) {

        if (function_exists("mysqli_num_rows"))
        {
            $numRows = mysqli_num_rows($result);
        }
        else
        {
            $numRows = mysql_num_rows($result);
        }
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
    function close()
    {

        if (function_exists("mysqli_close"))
        {
            mysqli_close($this->dbLink);
        }
        else
        {
            mysql_close($this->dbLink);
        }
    }




}

