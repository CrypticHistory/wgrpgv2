<?php
	//require_once "../dbconfig.php";

	class Database{
	
		private $_objDB;
		
		public function __construct(){
			global $DBUSER, $DBPASS;
			try{
				$this->_objDB = new PDO("mysql:host=localhost;dbname=dbwgrpg", "root", "");
			}
			catch(PDOException $e){
				print "Error: " . $e->getMessage() . "<br/>";
				die();
			}
		}
		
		public function query($strSQL){
			$rsResult = $this->_objDB->query($strSQL);
			if ($rsResult === false){
				return "Error querying database.";
			}
			else{
				return $rsResult;
			}
		}
		
		public function quote($strSQL){
			return $this->_objDB->quote($strSQL);
		}
		
		public function lastInsertID(){
			return $this->_objDB->lastInsertId();
		}
		
		public function commit(){
			$this->_objDB->commit();
		}
	}
?>