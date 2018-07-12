<?php
date_default_timezone_set('America/Montreal');

$ppds_version = "0.0.1";

// ///////////////////////////
// WEBSEAL + SERVER VARIABLES
/*
 * $user_language = "en";
 * if(isset($_SERVER["HTTP_LANGUAGE"]))
 * $user_language = $_SERVER["HTTP_LANGUAGE"];
 *
 * $user_ipAddress = "0.0.0.0";
 * if(isset($_SERVER["HTTP_NS_WEBSEAL_CLIENT_IP"]))
 * $user_ipAddress = $_SERVER["HTTP_NS_WEBSEAL_CLIENT_IP"];
 * else if(isset($_SERVER["HTTP_IV_REMOTE_ADDRESS"]))
 * $user_ipAddress = $_SERVER["HTTP_IV_REMOTE_ADDRESS"];
 *
 * $user_groups = "";
 * if(isset($_SERVER["HTTP_IV_GROUPS"]))
 * $user_groups = $_SERVER["HTTP_IV_GROUPS"];
 */
// ////////////////////////////////////////////////////////////////////
// $cookie_lang
/*
 * $cookie_lang = "en";
 * $ntr_lang = "us";
 * $cookie_debug_test = "";
 *
 * if(isset($_COOKIE['IT_SSP']['lang']))
 * {
 * $cookie_lang = $_COOKIE['IT_SSP']['lang'];
 * $ntr_lang = $_COOKIE['IT_SSP']['lang'];
 * }
 * elseif(isset($_SERVER["HTTP_LANGUAGE"]))
 * {
 * $cookie_debug_test .= "1";
 * $cookie_lang = strtolower($_SERVER["HTTP_LANGUAGE"]);
 * setcookie("IT_SSP[lang]", $cookie_lang, time()+2592000);
 * if($cookie_lang == "fr")
 * $ntr_lang = "fr";
 * }
 */

// $cookie_lang
// ////////////////////////////////////////////////////////////////////

$data_provinces = array(
    "en" => array(
        1 => "ON",
        2 => "QC",
        3 => "BC",
        4 => "AB",
        5 => "MB",
        6 => "NB",
        7 => "NS",
        8 => "NL",
        9 => "PE",
        10 => "SK",
        11 => "NT",
        12 => "NU",
        13 => "YU"
    ),
    
    "fr" => array(
        1 => "ON",
        2 => "QC",
        3 => "CB",
        4 => "AB",
        5 => "MB",
        6 => "NB",
        7 => "NE",
        8 => "TL",
        9 => "PE",
        10 => "SK",
        11 => "NT",
        12 => "NU",
        13 => "YU"
    )
);

// Question instance
$qts_instance = array();

/**
 * Function to output the fullname of someone from all CAPS to correct case (ex: SYLVAIN HUPPE -> Sylvain Huppe).
 * 
 * @param string $string
 *            User's full name
 * @return string $string String with correct capitalized full name
 */
function ucname($string)
{
    $string = ucwords(strtolower($string));
    
    foreach (array(
        "-",
        "'"
    ) as $delimiter) {
        if (strpos($string, $delimiter) !== false) {
            $string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
        }
    }
    return $string;
}

/**
 * A function to format the bytes of a file, as a natural looking string.
 * This version handes it via 1024 based logic.
 * 
 * @param int $bytes
 *            You provide the Bytes size of a file.
 * @return string $bytes It will return the provided Bytes int in a readable format we are used to see in Windows.
 */
function format_bytes($bytes)
{
    $display = array(
        'B',
        'kB',
        'MB',
        'GB',
        'TB',
        'PB',
        'EB',
        'ZB',
        'YB'
    );
    
    $level = 0;
    while ($bytes > 1024) {
        $bytes /= 1024;
        $level ++;
    }
    
    return round($bytes, 1) . " " . $display[$level];
}

/**
 * Remove all french accent from a string.
 * 
 * @param string $french
 *            French word/sentence.
 * @param boolean $hscc
 *            HTML special character code on or off.
 * @return string $nofrench Same word/sentence without any accents
 */
