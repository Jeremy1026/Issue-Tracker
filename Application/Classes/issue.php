<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	class Issue {
		protected $dbo;
		protected $dbresults;

		public function __construct(fDatabase $dbo) {
			$this->dbo = $dbo;
			$this->dbresults = new DBResults();
		}

		public function createIssue($title, $description, $user, $users, $tags) {
			$date = date('d-m-Y H:i:s');
			$statement = $this->dbo->prepare("INSERT INTO issues (title, description, createdby, users, tags, creationdate, updatedate) VALUES (%s, %s, %i, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
			$this->dbo->query($statement, $title, $description, $user, $users, $tags);
		}

		public function updateIssue($title, $description, $user, $users, $tags) {
			$date = date('d-m-Y H:i:s');
		}

		public function deleteIssue($title, $description, $user, $users, $tags) {
			$date = date('d-m-Y H:i:s');
			$statement = $this->dbo->prepare("INSERT INTO issues (title, description, createdby, users, tags, creationdate, updatedate) VALUES (%s, %s, %i, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
			$this->dbo->query($statement, $title, $description, $user, $users, $tags);
		}

		public function getIssue($id, $json = false) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE id = %i");
			$result = $this->dbo->query($statement, $id);

			return $this->dbresults->createResults($result, $json);
		}

		public function getAllIssues($json = false) {
			$statement = $this->dbo->prepare("SELECT * FROM issues");
			$result = $this->dbo->query($statement);

			return $this->dbresults->createResults($result, $json);

		}

		public function searchIssues($type, $search, $json = false) {
			switch ($type) {
				case 'tag':
					return($this->searchByTag($search, $json));
				break;
				case 'user':
					return($this->searchByUser($search, $json));
				break;
				case 'bcreated':
					return($this->searchBeforeCreatedDate($search, $json));
				break;
				case 'acreated':
					return($this->searchAfterCreatedDate($search, $json));
				break;
				case 'bupdated':
					return($this->searchBeforeUpdatedDate($search, $json));
				break;
				case 'aupdated':
					return($this->searchAfterUpdatedDate($search, $json));
				break;
				case 'status':
					return($this->searchByStatus($search, $json));
				break;
				default:
				break;
			}
		}

		protected function searchByTag($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE tags like %s");
			$result = $this->dbo->query($statement, '%'.$search.'%');

			return $this->dbresults->createResults($result, $json);
		}

		protected function searchByUser($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE createdby = %i");
			$result = $this->dbo->query($statement, $search);

			return $this->dbresults->createResults($result, $json);
		}

		protected function searchBeforeCreatedDate($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE creationdate <= %s");
			$result = $this->dbo->query($statement, $search);

			return $this->dbresults->createResults($result, $json);
		}

		protected function searchAfterCreatedDate($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE creationdate >= %s");
			$result = $this->dbo->query($statement, $search);

			return $this->dbresults->createResults($result, $json);
		}

		protected function searchBeforeUpdatedDate($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE updatedate <= %s");
			$result = $this->dbo->query($statement, $search);

			return $this->dbresults->createResults($result, $json);
		}

		protected function searchAfterUpdatedDate($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE updatedate >= %s");
			$result = $this->dbo->query($statement, $search);

			return $this->dbresults->createResults($result, $json);
		}

		protected function searchByStatus($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE status = %i");
			$result = $this->dbo->query($statement, $search);

			return $this->dbresults->createResults($result, $json);
		}

 	}

?>