<?

//santizze. Anal is forceing alphanumeric values
function sanitize($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}

function text_trim($text, $max = 20) {
	$text = explode(' ', $text);
	if($text){
		if(count($text) > $max){
			$text = array_slice($text, 0, $max);
			array_push($text, '...');
		}
		$text = implode(' ', $text);
	}
	return $text;
}

function textcnt_limit($string, $length=165){
	// strip tags to avoid breaking any html
	$string = strip_tags($string);
	if (strlen($string) > $length){
		// truncate string
		$stringCut = substr($string, 0, $length);
		// make sure it ends in a word so assassinate doesn't become ass..
		$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'..'; 
	}
	return $string;
}

function incpage($src){

	ob_start();
	include_once($src);
	$inc = ob_get_contents();
	ob_end_clean();
	
	return $inc;
}

function createSaltedPass($pass) {
    $salt = hash('sha256', uniqid( mt_rand(), true ));
    $pass = hash('sha256', $salt . $pass);
    return $salt . $pass;
}

function filter_data($val)
{
	if(is_array($val)){
		foreach($val as $k=>$v){
		$output[$k] .= htmlentities($v,ENT_QUOTES);
		}
	} else {
  		$output = htmlentities($val,ENT_QUOTES);		
	}
	return $output;

}

function get_timzones() {
	$timezones = array(
		'Pacific/Midway'    => "(GMT-11:00) Midway Island",
		'US/Samoa'          => "(GMT-11:00) Samoa",
		'US/Hawaii'         => "(GMT-10:00) Hawaii",
		'US/Alaska'         => "(GMT-09:00) Alaska",
		'US/Pacific'        => "(GMT-08:00) Pacific Time (US &amp; Canada)",
		'America/Tijuana'   => "(GMT-08:00) Tijuana",
		'US/Arizona'        => "(GMT-07:00) Arizona",
		'US/Mountain'       => "(GMT-07:00) Mountain Time (US &amp; Canada)",
		'America/Chihuahua' => "(GMT-07:00) Chihuahua",
		'America/Mazatlan'  => "(GMT-07:00) Mazatlan",
		'America/Mexico_City' => "(GMT-06:00) Mexico City",
		'America/Monterrey' => "(GMT-06:00) Monterrey",
		'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
		'US/Central'        => "(GMT-06:00) Central Time (US &amp; Canada)",
		'US/Eastern'        => "(GMT-05:00) Eastern Time (US &amp; Canada)",
		'US/East-Indiana'   => "(GMT-05:00) Indiana (East)",
		'America/Bogota'    => "(GMT-05:00) Bogota",
		'America/Lima'      => "(GMT-05:00) Lima",
		'America/Caracas'   => "(GMT-04:30) Caracas",
		'Canada/Atlantic'   => "(GMT-04:00) Atlantic Time (Canada)",
		'America/La_Paz'    => "(GMT-04:00) La Paz",
		'America/Santiago'  => "(GMT-04:00) Santiago",
		'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
		'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
		'Greenland'         => "(GMT-03:00) Greenland",
		'Atlantic/Stanley'  => "(GMT-02:00) Stanley",
		'Atlantic/Azores'   => "(GMT-01:00) Azores",
		'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
		'Africa/Casablanca' => "(GMT) Casablanca",
		'Europe/Dublin'     => "(GMT) Dublin",
		'Europe/Lisbon'     => "(GMT) Lisbon",
		'Europe/London'     => "(GMT) London",
		'Africa/Monrovia'   => "(GMT) Monrovia",
		'Europe/Amsterdam'  => "(GMT+01:00) Amsterdam",
		'Europe/Belgrade'   => "(GMT+01:00) Belgrade",
		'Europe/Berlin'     => "(GMT+01:00) Berlin",
		'Europe/Bratislava' => "(GMT+01:00) Bratislava",
		'Europe/Brussels'   => "(GMT+01:00) Brussels",
		'Europe/Budapest'   => "(GMT+01:00) Budapest",
		'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
		'Europe/Ljubljana'  => "(GMT+01:00) Ljubljana",
		'Europe/Madrid'     => "(GMT+01:00) Madrid",
		'Europe/Paris'      => "(GMT+01:00) Paris",
		'Europe/Prague'     => "(GMT+01:00) Prague",
		'Europe/Rome'       => "(GMT+01:00) Rome",
		'Europe/Sarajevo'   => "(GMT+01:00) Sarajevo",
		'Europe/Skopje'     => "(GMT+01:00) Skopje",
		'Europe/Stockholm'  => "(GMT+01:00) Stockholm",
		'Europe/Vienna'     => "(GMT+01:00) Vienna",
		'Europe/Warsaw'     => "(GMT+01:00) Warsaw",
		'Europe/Zagreb'     => "(GMT+01:00) Zagreb",
		'Europe/Athens'     => "(GMT+02:00) Athens",
		'Europe/Bucharest'  => "(GMT+02:00) Bucharest",
		'Africa/Cairo'      => "(GMT+02:00) Cairo",
		'Africa/Harare'     => "(GMT+02:00) Harare",
		'Europe/Helsinki'   => "(GMT+02:00) Helsinki",
		'Europe/Istanbul'   => "(GMT+02:00) Istanbul",
		'Asia/Jerusalem'    => "(GMT+02:00) Jerusalem",
		'Europe/Kiev'       => "(GMT+02:00) Kyiv",
		'Europe/Minsk'      => "(GMT+02:00) Minsk",
		'Europe/Riga'       => "(GMT+02:00) Riga",
		'Europe/Sofia'      => "(GMT+02:00) Sofia",
		'Europe/Tallinn'    => "(GMT+02:00) Tallinn",
		'Europe/Vilnius'    => "(GMT+02:00) Vilnius",
		'Asia/Baghdad'      => "(GMT+03:00) Baghdad",
		'Asia/Kuwait'       => "(GMT+03:00) Kuwait",
		'Europe/Moscow'     => "(GMT+03:00) Moscow",
		'Africa/Nairobi'    => "(GMT+03:00) Nairobi",
		'Asia/Riyadh'       => "(GMT+03:00) Riyadh",
		'Europe/Volgograd'  => "(GMT+03:00) Volgograd",
		'Asia/Tehran'       => "(GMT+03:30) Tehran",
		'Asia/Baku'         => "(GMT+04:00) Baku",
		'Asia/Muscat'       => "(GMT+04:00) Muscat",
		'Asia/Tbilisi'      => "(GMT+04:00) Tbilisi",
		'Asia/Yerevan'      => "(GMT+04:00) Yerevan",
		'Asia/Kabul'        => "(GMT+04:30) Kabul",
		'Asia/Yekaterinburg' => "(GMT+05:00) Ekaterinburg",
		'Asia/Karachi'      => "(GMT+05:00) Karachi",
		'Asia/Tashkent'     => "(GMT+05:00) Tashkent",
		'Asia/Kolkata'      => "(GMT+05:30) Kolkata",
		'Asia/Kathmandu'    => "(GMT+05:45) Kathmandu",
		'Asia/Almaty'       => "(GMT+06:00) Almaty",
		'Asia/Dhaka'        => "(GMT+06:00) Dhaka",
		'Asia/Novosibirsk'  => "(GMT+06:00) Novosibirsk",
		'Asia/Bangkok'      => "(GMT+07:00) Bangkok",
		'Asia/Jakarta'      => "(GMT+07:00) Jakarta",
		'Asia/Krasnoyarsk'  => "(GMT+07:00) Krasnoyarsk",
		'Asia/Chongqing'    => "(GMT+08:00) Chongqing",
		'Asia/Hong_Kong'    => "(GMT+08:00) Hong Kong",
		'Asia/Irkutsk'      => "(GMT+08:00) Irkutsk",
		'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
		'Australia/Perth'   => "(GMT+08:00) Perth",
		'Asia/Singapore'    => "(GMT+08:00) Singapore",
		'Asia/Taipei'       => "(GMT+08:00) Taipei",
		'Asia/Ulaanbaatar'  => "(GMT+08:00) Ulaan Bataar",
		'Asia/Urumqi'       => "(GMT+08:00) Urumqi",
		'Asia/Seoul'        => "(GMT+09:00) Seoul",
		'Asia/Tokyo'        => "(GMT+09:00) Tokyo",
		'Asia/Yakutsk'      => "(GMT+09:00) Yakutsk",
		'Australia/Adelaide' => "(GMT+09:30) Adelaide",
		'Australia/Darwin'  => "(GMT+09:30) Darwin",
		'Australia/Brisbane' => "(GMT+10:00) Brisbane",
		'Australia/Canberra' => "(GMT+10:00) Canberra",
		'Pacific/Guam'      => "(GMT+10:00) Guam",
		'Australia/Hobart'  => "(GMT+10:00) Hobart",
		'Australia/Melbourne' => "(GMT+10:00) Melbourne",
		'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
		'Australia/Sydney'  => "(GMT+10:00) Sydney",
		'Asia/Vladivostok'  => "(GMT+10:00) Vladivostok",
		'Asia/Magadan'      => "(GMT+11:00) Magadan",
		'Pacific/Auckland'  => "(GMT+12:00) Auckland",
		'Pacific/Fiji'      => "(GMT+12:00) Fiji",
		'Asia/Kamchatka'    => "(GMT+12:00) Kamchatka",
	);
	
	return $timezones;
}