function remove_french_accent($french, $hscc = false)
{
    if ($hscc) {
        $html_code = array(
            '�' => '&Agrave;',
            '�' => '&Aacute;',
            '�' => '&Acirc;',
            '�' => '&Auml;',
            '�' => '&agrave;',
            '�' => '&aacute;',
            '�' => '&acirc;',
            '�' => '&auml;',
            '�' => '&Egrave;',
            '�' => '&Eacute;',
            '�' => '&Ecirc;',
            '�' => '&Euml;',
            '�' => '&egrave;',
            '�' => '&eacute;',
            '�' => '&ecirc;',
            '�' => '&euml;',
            '�' => '&Igrave;',
            '�' => '&Iacute;',
            '�' => '&Icirc;',
            '�' => '&Iuml;',
            '�' => '&igrave;',
            '�' => '&iacute;',
            '�' => '&icirc;',
            '�' => '&iuml;',
            '�' => '&Ograve;',
            '�' => '&Oacute;',
            '�' => '&Ocirc;',
            '�' => '&Ouml;',
            '�' => '&ograve;',
            '�' => '&oacute;',
            '�' => '&ocirc;',
            '�' => '&ouml;',
            '�' => '&Ugrave;',
            '�' => '&Uacute;',
            '�' => '&Ucirc;',
            '�' => '&Uuml;',
            '�' => '&ugrave;',
            '�' => '&uacute;',
            '�' => '&ucirc;',
            '�' => '&uuml;',
            '�' => '&Ccedil;',
            '�' => '&ccedil;',
            'ê' => '&ecirc;',
            'è' => '&egrave;',
            'è' => '&egrave;',
            'é' => '&eacute;',
            'É' => '&Eacute;',
            'Ê' => '&Ecirc;',
            'È' => '&Egrave;',
            'Ù' => '&Ugrave;',
            'é' => '&eacute;',
            'â' => '&acirc;',
            'ç' => '&ccedil;',
            '�' => '&agrave;',
            'ê' => '&ecirc;',
            '’' => '\''
        );
        return strtr($french, $html_code);
    } else {
        $search = explode(",", "�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,e,i,�,��");
        $replace = explode(",", "C,c,',ae,oe,a,E,e,i,o,u,A,a,E,e,I,i,O,o,U,u,A,a,E,e,I,i,O,o,U,u,y,A,a,E,e,I,i,O,o,U,u,a,e,i,o,'");
        return str_replace($search, $replace, $french);
    }
}

function get_execution_time($precision = 0)
{
    static $microtime_start = null;
    if ($microtime_start === null) {
        $microtime_start = microtime(true);
        return 0.0;
    }
    return round(microtime(true) - $microtime_start, $precision);
}

// http://stackoverflow.com/questions/4184769/how-to-get-current-time-in-ms-in-php
function get_precise_time($format, $t = null)
{
    if (is_null($t)) {
        $t = microtime(true);
        $timestamp = floor($t);
        $milliseconds = round(($t - $timestamp) * 1000000);
        return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
    }
}

// Function send email
function sendHTMLemail($HTML, $from, $to, $subject, $tocc = "", $tobcc = "")
{
    // First we have to build our email headers
    
    // NOTE: Do we want that? -> http://ca3.php.net/manual/en/function.mail.php
    // $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
    
    // Set out "from" address
    $headers = "From: $from\r\n";
    
    // We add CCs and Bccs, if they are set
    if ($tocc != "")
        $headers .= "Cc: $tocc" . "\r\n";
    if ($tobcc != "")
        $headers .= "Bcc: $tobcc" . "\r\n";
    
    // Now we specify our MIME version
    $headers .= "MIME-Version: 1.0\r\n";
    
    // Create a boundary so we know where to look for
    // the start of the data
    $boundary = uniqid("HTMLEMAIL");
    
    // First we be nice and send a non-html version of our email
    $headers .= "Content-Type: multipart/alternative;" . "boundary = $boundary\r\n\r\n";
    
    $headers .= "This is a MIME encoded message.\r\n\r\n";
    
    $headers .= "--$boundary\r\n" . "Content-Type: text/plain; charset=ISO-8859-1\r\n" . "Content-Transfer-Encoding: base64\r\n\r\n";
    
    $headers .= chunk_split(base64_encode($HTML));
    
    // Now we attach the HTML version
    $headers .= "--$boundary\r\n" . "Content-Type: text/html; charset=ISO-8859-1\r\n" . "Content-Transfer-Encoding: base64\r\n\r\n";
    
    $headers .= chunk_split(base64_encode($HTML));
    
    // And then send the email ....
    if (mail($to, $subject, $HTML, $headers))
        return true;
    else
        return false;
}

