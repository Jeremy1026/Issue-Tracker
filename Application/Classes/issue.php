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

		public function __construct(fDatabase $dbo) {
			$this->dbo = $dbo;
		}

		public function createIssue($issue = null) {

		}

		public function getIssue() {

		}

		public function searchIssues() {

		}

		protected function searchByTag() {

		}

		protected function searchByUser() {

		}

		protected function searchByDate() {

		}

		protected function searchByStatus() {

		}

 	}

?>