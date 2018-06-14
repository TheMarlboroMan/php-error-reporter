<?php
require("lib/autoload.php");
//TODO: THERE CAN BE NO ERRORS IN THE FILE WHERE WE DECLARE THIS!
\tools\error_reporter\error_reporter_central::init('\tools\error_reporter\app_reporter');
require("main.php");