function get_offset($timezone) {
	$timezones = array(
		'Pacific/Midway'    => "-11:00",
		'US/Samoa'          => "-11:00",
		'US/Hawaii'         => "-10:00",
		'US/Alaska'         => "-09:00",
		'US/Pacific'        => "-08:00",
		'America/Tijuana'   => "-08:00",
		'US/Arizona'        => "-07:00",
		'US/Mountain'       => "-07:00",
		'America/Chihuahua' => "-07:00",
		'America/Mazatlan'  => "-07:00",
		'America/Mexico_City' => "-06:00",
		'America/Monterrey' => "-06:00",
		'Canada/Saskatchewan' => "-06:00",
		'US/Central'        => "-06:00",
		'US/Eastern'        => "-05:00",
		'US/East-Indiana'   => "-05:00",
		'America/Bogota'    => "-05:00",
		'America/Lima'      => "-05:00",
		'America/Caracas'   => "-04:30",
		'Canada/Atlantic'   => "-04:00",
		'America/La_Paz'    => "-04:00",
		'America/Santiago'  => "-04:00",
		'Canada/Newfoundland'  => "-03:30",
		'America/Buenos_Aires' => "-03:00",
		'Greenland'         => "-03:00",
		'Atlantic/Stanley'  => "-02:00",
		'Atlantic/Azores'   => "-01:00",
		'Atlantic/Cape_Verde' => "-01:00",
		'UTC' => "+00:00",
		'Africa/Casablanca' => "+00:00",
		'Europe/Dublin'     => "+00:00",
		'Europe/Lisbon'     => "+00:00",
		'Europe/London'     => "+00:00",
		'Africa/Monrovia'   => "+00:00",
		'Europe/Amsterdam'  => "+01:00",
		'Europe/Belgrade'   => "+01:00",
		'Europe/Berlin'     => "+01:00",
		'Europe/Bratislava' => "+01:00",
		'Europe/Brussels'   => "+01:00",
		'Europe/Budapest'   => "+01:00",
		'Europe/Copenhagen' => "+01:00",
		'Europe/Ljubljana'  => "+01:00",
		'Europe/Madrid'     => "+01:00",
		'Europe/Paris'      => "+01:00",
		'Europe/Prague'     => "+01:00",
		'Europe/Rome'       => "+01:00",
		'Europe/Sarajevo'   => "+01:00",
		'Europe/Skopje'     => "+01:00",
		'Europe/Stockholm'  => "+01:00",
		'Europe/Vienna'     => "+01:00",
		'Europe/Warsaw'     => "+01:00",
		'Europe/Zagreb'     => "+01:00",
		'Europe/Athens'     => "+02:00",
		'Europe/Bucharest'  => "+02:00",
		'Africa/Cairo'      => "+02:00",
		'Africa/Harare'     => "+02:00",
		'Europe/Helsinki'   => "+02:00",
		'Europe/Istanbul'   => "+02:00",
		'Asia/Jerusalem'    => "+02:00",
		'Europe/Kiev'       => "+02:00",
		'Europe/Minsk'      => "+02:00",
		'Europe/Riga'       => "+02:00",
		'Europe/Sofia'      => "+02:00",
		'Europe/Tallinn'    => "+02:00",
		'Europe/Vilnius'    => "+02:00",
		'Asia/Baghdad'      => "+03:00",
		'Asia/Kuwait'       => "+03:00",
		'Europe/Moscow'     => "+03:00",
		'Africa/Nairobi'    => "+03:00",
		'Asia/Riyadh'       => "+03:00",
		'Europe/Volgograd'  => "+03:00",
		'Asia/Tehran'       => "+03:30",
		'Asia/Baku'         => "+04:00",
		'Asia/Muscat'       => "+04:00",
		'Asia/Tbilisi'      => "+04:00",
		'Asia/Yerevan'      => "+04:00",
		'Asia/Kabul'        => "+04:30",
		'Asia/Yekaterinburg' => "+05:00",
		'Asia/Karachi'      => "+05:00",
		'Asia/Tashkent'     => "+05:00",
		'Asia/Kolkata'      => "+05:30",
		'Asia/Kathmandu'    => "+05:45",
		'Asia/Almaty'       => "+06:00",
		'Asia/Dhaka'        => "+06:00",
		'Asia/Novosibirsk'  => "+06:00",
		'Asia/Bangkok'      => "+07:00",
		'Asia/Jakarta'      => "+07:00",
		'Asia/Krasnoyarsk'  => "+07:00",
		'Asia/Chongqing'    => "+08:00",
		'Asia/Hong_Kong'    => "+08:00",
		'Asia/Irkutsk'      => "+08:00",
		'Asia/Kuala_Lumpur' => "+08:00",
		'Australia/Perth'   => "+08:00",
		'Asia/Singapore'    => "+08:00",
		'Asia/Taipei'       => "+08:00",
		'Asia/Ulaanbaatar'  => "+08:00",
		'Asia/Urumqi'       => "+08:00",
		'Asia/Seoul'        => "+09:00",
		'Asia/Tokyo'        => "+09:00",
		'Asia/Yakutsk'      => "+09:00",
		'Australia/Adelaide' => "+09:30",
		'Australia/Darwin'  => "+09:30",
		'Australia/Brisbane' => "+10:00",
		'Australia/Canberra' => "+10:00",
		'Pacific/Guam'      => "+10:00",
		'Australia/Hobart'  => "+10:00",
		'Australia/Melbourne' => "+10:00",
		'Pacific/Port_Moresby' => "+10:00",
		'Australia/Sydney'  => "+10:00",
		'Asia/Vladivostok'  => "+10:00",
		'Asia/Magadan'      => "+11:00",
		'Pacific/Auckland'  => "+12:00",
		'Pacific/Fiji'      => "+12:00",
		'Asia/Kamchatka'    => "+12:00",
	);
	foreach($timezones as $tz => $offset){
		if($timezone == $tz){
			$output = $offset;
		}
	}
	return $output;
}