/*
 * Commented out 
 * On 2015-03-29
 * Formerly used in sm_contact to add HPSM SOAP Call return messages in logs
 * //function return SM message
 * function SM_message($result)
 * {
 * $SM_message = "";
 * if(isset($result->messages->message->_) and $result->messages->message->_ != "")
 * {
 * $SM_message = $result->messages->message->_;
 *
 * }
 * elseif(isset($result->messages->message[0]) and $result->messages->message[0] != "")
 * {
 * $msg_count = 0;
 * do
 * {
 * $SM_message .= "SM Message #".($msg_count+1).": ".$result->messages->message[$msg_count]->_."<br />";
 * $msg_count++;
 * } while(isset($result->messages->message[$msg_count]->_) and !is_null($result->messages->message[$msg_count]->_));
 * }
 * else
 * {
 * $SM_message = "Service Manager returned no system message.";
 * }
 *
 * return $SM_message;
 * }
 */

// function return SM REST message
function SM_RESTmessage($result, $prefix = '')
{
    $ret = '';
    foreach ($result->Messages as $message) {
        $ret .= $prefix . $message . '\n';
    }
    
    return $ret;
}

/**
 * Function to print an array correctly with <pre> tag
 * 
 * @param array $array
 *            The array you want a readable display of.
 * @return string A 'human readable' display of your array.
 */
function aprint($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

/**
 * Function to dump an array correctly with <pre> tag
 * 
 * @param array $value
 *            The array you want a readable display of.
 * @return string A 'human readable' display of your array.
 */
function vdump($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

// Fix url we input in "a href=''"
function htmlurlfixer($url)
{
    $url = preg_replace('/\s+/', ' ', $url); // Removes newlines
    $url = str_replace(" ", "%20", $url); // Removes whitespaces
    $url = htmlspecialchars($url); // Convert special characters to HTML entities
    
    return $url;
}

// Multisort an Array of Objects
// http://stackoverflow.com/questions/2699086/sort-multidimensional-array-by-value-2
// Example call: array_sort_by_column($array, 'column name');
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC)
{
    $sort_col = array();
    foreach ($arr as $key => $row) {
        $sort_col[$key] = $row[$col];
    }
    
    array_multisort($sort_col, $dir, $arr);
}

// Support functions for array_walk_recursive, used to convert a whole array from one charset to another instead of one value at a time
// array_walk_recursive($draft, 'iconvArrayUTF8toISO88591');
function iconvArrayUTF8toISO88591(&$arrayMember)
{
    $arrayMember = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $arrayMember);
}

function iconvArrayISO88591toUTF8(&$arrayMember)
{
    $arrayMember = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $arrayMember);
}

// Call function with parameters start date/time, end date/time, today's date/time.
// http://stackoverflow.com/questions/4191867/php-function-to-check-time-between-the-given-range
function check_date_is_within_range($start_date, $end_date, $todays_date)
{
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);
    $today_timestamp = strtotime($todays_date);
    
    return (($today_timestamp >= $start_timestamp) && ($today_timestamp <= $end_timestamp));
}

// http://stackoverflow.com/questions/8676011/illegal-characters-in-object-or-json-key
function json_escape($theJson)
{
    $theJson = str_replace("\\", "/", $theJson);
    $theJson = str_replace("'", "", $theJson);
    $theJson = str_replace('"', '', $theJson);
    
    return $theJson;
}

