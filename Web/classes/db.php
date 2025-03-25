<?php

class DB {
	static private $instance = null;
	private $mysqli;
	
	private function connection() {
		$this->mysqli = new mysqli(HOST, MYSQL_USER, MYSQL_PASSWORD, MYDB);
		$this->query("set names 'utf8'");
	}
	
	public static function getInstance() {
		if (self::$instance == null) {
			//var_dump("First time! :-)");
			self::$instance = new DB();
			self::$instance->connection();
		}
		return self::$instance;
	}
	
	public function queryS($sql) {
		$rows = array();
		
		/* Log querys */
		// $fp = fopen('tmp/bbdd.log', 'a+');
		// fwrite($fp, $sql ."\n ---------------------------------- \n");
		// fclose($fp);
		
		$result = $this->mysqli->query($sql);
		
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$rows[] = $row;	
		};
		$result->free();
		return $rows;
	}

	public function real_escape_string($string) {	
		return $this->mysqli->real_escape_string($string);
	}
	
	public function query($sql) {	
		$result = $this->mysqli->query($sql);
		
		// if (!$result){
			// printf("Errorquery: %s\n", $sql);
			// printf("Errormessage: %s\n", $this->mysqli->error);
		// } else {
			// printf("Query: %s\n", $sql);
			// printf("AffectedRows: %s\n", $this->mysqli->affected_rows);
		// }
		
		return $result;
	}
	
	public function insertId() {	
		$id = $this->mysqli->insert_id;
		return $id;
	}	
	
	
	public function affectedRows() {	
		$affeced_rows = $this->mysqli->affected_rows;
		return $affeced_rows;
	}	
}
?>