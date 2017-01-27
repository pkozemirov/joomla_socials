<?php

	// Defines
	define('_JEXEC', 1);
	define('DS', DIRECTORY_SEPARATOR);
	define('JPATH_BASE', dirname(__FILE__) . '/../');
	
	// Requires
	require_once JPATH_BASE.'/includes/defines.php';
	require_once JPATH_BASE.'/includes/framework.php';
	
	// Initializing
	$app =& JFactory::getApplication('site');
	$app->initialise();

	// Importing
	jimport('joomla.user.helper');
	
	// Debug functions
	function dump($param){
		echo "<hr><pre>".print_r($param,1)."</pre><hr>";
	}

?>