function valid_pass($candidate) {
   $r1='/[A-Z]/';  //Uppercase
   $r2='/[a-z]/';  //lowercase
   $r3='/[!@#$%^&*()-_=+{};:,<.>]/';  // whatever you mean by 'special char'
   $r4='/[0-9]/';  //numbers

   if(preg_match_all($r1,$candidate, $o)<1) return FALSE;


   if(preg_match_all($r2,$candidate, $o)<1) return FALSE;

   if(preg_match_all($r3,$candidate, $o)<1) return FALSE;

   if(preg_match_all($r4,$candidate, $o)<1) return FALSE;

   if(strlen($candidate)<6) return FALSE;

   return TRUE;
}

function isValidTimeStamp($timestamp){
	$timestamp = strval($timestamp);
	return ((string) (int) $timestamp === $timestamp) && ($timestamp <= PHP_INT_MAX) && ($timestamp >= ~PHP_INT_MAX);
}

function dateToTimeStamp($time){
	$timestamp = explode("/", $time);
	$timestamp =  mktime(0, 0, 0, $timestamp[0], $timestamp[1], $timestamp[2]);
	return $timestamp;
}

function mkdirfull($dir){
	$dir = explode('/', $dir);
	$path = '';
	if($dir)foreach($dir as $v){
		if( $v && $v != '.' && $v != '..' ){
			$path .= $v . '/';
			if( !file_exists($path) )
				if( !@mkdir( $path ) )
					return false;
		}// end if($v != '.'...
	}//end foreach($dir)
	return true;
}

