<?php
Class DB
{
    var $m_conn;

    public function __construct()
    {
        $this->m_conn = new mysqli('127.0.0.1', 'root', '', 'bikeit');
        if($this->m_conn->connect_error)
		{
			die("Could not connect to MySQL server.");
		} 
    }

    public function query($sql)
    {
        return mysqli_query($this->m_conn, $sql);
    }

    public function getDBConnection()
    {
        return $this->m_conn;
    }
} 
?>
