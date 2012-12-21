<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	class user {
		public $name;
		public $email;
		public $id;

		public function __construct($n = null, $e = null, $i = null) {
			$this->name = $n;
			$this->email = $e;
			$this->id = $i;
		}

		public function getUser($json = false) {
			if ($json == true) {
				return json_encode(array('name'=>$this->name, 'email'=>$this->email, 'id'=>$this->id));
			}
			else {
				return array('name'=>$this->name, 'email'=>$this->email, 'id'=>$this->id);
			}
		}

 	}

?>