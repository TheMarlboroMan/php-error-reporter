<?php
namespace tools\error_reporter;

//ini_set('error_reporting', 1);

\set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
		error_reporter_central::report_error($err_severity, $err_msg, $err_file, $err_line);
		exit();
});

\register_shutdown_function(function () {
	$error=error_get_last();
	if($error) {
		error_reporter_central::report_error($error['type'], $error['message'], $error['file'], $error['line']);
	}
});

abstract class error_reporter_central {

	private static $name;

	public static function init($_frn) {
		self::$name=$_frn;
	}

	public static function report_error($_s, $_m, $_f, $_l){

		//TODO: BEtter as a class...
		$backtrace=[];
		foreach(debug_backtrace() as $k => $v) {

			$file=isset($v['file']) ? $v['file'] : 'no file';
			$line=isset($v['line']) ? $v['line'] : 'no line';
			$backtrace[]=<<<R
			[{$k}] : {$file} [{$line}] in function {$v['function']}
R;
		}

		//TODO: THESE WOULD BE CONSTRUCTOR PARAMS.
		//TODO: Construct it with all data...
		$reporter=new self::$name;
		$reporter->report($_s, $_m, $_f, $_l, $backtrace);
	}
};