// Output current Memcache details on this server.
function getMemcacheDetails()
{
    $memcache_obj = new Memcache();
    $memcache_obj = memcache_connect('localhost', 11211);
    $status = $memcache_obj->getStats();
    
    echo "<table class='logstable'>";
    
    echo "<tr><th>Stats name</th> <th>Value</th></tr>";
    
    echo "<tr><td class='tdbold'>Memcache Server version:</td><td> " . $status["version"] . "</td></tr>";
    echo "<tr><td class='tdbold'>Process id of this server process </td><td>" . $status["pid"] . "</td></tr>";
    echo "<tr><td class='tdbold'>Number of seconds this server has been running </td><td>" . $status["uptime"] . " seconds</td></tr>";
    echo "<tr><td class='tdbold'>Accumulated user time for this process </td><td>" . $status["rusage_user"] . " seconds</td></tr>";
    echo "<tr><td class='tdbold'>Accumulated system time for this process </td><td>" . $status["rusage_system"] . " seconds</td></tr>";
    echo "<tr><td class='tdbold'>Total number of items stored by this server ever since it started </td><td>" . $status["total_items"] . "</td></tr>";
    echo "<tr><td class='tdbold'>Number of open connections </td><td>" . $status["curr_connections"] . "</td></tr>";
    echo "<tr><td class='tdbold'>Total number of connections opened since the server started running </td><td>" . $status["total_connections"] . "</td></tr>";
    echo "<tr><td class='tdbold'>Number of connection structures allocated by the server </td><td>" . $status["connection_structures"] . "</td></tr>";
    echo "<tr><td class='tdbold'>Cumulative number of retrieval requests </td><td>" . $status["cmd_get"] . "</td></tr>";
    echo "<tr><td class='tdbold'> Cumulative number of storage requests </td><td>" . $status["cmd_set"] . "</td></tr>";
    
    $percCacheHit = ((real) $status["get_hits"] / (real) $status["cmd_get"] * 100);
    $percCacheHit = round($percCacheHit, 3);
    $percCacheMiss = 100 - $percCacheHit;
    
    echo "<tr><td class='tdbold'>Number of keys that have been requested and found present </td><td>" . $status["get_hits"] . " ($percCacheHit%)</td></tr>";
    echo "<tr><td class='tdbold'>Number of items that have been requested and not found </td><td>" . $status["get_misses"] . "($percCacheMiss%)</td></tr>";
    
    $MBRead = (real) $status["bytes_read"] / (1024 * 1024);
    
    echo "<tr><td class='tdbold'>Total number of bytes read by this server from network </td><td>" . $MBRead . " Mega Bytes</td></tr>";
    $MBWrite = (real) $status["bytes_written"] / (1024 * 1024);
    echo "<tr><td class='tdbold'>Total number of bytes sent by this server to network </td><td>" . $MBWrite . " Mega Bytes</td></tr>";
    $MBSize = (real) $status["limit_maxbytes"] / (1024 * 1024);
    echo "<tr><td class='tdbold'>Number of bytes this server is allowed to use for storage.</td><td>" . $MBSize . " Mega Bytes</td></tr>";
    echo "<tr><td class='tdbold'>Number of valid items removed from cache to free memory for new items.</td><td>" . $status["evictions"] . "</td></tr>";
    
    echo "</table>";
}

function returnFirstIfSecondEmpty($first, $second)
{
    return empty($second) ? $first : $second;
}

class Timezone
{

    function __construct()
    {}

    function __destruct()
    {}

    var $sm_timezone = 'EST';

    var $timezones_offset = array(
        'HNP' => '-08:00:00',
        'PST' => '-08:00:00',
        'Canada/Pacific' => '-08:00:00',
        
        'HNR' => '-07:00:00',
        'MST' => '-07:00:00',
        'Canada/Mountain' => '-07:00:00',
        
        'HNC' => '-06:00:00',
        'CST' => '-06:00:00',
        'Canada/Central' => '-06:00:00',
        
        'HNE' => '-05:00:00',
        'EST' => '-05:00:00',
        'Canada/Eastern' => '-05:00:00',
        
        'HNA' => '-04:00:00',
        'AST' => '-04:00:00',
        'Canada/Atlantic' => '-04:00:00'
    );

