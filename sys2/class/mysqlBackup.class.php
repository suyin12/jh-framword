<?php

/* * *
 *
 * Copyright (c) 2011, Yves BOURVON. <groovyprog AT gmail DOT com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the names of Yves Bourvon, Groovyprog, phpBackup4MySQL nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * * */

/**
 *
 * Class phpBackup4MySQL file
 *
 * This file contains the phpBackup4MySQL class with all its methods
 *
 * @author Yves Bourvon
 *
 */
class phpBackup4MySQL {

    public $pdo;
    protected $sql_dump;
    protected $sql_dump_constraints;

    /**
     *
     * Generates the MySQL backup
     *
     * @param mixed $dbconnect
     *
     * @return string $sql_dump
     *
     */
    public function backupSQL($dbconnect = null) {



        if ($dbconnect == null)
            $dbconnect = $this->dbconnect();

        if (is_array($dbconnect)) {
            $dbh = $dbconnect['dbh'];
            $dbName = $dbconnect['dbName'];
        } else {
            $dbh = $dbconnect;
            $dbName = DBNAME;
        }

        // Create header for sql dump
        // Including Php and MySql versions
        $stmtVer = $dbh->query("SELECT VERSION() AS ver");
        $resultVer = $stmtVer->fetch();
        $sql_dump = "-- SQL Dump\n-- Exported with phpBackup4MySQL\n-- http://www.groovyprog.com\n--\n-- Php version: " . phpversion() . " / MySQL version: " . $resultVer['ver'] . "\n-- Date: " . date("d-M-Y") . "\n--\n-- Database: `" . $dbName . "`\n\n";

        // Initialise sql dump constraints variable
        $sql_dump_constraints = '';
        $sql_dump_constraints_end = '';

        // IGNORE FOREIGN KEYS if constant set to true
        if (IGNORE_FOREIGN_KEYS) {
            $sql_dump .="SET FOREIGN_KEY_CHECKS=0;\n\n";
            $sql_dump_constraints_end = "\n\nSET FOREIGN_KEY_CHECKS=1;\n\n";
        }

        // NO_AUTO_VALUE_ON_ZERO if constant set to true
        if (NO_AUTO_VALUE)
            $sql_dump.="SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n\n";

        // Show tables query
        $sqlTables = 'SHOW TABLES';
        $stmtTables = $dbh->query($sqlTables);
        $resultTables = $stmtTables->fetchAll(PDO::FETCH_ASSOC);

        // Fetch tables
        foreach ($resultTables as $table) {



            $tableName = $table['Tables_in_' . $dbName . ''];

            $table_sql_dump = $this->createTableQuery($dbh, $tableName);
            $table_field_dump = $this->insertFieldsList($dbh, $tableName);
            $table_data_dump = $this->insertDataContent($dbh, $tableName);

            $sql_dump .= $table_sql_dump['sql_create'];
            if ($table_data_dump != '') {
                $sql_dump .= $table_field_dump;
                $sql_dump .= $table_data_dump;
            }
            else
                $sql_dump .= "\n\n\n-- -----------------------------------------------------------------------------------------\n\n\n";

            $sql_dump_constraints .= $table_sql_dump['sql_constraints'];
        }

        $this->closeDB($dbh);
        $tt = $sql_dump . $sql_dump_constraints . $sql_dump_constraints_end;
        return $tt;
    }