function createprecrop($image, $filename, $thumb_width, $thumb_height){			
	$width = imagesx($image);
	$height = imagesy($image);
	
	$original_aspect = $width / $height;
	$thumb_aspect = $thumb_width / $thumb_height;
	
	if($original_aspect >= $thumb_aspect) {
	   // If image is wider than thumbnail (in aspect ratio sense)
	   $new_height = $thumb_height;
	   $new_width = $width / ($height / $thumb_height);
	} else {
	   // If the thumbnail is wider than the image
	   $new_width = $thumb_width;
	   $new_height = $height / ($width / $thumb_width);
	}
	
	$thumb = imagecreatetruecolor($thumb_width, $thumb_height);
	
	// Resize and crop
	imagecopyresampled($thumb,
					   $image,
					   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
					   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
					   0, 0,
					   $new_width, $new_height,
					   $width, $height);
	imagejpeg($thumb, $filename, 80);
	
	return true;
}

function in_array_recursive($needle, $haystack) {

    $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($haystack));

    foreach($it AS $element) {
        if($element == $needle) {
            return true;
        }
    }

    return false;
} 

function first(&$array) {
	if (!is_array($array)) return $array;
	if (!count($array)) return null;
	reset($array);
	return $array[key($array)];
}

function last(&$array) {
	if (!is_array($array)) return $array;
	if (!count($array)) return null;
	end($array);
	return $array[key($array)];
}

