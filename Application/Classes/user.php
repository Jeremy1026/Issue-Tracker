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
		protected $dbresults;

		public function __construct(fDatabase $dbo) {
			$this->dbo = $dbo;
			$this->dbresults = new DBResults();
		}

		public function createUser($name, $email) {
			$statement = $this->dbo->prepare("INSERT INTO users (name, email) VALUES (%s, %s)");
			$this->dbo->query($statement, $name, $email);
		}

		public function getUser($id, $json = false) {
			$statement = $this->dbo->prepare("SELECT * FROM users WHERE id = %i");
			$result = $this->dbo->query($statement, $id);

			return $this->dbresults->createResults($result, $json);
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

			return $this->dbresults->createResults($result, $json);
		}

		protected function searchByEmail($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM users WHERE email like %s");
			$result = $this->dbo->query($statement, '%'.$search.'%');

			return $this->dbresults->createResults($result, $json);
		}

 	}

?>