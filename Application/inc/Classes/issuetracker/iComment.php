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
			$statement = $this->dbo->prepare("INSERT INTO comments (issueid, comment, createdby, creationdate) VALUES (%i, %s, %i, CURRENT_TIMESTAMP)");
			$this->dbo->query($statement, $issueid, $comment, $user);
		}

	}

?>