function currency($money, $format=false){
	if($format == "max"){
		return money_format('%(#10n', $money);
	} else {
		return sprintf("%01.2f", $money);
	}
}


function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
} 

function objectToArray($d) {
	if (is_object($d)) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars($d);
	}

	if (is_array($d)) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map(__FUNCTION__, $d);
	}
	else {
		// Return array
		return $d;
	}
}

function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

function sortBystart($a, $b) {
    return $a['start'] - $b['start'];
}

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

function sort_by_start($a, $b)
{
    return strcmp($a['start'], $b['start']);
}

function time_ago($date,$granularity=2) {
    $difference = time() - $date;
    $periods = array('decade' => 315360000,
        'year' => 31536000,
        'month' => 2628000,
        'week' => 604800, 
        'day' => 86400,
        'hour' => 3600,
        'minute' => 60,
        'second' => 1);

    foreach ($periods as $key => $value) {
        if ($difference >= $value) {
            $time = floor($difference/$value);
            $difference %= $value;
            $retval .= ($retval ? ' ' : '').$time.' ';
            $retval .= (($time > 1) ? $key.'s' : $key);
            $granularity--;
        }
        if ($granularity == '0') { break; }
    }
	if($retval)
    	return $retval.' ago';
	else 
		return false; 
}

function time_until($date,$granularity=2) {
    $difference = $date - time();
	//echo $difference;
    $periods = array('decade' => 315360000,
        'year' => 31536000,
        'month' => 2628000,
        'week' => 604800, 
        'day' => 86400,
        'hour' => 3600,
        'minute' => 60,
        'second' => 1);

    foreach ($periods as $key => $value) {
        if ($difference >= $value) {
            $time = floor($difference/$value);
            $difference %= $value;
            $retval .= ($retval ? ' ' : '').$time.' ';
            $retval .= (($time > 1) ? $key.'s' : $key);
            $granularity--;
        }
        if ($granularity == '0') { break; }
    }
	if($retval)
    	return $retval;
	else 
		return false;
}

function get_time_until($time){
	if(time_until($time) !== false){
		$output = time_until($time);
	} else {
		$output = time_ago($time);
	}
	return $output;
}

