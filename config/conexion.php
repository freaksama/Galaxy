<?php
class MySQL {
    /**
    * MySQL server hostname
    * @access private
    * @var string
    */
    var $host;

    /**
    * MySQL username
    * @access private
    * @var string
    */
    var $dbUser;

    /**
    * MySQL user's password
    * @access private
    * @var string
    */
    var $dbPass;

    /**
    * Name of database to use
    * @access private
    * @var string
    */
    var $dbName;

    /**
    * MySQL Resource link identifier stored here
    * @access private
    * @var string
    */
    var $dbConn;

    /**
    * Stores error messages for connection errors
    * @access private
    * @var string
    */
    var $connectError;

    /**
    * MySQL constructor
    * @param string host (MySQL server hostname)
    * @param string dbUser (MySQL User Name)
    * @param string dbPass (MySQL User Password)
    * @param string dbName (Database to select)
    * @access public
    */
	
	var $transaccion;
	
    function MySQL () {
		
        $host = 'localhost';
        $dbUser = 'root';
        $dbPass = '1234';        
        $dbName = 'red_galaxy'; 
        
		
        $this->host=$host;
        $this->dbUser=$dbUser;
        $this->dbPass=$dbPass;
        $this->dbName=$dbName;
        $this->connectToDb();
    }
	
    /**
    * Establishes connection to MySQL and selects a database
    * @return void
    * @access private
    */
    function connectToDb ()
	{
        // Make connection to MySQL server

        if (!$this->dbConn = @mysql_connect($this->host,
                                      $this->dbUser,
                                      $this->dbPass)) {
            trigger_error('Could not connect to server');
            $this->connectError=true;
            mysql_set_charset('utf8');
        // Select database
        } else if ( !@mysql_select_db($this->dbName,$this->dbConn) ) {
            trigger_error('Could not select database');
            $this->connectError=true;
        }
    }
	
	function Transaccion()
	{
		$this->transaccion = new Transaccion($this->dbConn);
	}
	
    /**
    * Checks for MySQL errors
    * @return boolean
    * @access public
    */
    function isError ()
	 {
        if ( $this->connectError )
            return true;
        $error=mysql_error ($this->dbConn);
        if ( empty ($error) )
            return false;
        else
            return true;
    }

    /**
    * Returns an instance of MySQLResult to fetch rows with
    * @param $sql string the database query to run
    * @return MySQLResult
    * @access public
    */
    function query($sql)
	{
        if (!$queryResource=mysql_query($sql,$this->dbConn))
		{
				trigger_error ('Query failed: '.mysql_error($this->dbConn).' SQL: '.$sql);
		}
            
        return new MySQLResult($this,$queryResource);
    }
	
	
	
	
}//end class mysql

/**
* MySQLResult Data Fetching Class
* @access public
* @package SPLIB
*/
class MySQLResult 
{
    /**
    * Instance of MySQL providing database connection
    * @access private
    * @var MySQL
    */
    var $mysql;

    /**
    * Query resource
    * @access private
    * @var resource
    */
    var $query;

    /**
    * MySQLResult constructor
    * @param object mysql   (instance of MySQL class)
    * @param resource query (MySQL query resource)
    * @access public
    */
    function MySQLResult( $mysql,$query)
	{
        $this->mysql=& $mysql;
        $this->query=$query;
    }

    /**
    * Fetches a row from the result
    * @return array
    * @access public
    */
    function fetch () 
	{
        if ( $row=mysql_fetch_array($this->query,MYSQL_ASSOC) )
		{
            return $row;
        } else if ( $this->size() > 0 ) 
		{
            mysql_data_seek($this->query,0);
            return false;
        } else 
		{
            return false;
        }
    }//end fetch
	
	function fetchRow()
	{
		 if ( $row=mysql_fetch_row($this->query) )
		{
            return $row;
        } else if ( $this->size() > 0 ) 
		{
            mysql_data_seek($this->query,0);
            return false;
        } else 
		{
            return false;
        }
	}//end fetchRow
	

    /**
    * Returns the number of rows selected
    * @return int
    * @access public
    */
    function size () 
	{
        return mysql_num_rows($this->query);
    }
    /**
    * Returns the number of rows affected
    * @return int
    * @access public
    */	
	 function affectedRows ()
	 {
        return mysql_affected_rows($this->mysql->dbConn);
    }

    /**
    * Returns the ID of the last row inserted
    * @return int
    * @access public
    */
    function insertID () 
	{
        return mysql_insert_id($this->mysql->dbConn);
    }
    
    /**
    * Checks for MySQL errors
    * @return boolean
    * @access public
    */
    function isError ()
	{
        return $this->mysql->isError();
    }
}//end mysqlResult

/**********************************************************************************/
/* Transacciones con PHP - MYSQL */
/**********************************************************************************/

class Transaccion/* Nombre de la clase */
{
	
	private $Cnn; /* Variable de conexxion */
	
	/****************************************/
	function Transaccion($Con)
	{
		//mysql_disconnect($this->Cnn); /* Desconecta la conexion a la BD */
		$this->Cnn=$Con;
		//
	}
	
	/****************************************/
	function begin()
	{
		mysql_query("BEGIN",$this->Cnn); /* Abre la transaccion */
	}
	
	/****************************************/
	function rollback()
	{
		mysql_query("ROLLBACK",$this->Cnn); /* Deshace la transaccion */
	}
	
	/****************************************/
	function commit()
	{
		mysql_query("COMMIT ", $this->Cnn); /* Ejecuta la transaccion */
	}
}//end Class

?>