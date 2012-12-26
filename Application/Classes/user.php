<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	class User {
		public    $name;
		public    $email;
		public    $id;
		protected $results = array();
		protected $dbo;

		public function __construct(fDatabase $dbo) {
			$this->dbo = $dbo;
		}

		public function createUser(fDatabase $dbo, $n, $e) {
			$statement = $dbo->prepare("INSERT INTO users (name, email) VALUES (%s, %s)");
			$dbo->query($statement, $n, $e);
		}

		public function getUser( $id, $json = false) {
			$statement = $this->dbo->prepare("SELECT * FROM users WHERE id = %i");
			$result = $this->dbo->query($statement, $id);
			foreach ($result as $row) {
				$this->name  = $row['name'];
				$this->email = $row['email'];
				$this->id    = $row['id'];
			}

			if ($json == true) {
				return json_encode(array('name'=>$this->name, 'email'=>$this->email, 'id'=>$this->id));
			}
			else {
				return array('name'=>$this->name, 'email'=>$this->email, 'id'=>$this->id);
			}
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
			foreach ($result as $row) {
				$this->results[] = $row;
			}

			if ($json == true) {
				return json_encode($this->results);
			}
			else {
				return $this->results;
			}
		}

		protected function searchByEmail($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM users WHERE email like %s");
			$result = $this->dbo->query($statement, '%'.$search.'%');
			$this->results = array('');
			foreach ($result as $row) {
				$this->results[] = $row;
			}

			if ($json == true) {
				return json_encode($this->results);
			}
			else {
				return $this->results;
			}
		}

 	}

?>