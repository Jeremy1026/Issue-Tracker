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
		protected $smtp;

		public function __construct(fDatabase $dbo) {
			$this->dbo = $dbo;
			$this->dbresults = new iDBResults();
			$this->smtp = new fSMTP('smtp.gmail.com', 465, TRUE, 5);
			$this->smtp->authenticate('jeremy1026@gmail.com', 'Zaq1xswcde');
		}

		public function createComment($issueid, $comment, $user) {
			$statement = $this->dbo->prepare("SELECT userid FROM issueUsers WHERE issueID = %i");
			$result = $this->dbo->query($statement, $issueid);
			$results = $this->dbresults->createResults($result);

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
				$this->alertUsers($issueid);
				return TRUE;
			}
		}
		
		public function alertUsers($issueid) {
			$this->dbresults->results = array();
			$statement = $this->dbo->prepare("SELECT u.userid, i.title FROM issueUsers u JOIN issues i ON u.issueid = i.id  WHERE issueID = %i");
			$result = $this->dbo->query($statement, $issueid);
			$results = $this->dbresults->createResults($result);
//			var_dump($results);
			foreach ($results as $user) {
				$this->dbresults->results = array();
				$statement = $this->dbo->prepare("SELECT email, first_name, last_name FROM users WHERE id = %i");
				$result = $this->dbo->query($statement, $user['userid']);
				$results = $this->dbresults->createResults($result);
				$email = new fEmail();
				$email->addRecipient($results[0]['email'], $results[0]['first_name'].' '.$results[0]['last_name']);
				$email->setFromEmail('jeremy1026@gmail.com');
				$email->setSubject("Update to Issue #$issueid - {$user['title']}");
	
				//TODO: THIS NEEDS TO BE FIXED FOR A PRODUCTION ENVIONMENT
				$lastSlash = strchr($_SERVER['REQUEST_URI'], 'Application/', TRUE);
				$url = 'http://'.$_SERVER['SERVER_NAME'].$lastSlash."application/ticket/$issueid";

				echo $url."<br>";

				$email->setBody("{$results[0]['first_name']},
							
							This email is being sent as a notification to let you know that a comment has been posted to Issue #$issueid - {$user['title']}. You can view this comment by viewing the ticket at $url. 
							
							Thank You,
							Administrator",TRUE);

				$email->send($this->smtp);
				//mail($results[0]['email'],'Speed Test','Testing speed in normal mail');
			}
		}

	}

?>