    function GetOperatorDatetimeDisplay($aOperatorTimezone, $aDatetime)
    {
        $date = new DateTime($aDatetime);
        
        // Go from default timezone to UTC
        $symb = ($this->timezones_offset[$this->sm_timezone][0] == "-") ? "" : "-";
        
        $offset_time = ltrim($this->timezones_offset[$this->sm_timezone], '-');
        $values = explode(":", $offset_time);
        $hours = $values[0];
        $minutes = $values[1];
        $seconds = $values[2];
        
        $verbal_time = $symb . $hours . " hours " . $symb . $minutes . " minutes " . $symb . $seconds . " seconds";
        
        $utc_date = date("Y-m-d H:i:s", strtotime($verbal_time, strtotime($date->format('Y-m-d H:i:s'))));
        $utc_date = new DateTime($utc_date);
        
        // Go from UTC to the operator timezone
        $operator_offset = (array_key_exists($aOperatorTimezone, $this->timezones_offset)) ? $this->timezones_offset[$aOperatorTimezone] : $this->timezones_offset[$this->sm_timezone];
        $symb = $operator_offset[0];
        
        $offset_time = ltrim($operator_offset, '-');
        $values = explode(":", $offset_time);
        $hours = $values[0];
        $minutes = $values[1];
        $seconds = $values[2];
        
        $verbal_time = $symb . $hours . " hours " . $symb . $minutes . " minutes " . $symb . $seconds . " seconds";
        
        $display = date("Y-m-d H:i:s", strtotime($verbal_time, strtotime($utc_date->format('Y-m-d H:i:s'))));
        
        // $utc_datetime = gmdate('Y-m-d H:i:s', $aDatetime);
        
        return $display;
    }

    function ConvertDatetimeToSMFormat($aDatetimeWithTimezone)
    {
        $date_parts = explode(" ", $aDatetimeWithTimezone);
        
        $date = new DateTime($date_parts[0] . " " . $date_parts[1]);
        
        $operator_timezone = (count($date_parts) != 3) ? $this->sm_timezone : $date_parts[2];
        
        // Go from operator timezone to UTC
        $symb = ($this->timezones_offset[$operator_timezone][0] == "-") ? "" : "-";
        
        $offset_time = ltrim($this->timezones_offset[$operator_timezone], '-');
        $values = explode(":", $offset_time);
        $hours = $values[0];
        $minutes = $values[1];
        $seconds = $values[2];
        
        $verbal_time = $symb . $hours . " hours " . $symb . $minutes . " minutes " . $symb . $seconds . " seconds";
        
        $utc_date = date("Y-m-d H:i:s", strtotime($verbal_time, strtotime($date->format('Y-m-d H:i:s'))));
        $utc_date = new DateTime($utc_date);
        
        // Go from UTC to the sm default timezone
        $sm_offset = $this->timezones_offset[$this->sm_timezone];
        $symb = $sm_offset[0];
        
        $offset_time = ltrim($sm_offset, '-');
        $values = explode(":", $offset_time);
        $hours = $values[0];
        $minutes = $values[1];
        $seconds = $values[2];
        
        $verbal_time = $symb . $hours . " hours " . $symb . $minutes . " minutes " . $symb . $seconds . " seconds";
        
        $sm_date = date("Y/m/d H:i:s", strtotime($verbal_time, strtotime($utc_date->format('Y/m/d H:i:s'))));
        
        return $sm_date;
    }
}

// KE2970 - Needed until we upgrade php to > 5.4.0
// should then be replaced by something like htmlentities($symbolsToEncode, ENT_XML1, 'UTF-8');
function walk_numericHTMLEntities(&$str)
{
    $str = preg_replace('/[&]/e', '"&#".ord("$0").";"', html_entity_decode($str));
}

