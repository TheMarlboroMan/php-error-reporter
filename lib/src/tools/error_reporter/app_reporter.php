<?php
namespace tools\error_reporter;

class app_reporter implements error_reporter {

	//TODO: Fix this, pass all shit here.
	public function __construct($_a=null) {

	}

	//TODO: NOT A SINGLE PARAM.
	public function report($_err_severity, $_err_message, $_err_file, $_err_line, array $_backtrace) {

		$backtrace=nl2br(print_r($_backtrace, true));

		echo <<<R
<html>
<body style="color: red">
{$_err_severity} => "{$_err_message}" ($_err_file, $_err_line)
<br />
{$backtrace}
</body>
</html>
R;

	}
}
