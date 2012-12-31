<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	class iUser {
		public    $name;
		public    $email;
		public    $id;
		protected $results;
		protected $dbo;
		protected $dbresults;

		public function __construct(fDatabase $dbo) {
			$this->dbo = $dbo;
			$this->dbresults = new iDBResults();
		}

		public function createUser($first_name, $last_name, $email, $password) {
			$statement = $this->dbo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (%s, %s, %s, %s)");
			$this->dbo->query($statement, $first_name, $last_name, $email, $password);
			echo "create";
		}
		
		public function checkLogin($email, $password) {
			$statement = $this->dbo->prepare("SELECT id, password FROM users WHERE email = %s");
			$result = $this->dbo->query($statement, $email);
			$results = $this->results = $this->dbresults->createResults($result, FALSE);
		var_dump($results);
			if (fCryptography::checkPasswordHash($password, $results[0]['password'])) {
 				return $results[0]['id'];
			}	
			else {
				return FALSE;
			}
		}

		public function getUser($id, $json = false) {
			$statement = $this->dbo->prepare("SELECT first_name, last_name, email FROM users WHERE id = %i");
			$result = $this->dbo->query($statement, $id);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			$this->name = $this->results[0]['first_name'].' '.$this->results[0]['last_name'];
			$this->email = $this->results[0]['email'];
			return TRUE;
		}
		
		public function getUserNames($json = true) {
			$statement = $this->dbo->prepare("SELECT id, first_name, last_name FROM users");
			$result = $this->dbo->query($statement);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			echo $results;
			return $results;
		}

		public function searchUsers($type, $search, $json = false) {
			switch ($type) {
				case 'name':
					return($this->searchByName($search, $json));
				break;
				case 'email':
					return($this->searchByEmail($search, $json));
				break;
				default:
				break;
			}
		}

		protected function searchByName($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM users WHERE name like %s");
			$result = $this->dbo->query($statement, '%'.$search.'%');
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

		protected function searchByEmail($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM users WHERE email like %s");
			$result = $this->dbo->query($statement, '%'.$search.'%');
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

 	}

?>