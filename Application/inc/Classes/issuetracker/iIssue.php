<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	class iIssue {
		protected $dbo;
		protected $dbresults;

		public function __construct(fDatabase $dbo) {
			$this->dbo = $dbo;
			$this->dbresults = new iDBResults();
		}

		public function createIssue($title, $description, $user, $users, $tags) {
			$date = date('d-m-Y H:i:s');
			$statement = $this->dbo->prepare("INSERT INTO issues (title, description, createdby, users, tags, creationdate, updatedate) VALUES (%s, %s, %i, %s, %s, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
			$this->dbo->query($statement, $title, $description, $user, $users, $tags);
		}

		public function updateIssue($id, $title, $description, $users, $tags) {
			$date = date('d-m-Y H:i:s');
			$statement = $this->dbo->prepare("UPDATE issues SET title = %s, description = %s, users = %s, tags = %s, updatedate = CURRENT_TIMESTAMP WHERE id = %i");
			$this->dbo->query($statement, $title, $description, $users, $tags, $id);
		}

		public function deleteIssue($id) {
			$statement = $this->dbo->prepare("DELETE FROM issues WHERE id = %i");
			$this->dbo->query($statement, $id);
		}

		public function getIssue($id, $json = false) {
			$istatement = $this->dbo->prepare("SELECT * FROM issues WHERE id = %i");
			$iresult = $this->dbo->query($istatement, $id);

			$iresults = $this->dbresults->createResults($iresult);

			$this->dbresults->results = array();
			$cstatement = $this->dbo->prepare("SELECT * FROM comments WHERE issueid = %i");
			$cresult = $this->dbo->query($cstatement, $id);

			$cresults = array('comments'=>$this->dbresults->createResults($cresult));
			$results = array_merge($iresults, $cresults);
			if ($json) {
				return json_encode($results);
			}
			else {
				return $results;
			}
		}

		public function getAllIssues($json = false) {
			$statement = $this->dbo->prepare("SELECT * FROM issues");
			$result = $this->dbo->query($statement);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
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
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

		protected function searchByUser($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE createdby = %i");
			$result = $this->dbo->query($statement, $search);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

		protected function searchBeforeCreatedDate($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE creationdate <= %s");
			$result = $this->dbo->query($statement, $search);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

		protected function searchAfterCreatedDate($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE creationdate >= %s");
			$result = $this->dbo->query($statement, $search);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

		protected function searchBeforeUpdatedDate($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE updatedate <= %s");
			$result = $this->dbo->query($statement, $search);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

		protected function searchAfterUpdatedDate($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE updatedate >= %s");
			$result = $this->dbo->query($statement, $search);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

		protected function searchByStatus($search, $json) {
			$statement = $this->dbo->prepare("SELECT * FROM issues WHERE status = %i");
			$result = $this->dbo->query($statement, $search);
			$results = $this->results = $this->dbresults->createResults($result, $json);
			$this->dbresults->results = array();
			return $results;
		}

 	}

?>