function percentage_total($percent, $total, $precision){
	$value = round(($percent / 100)*$total, $precision );
	return $value;
}
function percentage($val1, $val2, $precision){
	$res = round( ($val1 / $val2) * 100, $precision );
	return $res;
}

function createArray($input,$title) {
	foreach($input as $key => $value) {
		$_SESSION[$title][$key] = $value;
	}
}
function emptyArray($title) {
	if(!empty($_SESSION[$title])){
		foreach($_SESSION[$title] as $key => $value) {
			$_SESSION[$title][$key] = "";
		}
	}
}
function random_img($dir = 'images/slider_images'){
    $files = glob($dir . '/*.*');
    $file = array_rand($files);
    return "/".$files[$file];
}

function shuffle_assoc(&$array) {
	$keys = array_keys($array);
	shuffle($keys);
	foreach($keys as $key) {
		$new[$key] = $array[$key];
	}
	$arraynew = $new;
	return $arraynew;
}

function gen_select_options($data,$selected = false) {
	//generates select options from an array	
}
function debug_var($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
function getNormalizedFILES() 
	{ 
		$newfiles = array(); 
		foreach($_FILES as $fieldname => $fieldvalue) 
			foreach($fieldvalue as $paramname => $paramvalue) 
				foreach((array)$paramvalue as $index => $value) 
					$newfiles[$fieldname][$index][$paramname] = $value; 
		return $newfiles; 
	}
function image_type_filter($type){
	$type = str_replace('image/', '', $type);
	$type = str_replace('pjpeg', 'jpeg', $type);
	$type = str_replace('x-gif', 'gif', $type);
	return $type;
}
function states() {
	$state_list = array(
		'AL'=>"Alabama",  
		'AK'=>"Alaska",  
		'AZ'=>"Arizona",  
		'AR'=>"Arkansas",  
		'CA'=>"California",  
		'CO'=>"Colorado",  
		'CT'=>"Connecticut",  
		'DE'=>"Delaware",  
		'DC'=>"District Of Columbia",  
		'FL'=>"Florida",  
		'GA'=>"Georgia",  
		'HI'=>"Hawaii",  
		'ID'=>"Idaho",  
		'IL'=>"Illinois",  
		'IN'=>"Indiana",  
		'IA'=>"Iowa",  
		'KS'=>"Kansas",  
		'KY'=>"Kentucky",  
		'LA'=>"Louisiana",  
		'ME'=>"Maine",  
		'MD'=>"Maryland",  
		'MA'=>"Massachusetts",  
		'MI'=>"Michigan",  
		'MN'=>"Minnesota",  
		'MS'=>"Mississippi",  
		'MO'=>"Missouri",  
		'MT'=>"Montana",
		'NE'=>"Nebraska",
		'NV'=>"Nevada",
		'NH'=>"New Hampshire",
		'NJ'=>"New Jersey",
		'NM'=>"New Mexico",
		'NY'=>"New York",
		'NC'=>"North Carolina",
		'ND'=>"North Dakota",
		'OH'=>"Ohio",  
		'OK'=>"Oklahoma",  
		'OR'=>"Oregon",  
		'PA'=>"Pennsylvania",  
		'RI'=>"Rhode Island",  
		'SC'=>"South Carolina",  
		'SD'=>"South Dakota",
		'TN'=>"Tennessee",  
		'TX'=>"Texas",  
		'UT'=>"Utah",  
		'VT'=>"Vermont",  
		'VA'=>"Virginia",  
		'WA'=>"Washington",  
		'WV'=>"West Virginia",  
		'WI'=>"Wisconsin",  
		'WY'=>"Wyoming");
		
		return $state_list;
}

function display_paging_session_html(){
	if($_SESSION['paging']['html']){
		echo $_SESSION['paging']['html'];
		unset($_SESSION['paging']);
	}
}

function array2csv(array &$array){
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

function get_page_number(){
	$pg = $_GET['page'];
	if(!is_numeric($pg) || empty($pg)){
		$pg = 1;
	}
	return $pg;
}
?>