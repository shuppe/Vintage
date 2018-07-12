<?php
if (defined('LOG_HANDLER_ACTIVATED') and LOG_HANDLER_ACTIVATED) {

    function my_error_handler($errno, $errstr, $errfile, $errline)
    {
        $log_type = ""; // What will be stored in the logs database
        $errno = $errno & error_reporting();
        if ($errno == 0)
            return;
        if (! defined('E_STRICT'))
            define('E_STRICT', 2048);
        if (! defined('E_RECOVERABLE_ERROR'))
            define('E_RECOVERABLE_ERROR', 4096);
        $errtxt = "";
        $errtxt .= "<b>";
        
        switch ($errno) {
            case E_ERROR:
                $errtxt .= "Error";
                $log_type = "error";
                break;
            case E_WARNING:
                $errtxt .= "Warning";
                $log_type = "warning";
                break;
            case E_PARSE:
                $errtxt .= "Parse Error";
                $log_type = "error";
                break;
            case E_NOTICE:
                $errtxt .= "Notice";
                $log_type = "notice";
                break;
            case E_CORE_ERROR:
                $errtxt .= "Core Error";
                $log_type = "error";
                break;
            case E_CORE_WARNING:
                $errtxt .= "Core Warning";
                $log_type = "warning";
                break;
            case E_COMPILE_ERROR:
                $errtxt .= "Compile Error";
                $log_type = "error";
                break;
            case E_COMPILE_WARNING:
                $errtxt .= "Compile Warning";
                $log_type = "warning";
                break;
            case E_USER_ERROR:
                $errtxt .= "User Error";
                $log_type = "error";
                break;
            case E_USER_WARNING:
                $errtxt .= "User Warning";
                $log_type = "warning";
                break;
            case E_USER_NOTICE:
                $errtxt .= "User Notice";
                $log_type = "notice";
                break;
            case E_STRICT:
                $errtxt .= "Strict Notice";
                $log_type = "notice";
                break;
            case E_RECOVERABLE_ERROR:
                $errtxt .= "Recoverable Error";
                $log_type = "error";
                break;
            default:
                $errtxt .= "Unknown error ($errno)";
                $log_type = "error";
                break;
        }
        
        $errtxt .= ":</b> <i>$errstr</i> in <b>$errfile</b> on line <b>$errline</b>\n";
        
        if (function_exists('debug_backtrace')) {
            // $errtxt .= "backtrace:\n";
            $backtrace = debug_backtrace();
            array_shift($backtrace);
            foreach ($backtrace as $i => $l) {
                if (! isset($l['class']))
                    $l['class'] = "";
                if (! isset($l['type']))
                    $l['type'] = "";
                
                $errtxt .= "[$i] Called in function <b>{$l['class']}{$l['type']}{$l['function']}</b>";
                if (isset($l['file']) and $l['file'])
                    $errtxt .= " in <b>{$l['file']}</b>";
                if (isset($l['line']) and $l['line'])
                    $errtxt .= " on line <b>{$l['line']}</b>";
                $errtxt .= "\n";
            }
        }
        
        $errtxt .= "\n";
        
        if (isset($GLOBALS['error_fatal'])) {
            if ($GLOBALS['error_fatal'] & $errno)
                die('fatal');
        }
        
        // DEBUG Mode
        if (defined('LOG_DEBUG_MODE') and LOG_DEBUG_MODE) {
            echo str_replace("\n", "<br />", $errtxt);
        }
        
        $SERVER_HTTP_IV_USER = (isset($_SERVER['HTTP_IV_USER']) and $_SERVER['HTTP_IV_USER'] != "") ? $_SERVER['HTTP_IV_USER'] : "Unknown username";
        $SERVER_HTTP_GIVENNAME = (isset($_SERVER['HTTP_GIVENNAME']) and $_SERVER['HTTP_GIVENNAME'] != "") ? $_SERVER['HTTP_GIVENNAME'] : "Unknown firstname";
        $SERVER_HTTP_SN = (isset($_SERVER['HTTP_SN']) and $_SERVER['HTTP_SN'] != "") ? $_SERVER['HTTP_SN'] : "Unknown lastname";
        
        $phperrorlogs = new Logs();
        $phperrorlogs->registerLog(LOG_PHP, // Category
LOG_HANDLER_PROJECTNAME, // $project_name,
$SERVER_HTTP_IV_USER, // $from_username,
$SERVER_HTTP_GIVENNAME . " " . $SERVER_HTTP_SN, // $from_user_fullname
$GLOBALS['user_ipAddress'], // $_SERVER["HTTP_NS_WEBSEAL_CLIENT_IP"], // $from_ipaddress,
NULL, // $from_pcname,
NULL, // $from_location
$_SERVER["REQUEST_URI"], // $requested_url,
$_SERVER["SERVER_NAME"], // $instance
time(), // $event_date_start,
time(), // $event_date_end,
0, // $process_time,
$log_type, // $log_type,
$errno, // $return_code,
0, // $nb_processed_items,
0, // $nb_recorded_errors,
0, // $nb_recorded_warnings,
get_precise_time('Y-m-d, H:i:s.u') . ": " . $errtxt);
    }

    function error_fatal($mask = NULL)
    {
        if (! is_null($mask)) {
            $GLOBALS['error_fatal'] = $mask;
        } elseif (! isset($GLOBALS['die_on'])) {
            $GLOBALS['error_fatal'] = 0;
        }
        
        return $GLOBALS['error_fatal'];
    }
    
    error_reporting(E_ALL);
    set_error_handler('my_error_handler');
}
?>
