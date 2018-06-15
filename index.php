<?php
require("lib/autoload.php");
try {
	//\tools\error_reporter\error_reporter_central::init();
	\tools\error_reporter\error_reporter_central::init(new \tools\error_reporter\app_reporter, -1, 0);
	require("main.php");
}
catch(\Exception $e) {

	die($e->getMessage());
}
