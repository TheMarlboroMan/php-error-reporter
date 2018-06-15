<?php
namespace tools\error_reporter;

abstract class error_reporter_central {

	private static 				$reporter=null;

	public static function 		init(error_reporter $_er=null) {

		if(null===$_er) {
			self::$reporter=new default_reporter;
		}
		else {
			self::$reporter=$_er;
		}

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

		\ini_set('error_reporting', -1);
		\ini_set('display_errors', 0);
	}

	public static function 		report_error($_s, $_m, $_f, $_l){

		if(null===self::$reporter) {
			throw new \Exception("error_reporter_central::init must be called before using the error_reporting tool");
		}

		$backtraces=[];
		foreach(debug_backtrace() as $k => $v) {
			$backtraces[]=backtrace::from_array_and_key($v, $k);
		}

		self::$reporter->report($_s, $_m, $_f, $_l, $backtraces);
	}
};
