<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	class ClassAutoloader {
		public function __construct() {
			spl_autoload_register(array($this, 'loader'));
		}
		private function loader($className) {
			include $className . '.php';
		}
	}

?>