    /**
     *
     * Generates table based create query
     *
     * @param  PDO $dbh
     * @param  string $tableName
     *
     * @return array $tableResult
     *
     */
    protected function createTableQuery($dbh, $tableName) {


        $dbh->query("SET NAMES 'UTF8'");
        // Construct "create table" statement
        $sqlCreateBuild = "SHOW CREATE TABLE `$tableName`";
        $stmtCreate = $dbh->query($sqlCreateBuild);
        $resultCreate = $stmtCreate->fetchAll(PDO::FETCH_COLUMN, 1);
        if (DROP_TABLE) {
            $sqlCreate = "DROP TABLE IF EXISTS `$tableName`;\n\n";
        } else {
            $sqlCreate = "";
        }
        $sqlCreate .= preg_replace("/CREATE TABLE/", "CREATE TABLE IF NOT EXISTS", $resultCreate[0]);



        // Initialize 'constraints only' string that will contain seperate constraint statement extracted from queries if IGNORE_FOREIGN_KEYS true
        $sqlCreateResult = "\n--\n-- Table '" . $tableName . "' creation.\n--\n\n";
        $constraintsOnly = '';



        // If IGNORE_FOREIGN_KEYS true, split create tabble queries into actual create table and conttraints that will then after alter tables.
        if (IGNORE_FOREIGN_KEYS) {

            $constraintsOnly = preg_replace("/\) ENGINE=.*/s", "", $sqlCreate);
            $constraintsOnly_splitted = explode('CONSTRAINT', $constraintsOnly, 2);

            if (isset($constraintsOnly_splitted[1])) {
                $constraintsOnly = "\n\n\n--\n-- Constraints for table '" . $tableName . "'\n--\n\nALTER TABLE `" . $tableName . "`\n  " . preg_replace("/CONSTRAINT/", "ADD CONSTRAINT", 'CONSTRAINT ' . trim($constraintsOnly_splitted[1]) . ";");
            } else {
                // Safety, shouldn't occur
                $constraintsOnly = '';
            }

            // Append $sqlCreateResult variable
            $sqlCreateResult .= preg_replace("/,\n  CONSTRAINT.*\) ENGINE=InnoDB/s", "\n) ENGINE=InnoDB", $sqlCreate) . ";\n\n\n";
        } else {
            // Append $sqlCreateResult variable with standard create query (i.e case: no constraints)
            $sqlCreateResult .= $sqlCreate;
        }

        // Put results in an array and return result
        $tableResult = array('sql_create' => $sqlCreateResult, 'sql_constraints' => $constraintsOnly);
        return $tableResult;
    }

    /**
     *
     * Generates table based insert header of the query that includes the fields list
     *
     * @param  PDO $dbh
     * @param  string $tableName
     *
     * @return string $data_dump
     *
     */
    protected function insertFieldsList($dbh, $tableName) {



        $sqlData = 'SHOW COLUMNS FROM `' . $tableName . '`';
        $stmtData = $dbh->query($sqlData);
        $resultData = $stmtData->fetchAll(PDO::FETCH_ASSOC);

        // Prepare fields names header for query
        $fieldNames = "( `";
        $count = 0;
        foreach ($resultData as $field) {
            $count++;
            // Add field name
            $fieldNames .= $field['Field'];

            // If end of field list no reached, seperate with coma
            if ($count != count($resultData)) {
                $fieldNames .= "`, `";
                continue;
            }
            // End of list close with bracket
            $fieldNames .= "` )";
        }

        // Initalize INSERT query header.
        $data_dump = "--\n-- Dump data of `$tableName` \n--\n\n";
        $data_dump .= 'INSERT INTO `' . $tableName . '` ' . $fieldNames . ' VALUES ';

        return $data_dump;
    }

