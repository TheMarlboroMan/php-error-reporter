<?php
namespace tools\error_reporter;

class app_reporter implements error_reporter {

	public function 		report($_err_severity, $_err_message, $_err_file, $_err_line, array $_backtrace) {

		$backtrace=array_reduce($_backtrace, function($_carry, backtrace $_item) {

			$_carry.=$this->format_trace($_item);
			return $_carry;
		});

		$err_type=tools::translate_error_code($_err_severity);

		echo <<<R
<!DOCTYPE html>
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css">
html {background: #000; color: #fff;}
h1 {margin: 1em auto; text-align: center;};
	</style>
</head>
<body>
	<h1>An error occured</h1>
	<p><h2>[{$err_type}]</h2>{$_err_message}</p>
	<ul>
		{$backtrace}
	</ul>
</body>
</html>
R;

	}

	private function		format_trace(backtrace $_item) {

		return <<<R
		<li><i>{$_item->get_index()}</i>: in file <b>{$_item->get_file()}</b>, line <b>{$_item->get_line()}</b>, from function <b>{$_item->get_function()}</b></li>
R;
	}

}