function numericHTMLEntities($str)
{
    return preg_replace('/[&]/e', '"&#".ord("$0").";"', html_entity_decode($str));
}

// KE2970 - END
function buildUserDraftList($userDrafts)
{
    $userDraftsJSON = array();
    if (count($userDrafts) > 0) {
        foreach ($userDrafts as $key => $value) {
            if ($value['type'] == 'Draft') {
                $ud = new stdClass();
                $ud->id = $value['id'];
                $ud->catalog_item = $value['catalog_item'];
                $ud->display_name = iconv('ISO-8859-1', 'UTF-8//TRANSLIT', $value['DISPLAYNAME']);
                
                $tmpDraft = json_decode(iconv('ISO-8859-1', 'UTF-8//TRANSLIT', $value['draft']));
                if (isset($tmpDraft->contacts[0]->firstname) and $tmpDraft->contacts[0]->firstname != '' and isset($tmpDraft->contacts[0]->lastname) and $tmpDraft->contacts[0]->lastname != '')
                    $ud->contact_name = $tmpDraft->contacts[0]->firstname . ' ' . $tmpDraft->contacts[0]->lastname;
                else
                    $ud->contact_name = 'unknown';
                
                $ud->for_someone_else = $ud->contact_name != 'unknown' && $tmpDraft->submittedby != $tmpDraft->contacts[0]->employeenb;
                $ud->last_modified = $value['date_modified'];
                
                $userDraftsJSON[] = $ud;
            }
        }
    }
    
    return $userDraftsJSON;
}

class XMLSerializer
{

    // functions adopted from http://www.sean-barton.co.uk/2009/03/turning-an-array-or-object-into-xml-using-php/
    public static function generateValidXmlFromObj(stdClass $obj, $node_block = 'nodes', $node_name = 'node')
    {
        $arr = get_object_vars($obj);
        return self::generateValidXmlFromArray($arr, $node_block, $node_name);
    }

    public static function generateValidXmlFromArray($array, $node_block = 'nodes', $node_name = 'node')
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
        $xml .= '<' . $node_block . '>';
        $xml .= self::generateXmlFromArray($array, $node_name);
        $xml .= '</' . $node_block . '>';
        
        return $xml;
    }

    // adapted from http://randomchaos.com/documents/?source=php_and_unicode
    private static function getXMLEntity($str)
    {
        $ret = '';
        $values = array();
        $lookingFor = 1;
        $exceptions = array(
            38
        );
        
        for ($i = 0; $i < strlen($str); $i ++) {
            $thisValue = ord($str[$i]);
            
            if (in_array($thisValue, $exceptions)) {
                $ret .= '&#' . $thisValue . ';';
            } else if ($thisValue < 128) {
                $ret .= $str[$i];
            } else {
                if (count($values) == 0)
                    $lookingFor = ($thisValue < 224) ? 2 : 3;
                
                $values[] = $thisValue;
                
                if (count($values) == $lookingFor) {
                    $number = ($lookingFor == 3) ? (($values[0] % 16) * 4096) + (($values[1] % 64) * 64) + ($values[2] % 64) : (($values[0] % 32) * 64) + ($values[1] % 64);
                    
                    $ret .= '&#' . $number . ';';
                    $values = array();
                    $lookingFor = 1;
                } // if
            } // if
        } // for
        
        return $ret;
    }

    private static function generateXmlFromArray($array, $node_name)
    {
        $xml = '';
        
        if (is_array($array) || is_object($array)) {
            foreach ($array as $key => $value) {
                if (is_numeric($key)) {
                    $key = $node_name;
                }
                
                $xml .= '<' . $key . '>' . self::generateXmlFromArray($value, $node_name) . '</' . $key . '>';
            }
        } elseif (is_int($array) or is_float($array)) {
            $xml = $array;
        } elseif (is_bool($array)) {
            if ($array === true)
                $xml = 'true';
            else
                $xml = 'false';
        } else {
            $xml = self::getXMLEntity($array);
        }
        
        return $xml;
    }
}