    /**
     *
     * Generates table based insert part of the query that includes the data to be inserted
     *
     * @param  PDO $dbh
     * @param  string $tableName
     *
     * @return string $result
     *
     */
    protected function insertDataContent($dbh, $tableName) {



        // Initialize variable result
        $result = "";
        $dbh->query("SET NAMES 'UTF8'");
        // Get table types
        $sqlTypes = 'SHOW COLUMNS FROM `' . $tableName . '`';
        $stmtTypes = $dbh->query($sqlTypes);
        $resultTypes = $stmtTypes->fetchAll(PDO::FETCH_ASSOC);

        $types = array();
        foreach ($resultTypes as $typeField) {

            // Add Type name
            $types[] .= $typeField['Type'];
        }


        // Initialize the result buffer for a single row (the buffer allows checking for the size of the query before appending to the whole $result string
        $resultBufferRow = "";

        // Flag for MAX_QUERY_SIZE: if exceeded, split queries process
        $overSize = false;

        // Cycle all row of table
        $sqlData = "SELECT * FROM `$tableName`";
        $stmtData = $dbh->query($sqlData);
        $resultData = $stmtData->fetchAll(PDO::FETCH_NUM);

        // Iterator for number of rows
        $countRow = 0;

        // Fetch rows
        foreach ($resultData as $dataRow) {

            // Initialize the result buffer for Data
            $resultBufferData = "";

            // If MAX_QUERY_SIZE not met append resultBuuferRow with start of line characters
            if (!$overSize) {
                $resultBufferRow .= "\n(";
            }

            // Iterator for fields values
            $countFields = 0;
            foreach ($dataRow as $key => $value) {

                if (is_null($value)) {
                    // If data type in field is NULL, append NULL to data buffer
                    $resultBufferData .= "NULL";
                } else if (is_numeric($value) && (!stristr($types[$key], "char") > 0) && (!stristr($types[$key], "timestamp") > 0) && (!stristr($types[$key], "blob") > 0) && (!stristr($types[$key], "text") > 0)/* && $fields->type != "string" && $fields->type != "timestamp" */) {
                    // If data is_numeric -but is not either char, nor blob nor timestamp nor text(either could be seen as numeric if containing only numbers)- use raw data
                    $resultBufferData .= $value;
                } else {

                    // Otherise treat data as sting and embedd in brackets, escape mysql unwanted characters using quote()
                    // To do : treat binary BLOB data as real binary data
                    if (isset($value)) {
                        // Escape unwanted characters
                        $value = $dbh->quote($value);
                        $resultBufferData .= "$value";
                    }
                    else
                        $resultBufferData .= "\'\'";
                }

                if ($countFields < ( count($dataRow) - 1 ))
                    $resultBufferData .= ", ";

                $countFields++;
            }


            // Have we reached end of statemtement ?
            // Yes, close with simple bracket
            if ($countRow == count($resultData) - 1)
                $resultBufferData .= ")";
            // No, close with bracket followed by coma
            else
                $resultBufferData .= "),";

            $countRow++;

            // Is the MAX_QUERY_SIZE reach for the current query being prepared ?
            // If so, close the query with ';' and start a new query line, set  oversize flag to true to avoid reiserting start of query as it is done here.
            // Reset buffers.
            if (strlen($resultBufferRow) + strlen($resultBufferData) > MAX_QUERY_SIZE) {
                // Look for en of line and replace by end of statement i.e. ;
                $result .= preg_replace('/\).{1,3}\(\Z/s', ');', $resultBufferRow) . "\n";
                // Start a new query line for the current table
                $resultBufferRow = "INSERT INTO `$tableName` VALUES \n(" . $resultBufferData;
                $resultBufferData = "";
                $oversize = true;
            }
            // MAX_QUERY_SIZE not reached: append the Data to the $resultBufferRow
            else {
                $resultBufferRow .= $resultBufferData;
            }
        }


        // Close INSERT instruction: append the buffer row to the whole result string and reset oversize flag
        if ($resultBufferRow != "") {
            $result .= $resultBufferRow . ";\n";
            $result .= "\n\n\n-- -------------------------------------------------------------------------------------------\n\n\n";
        }
        else
            $result = "";

        $oversize = false;

        // Return $result
        return $result;
    }

    /**
     *
     * Handle the connexion to the database
     *
     * @param  string $dbName
     * @param  string $user
     * @param  string $pass
     * @param  string $host
     *
     * @return PDO $dbh
     *
     */
    public function dbconnect() {
        $dbh = $this->pdo;
        return $dbh;
    }

