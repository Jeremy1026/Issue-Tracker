<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright © 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

	/**
	* Automatically includes classes
	*
	* @throws Exception
	* @param  string $class_name  Name of the class to load
	* @return void
	*/

	function __autoload($class_name){
		// Customize this to your root Flourish directory
		if (strcmp(substr($class_name, 0, 1), 'f') == 0) {
			$file_root = './inc/classes/flourish/';
		}
		else if (strcmp(substr($class_name, 0, 1), 'i') == 0) {
			$file_root = './inc/classes/issuetracker/';
		}

		$file = $file_root . $class_name . '.php';

		if (file_exists($file)) {
			include $file;
			return;
		}

		throw new Exception('The class ' . $class_name . ' could not be loaded');
	}
?>