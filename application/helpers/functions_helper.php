<?php 

function out($p){
	echo "<pre>";
	print_r($p);
	echo "</pre>";
}
function get_date($date,$first,$second,$third){
    if((($date % 10) > 4 && ($date % 10) < 10) || ($date > 10 && $date < 20)){
        return $second;
    }
    if(($date % 10) > 1 && ($date % 10) < 5){
        return $third;
    }
    if(($date%10) == 1){
        return $first;
    }
    else{
        return $second;
    }
}
function timespan($seconds = 1, $time = '')
{
    if ( ! is_numeric($seconds))
    {
    	$seconds = 1;
    }
    if ( ! is_numeric($time))
    {
    	$time = time();
    }
    if ($time <= $seconds)
    {
    	$seconds = 1;
    }
    else
    {
    	$seconds = $time - $seconds;
    }

    $str = array();
    $years = floor($seconds / 31536000);

    if ($years > 0)
    {
    	$str[] = $years.' '.get_date($years,'Year','Year','Year');
    }

      	$seconds -= $years * 31536000;
    $months = floor($seconds / 2628000);

    if ($years > 0 OR $months > 0)
    {
    	if ($months > 0)
    	{
    		$str[] = $months.' '.get_date($months,'month','month','month');
    	}

              $seconds -= $months * 2628000;
    }
	
    if ($str == '')
    {
       $str[] = $seconds.' '.get_date($seconds,'second','second','second');
    }

    return $str;
}
function get_numeric($d){
		$reg_ex = '/[0-9]+/';
		preg_match_all($reg_ex,$d,$matches);
		return $matches;
	
	}
	function different_time_now($date1){
			$datestring = "%Y-%m-%d";
			$time = time();
			$date2 =  mdate($datestring, $time);
			$time1 = new DateTime("{$date1}");
			$time2 = new DateTime("{$date2}");
			$interval = $time1->diff($time2);
			$midl = explode('-',$interval->format('%Y-%m-%d'));
			
			if($midl[0] == '00' && $midl[1] == '0' && $midl[2] != '0'){
				$diff = $midl[2].' day';
			}elseif($midl[0] == '00' && $midl[1] != '0' && $midl[2] != '0'){
				$diff = $midl[1].' months '.$midl[2].' days';
			}elseif($midl[0] != '00' && $midl[1] == '0' && $midl[2] != '0'){
				$diff = $midl[0].' years '.$midl[1].' months '.$midl[2].' days';
			}else{
				$diff = 0;
			}
		return $diff;
	}
function image_thumb( $image_path, $height, $width ) {
    // Get the CodeIgniter super object
    $CI =& get_instance();
    // Path to image thumbnail
    $image_thumb = dirname( $image_path ).'/'.md5(basename($image_path)).$height .'_'.$width .'.jpg';

    if ( !file_exists( $image_thumb ) ) {
        // LOAD LIBRARY
        $CI->load->library( 'image_lib' );

        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
        $config['height']           = $height;
        $config['width']            = $width;
        $CI->image_lib->initialize( $config );
        $CI->image_lib->resize();
        $CI->image_lib->clear();
    }

    return '<img src="'.$image_thumb.'" />';
}
function parse_signed_request($signed_request) {
		list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
		$secret = "5887e02e4c087f79b0adc0663188c305"; 
		$sig = base64_url_decode($encoded_sig);
		$data = json_decode(base64_url_decode($payload), true);

		$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
		  if ($sig !== $expected_sig) {
			error_log('Bad Signed JSON signature!');
			return null;
		  }
	return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
	}
function getDatesBetween2Dates($startTime, $endTime) {
    $day = 86400;
    $format = 'Y-m-d';
    $startTime = strtotime($startTime);
    $endTime = strtotime($endTime);
    $numDays = round(($endTime - $startTime) / $day) + 1;
    $days = array();
        
    for ($i = 0; $i < $numDays; $i++) {
        $days[] = date($format, ($startTime + ($i * $day)));
    }
        
    return $days;
}
?>