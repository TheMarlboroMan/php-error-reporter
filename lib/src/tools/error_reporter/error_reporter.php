<?php
namespace tools\error_reporter;

interface error_reporter {
	//TODO: Fix this, pass all shit here.
	public function __construct($_a=null);
	//TODO: NOT A SINGLE PARAM.
	public function report($_err_severity, $_err_message, $_err_file, $_err_line, array $_backtrace);
};