    /**
     *
     * Save the MySQL database 'dump' to file
     *
     * @param string $sql_dump
     * @param mixed $dbconnect
     *
     * @return boolean
     *
     */
    public function saveFile($sql_dump, $dbconnect = null) {



        if ($dbconnect == null)
            $dbName = DBNAME;

        if (is_array($dbconnect)) {
            $dbName = $dbconnect['dbName'];
        } else {
            $dbName = DBNAME;
        }


        //Create variable to handle backup file path which will be the concatenation of root backup
        //directory and database name directory so that each database backup has its own directory

        $path = BACKUP_DIRECTORY . "/";


        //Check if the backups storing directory exists
        if (!is_dir($path)) {
            // if not, cretae it
            if (!mkdir($path)) {
                // To do: error handling (exception)
                echo "error creating directory";
            }
        }

        // Flag for empty directory
        $emptyFlag = true;

        //Initialize array $suffixes to store indexes of backup files listed in the backup directory
        $suffixes = array();
        $files = array();
        //Fetch the content of backup directory
        foreach (glob($path . "*.sql") as $val)
        //If the $val is not null
            if (!is_null($val)) {

                //Extract indexes (suffixes) from backup names
                $listSuffix = preg_replace("/.*-/", "", $val);
                $listSuffix = str_replace(".sql", "", $listSuffix);

                //Store indexes in array
                $suffixes [] .= $listSuffix;

                //Determine what is the maximun value as for suffixes, created backup will be
                //incremented from that value on
                $suffix = max($suffixes) + 1;

                //directory has been browsed, this is not an empty directory, change Flag status
                $emptyFlag = false;
            }

        //Case directory is empty
        if ($emptyFlag) {

            //Set suffix to 1 as this will be the index for the first created backup
            $suffix = 1;
            //Empty fag to true to test the status for next check
            $emptyFlag = true;
        }

        //Create File, which name is "backup_" + date + suffix
        $file = fopen($path . "backup_" . $dbName . "_" . date('Ymd') . "-" . $suffix . ".sql", "w+");
        //Encode the file to utf8
        if (fwrite($file, $sql_dump)) {
            //Close the file
            fclose($file);

            //New backup is done we can now proceed to older backup deletion:
            //If the number of stored backups in limited and the number of stored backup exceeds
            //the limit set by config
            if (NUM_BACKUP_FILES_KEPT != 0 && count(glob($path . "*.sql")) > NUM_BACKUP_FILES_KEPT) {

                //Store number of files present in backup directory
                $filesCount = count(glob($path . "*.sql"));

                //Do the following erase loop the number of time the number of present files
                //exceed the files limit number
                for ($i = 0; $i < $filesCount - NUM_BACKUP_FILES_KEPT; $i++) {


                    //Initialise
                    $listSuffix = null;
                    $suffixes = null;

                    //Initialize array to sore files
                    $files = null;

                    //Fetch the content of directory
                    foreach (glob($path . "*.sql") as $val) {

                        //Extract the index number
                        $listSuffix = preg_replace("/.*-/", "", $val);
                        $listSuffix = str_replace(".sql", "", $listSuffix);
                        //Store in array the indexes
                        $suffixes [] .= $listSuffix;
                        //Store in array the files names
                        $files [] .= $val;
                    }

                    //Fetch the array that holds the file names present in the folder
                    foreach ($files as $unlinkThat) {


                        //Create string for occurence of mininimun suffix value amongst
                        //present files checking
                        $occurence = "-" . min($suffixes) . ".sql";

                        //Does the string looked for occur in file names (i.e. is this the
                        //lowest index amongst files)
                        $pos = strpos($unlinkThat, $occurence);
                        if ($pos != false) {
                            // Yes, if this file still exist -it could have been removed in
                            // some previous loop- erase file because this is the oldest in
                            // backup history since index is chronological
                            if (is_File($unlinkThat))
                                unlink($unlinkThat);
                        }
                    }
                    //If the number of files to be kept is not STRICT according to
                    //config settings, break loop because we are just erasing one file
                    //in that case

                    if (STRICT_NUM_BACKUP_FILES == FALSE)
                        break $i;
                }
            }



            //File backup has been correctly written
            return true;
        }
        else {
            // Close file
            fclose($file);
            // An error occured while saving file
            return false;
        }
    }

    /**
     *
     * Restore the MySQL backup to database
     *
     *
     * @param string $backup
     * @param mixed $dbconnect
     *
     *
     *
     */
    public function restoreSQL($backup, $dbconnect = null) {



        if ($dbconnect == null)
            $dbconnect = $this->dbconnect();


        if (is_array($dbconnect)) {
            $dbName = $dbconnect[0];
            $dbh = $dbconnect[1];
        } else {
            $dbh = $dbconnect;
            $dbName = DBNAME;
        }


        try {
            $dbh->exec("CREATE DATABASE IF NOT EXISTS `$dbName`;");
            $dbh->exec("USE `$dbName`;");
        } catch (PDOException $e) {
            die("Erreur restore connect: " . $e->getMessage());
        }






        $file = file($backup);

        $linebuffer = '';
        $error = false;
        $queryCount = 0;
        foreach ($file as $line) {
            if (preg_match('/--.*\Z/', $line) OR preg_match('/^\Z/', $line)) {
                continue;
            }

            if (preg_match('/;\Z/', trim($line))) {

                $linebuffer .=$line;
                $sqlQuery = $dbh->exec(utf8_decode($linebuffer));
                $queryCount++;

                $linebuffer = '';
            } else {
                $linebuffer .=$line;
            }
        }
        $this->closeDB($dbh);
        return true;
    }

    /**
     *
     * Close the connexion to the database
     *
     * @param  PDO $dbh
     *
     *
     */
    public function closeDB($dbh) {



        try {
            $dbh = NULL;
        } catch (PDOException $e) {
            die("Error (closedb): " . $e->getMessage());
        }
    }

}

?>