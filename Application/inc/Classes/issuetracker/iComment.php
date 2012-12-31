<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	class iComment {
		protected $dbo;
		protected $dbresults;

		public function __construct(fDatabase $dbo) {
			$this->dbo = $dbo;
			$this->dbresults = new iDBResults();
		}

		public function createComment($issueid, $comment, $user) {
			$statement = $this->dbo->prepare("SELECT userid FROM issueUsers WHERE issueID = %i");
			$result = $this->dbo->query($statement, $issueid);
			$results = $this->dbresults->createResults($result);
			var_dump($results);
			$userExists = FALSE;
			foreach ($results as $res) {
				if (in_array($user,$res)) {
					$userExists = TRUE;
				}
			}
			if (!$userExists) {
				$statement = $this->dbo->prepare("INSERT INTO issueUsers (issueid, userid) VALUES (%i, %i)");
				$this->dbo->query($statement, $issueid, $user);
			}
			
			$statement = $this->dbo->prepare("INSERT INTO comments (issueid, comment, createdby, creationdate) VALUES (%i, %s, %i, CURRENT_TIMESTAMP)");
			if ($this->dbo->query($statement, $issueid, $comment, $user)) {
				return TRUE;
			}
		}

	}

?>