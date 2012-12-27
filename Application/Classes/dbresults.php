<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	class DBResults {
		public $results = array();

 		public function createResults($result, $json = false) {
			foreach ($result as $row) {
				array_push($this->results, $row);
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