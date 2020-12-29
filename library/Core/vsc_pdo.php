<?php

/**
 * T6.13.05.2016 - Build core to handle mysql with PDO
 * @author LUCTV
 *
 */
class vsc_pdo {

    private $server; // database server
    private $username; // database login name
    private $password; // database login password
    private $database; // database name
    public $conn;
    public $query_id;

    /**
     * Build PDO connection
     * @param string $conn
     */
    function __construct($conn = null) {
        $this->getConnection($conn);

        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->database", $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    function query($sql) {
        $stmt = $this->conn->prepare($sql);
       	if($stmt->execute()) return true;
        return false;
    }

    function fetch_one($sql) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $row = $stmt->fetch();
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    function fetch_one_fields($table, $field, $where=null){
    	$where = ($where==''||$where==null) ? "1=1" : $where;
    	$sql = "SELECT $field FROM $table WHERE $where";
    	$result = $this->fetch_one($sql);
    	$str = @$result[$field];
    	if($result && count(explode(",", $field))>1){
    		$a_field = explode(",", $field);
    		$a_result = array();
    		foreach ($a_field AS $item){
    			$a_result[] = @$result[$item];
    		}
    		$str = implode(", ", $a_result);
    	}
    	return $str;
    }

    function fetch_all($sql) {
        try {
            $stmt = @$this->conn->prepare($sql);
            @$stmt->execute();
            $rows = @$stmt->fetchAll();
            return $rows;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    function fetch_array_field($table, $field, $where=null){
        $where = ($where==''||$where==null) ? "1=1" : $where;
        $sql = "SELECT $field FROM $table WHERE $where";
        $result = $this->fetch_all($sql);
        $a_field = array();
        foreach ($result AS $k=>$item){
            $a_field[] = $item[$field];
        }
        return $a_field;
    }

    function check_exist($sql) {
        try {
            $stmt = @$this->conn->prepare($sql);
            @$stmt->execute();
            $number = @$stmt->rowCount();
            if ($number > 0) return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    function insert($table, $data) {
        try {
            if (count($data) == 0) return false;
            
            $sql = "INSERT INTO $table (" . implode(", ", array_keys($data)) . ") VALUES (:" . implode(", :", array_keys($data)) . ")";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute($data)) return $this->conn->lastInsertId();
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    function update($table, $data, $where) {
        try {
            if (count($data) == 0) return false;

            $values = array();
            foreach ($data AS $key => $item) {
                $values[] = $key . "=:" . $key;
            }

            $sql = "UPDATE $table SET " . implode(", ", $values);
            if ($where != "") $sql .= " WHERE " . $where;
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute($data)) return true;
            else return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    function count_rows($sql) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    
    function count_item($table, $where=null){
    	if($where!='' && $where!=null) $where = " AND " . $where;
    	$result = $this->fetch_one("SELECT COUNT(1) AS number FROM $table a WHERE 1=1 $where");
    	return intval(@$result['number']);
    }
    
    function count_custom($sql){
        $result = $this->fetch_one($sql);
        return intval(@$result['number']);
    }
    
    function close() {
        $this->conn = NULL;
    }

    /**
     * Set values connection
     * @param string $conn
     */
    function getConnection($conn = null) {
        if ($conn == null || count(explode(",", $conn)) != 4)
            $conn = CONN_DEFAULT;

        $arr = explode(",", $conn);

        $this->server = @$arr[0];
        $this->username = @$arr[1];
        $this->password = @$arr[2];
        $this->database = @$arr[3];
    }

}

?>