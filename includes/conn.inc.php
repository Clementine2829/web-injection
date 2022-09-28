<?php
    
    include "dbh.inc.php";
	class DB_login extends Dbh {
		public function connect_db($servername, $db_username, $db_password, $db_name, $sql){
			try {
				return $this->connection($servername, $db_username, $db_password, $db_name)->query($sql);
			} catch (Exception $e) {
				$e->getMessage();
				die();
			}
		}
	}
	class DB_login_updates extends Dbh {
		public function connect_db($db){
			try {
				return $this->connection_db($db);			
			} catch (Exception $e) {
				$e->getMessage();
				die();
			}
		}
		private function connection_db($db){
			return $this->connection("localhost", "webhack", "webhack", $db);
		}
	}
	class SQL_results{
		private function connection($db, $sql){
			$db_login = new DB_login();
			return $db_login->connect_db("localhost", "webhack", "webhack", $db, $sql);
		}
		public function results_webhack($sql){
			$db_connection = $this->connection("webhack", $sql);
			return $db_connection;
		}

	}
?>