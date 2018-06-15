<?php
namespace tools\error_reporter;

interface error_reporter {
	public function report($_err_severity, $_err_message, $_err_file, $_err_line, array $_backtrace);
};
