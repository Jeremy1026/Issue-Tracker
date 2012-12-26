<?php
/**
 * Physicians Management Group / Maryland Primary Care Physicians
 *
 * @link      www.mpcp.com
 * @copyright Copyright (c) 2012 Physicians Management Group/Maryland Primary Care Physicians
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program
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