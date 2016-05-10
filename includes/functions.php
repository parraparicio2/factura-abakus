<?php
    require_once('db.php');






/**
 * trim_text()
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string 
 */
function trim_text($input, $length, $ellipses = true, $strip_html = true, $url = "") {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
  
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
  
    //add ellipses (...)
    if ($ellipses) {
        if ($url) {
            $trimmed_text .= "<a href='".$url."' target = '_blank'>...</a>";
        }else
            $trimmed_text .= '...';
    }
  
    return $trimmed_text;
}

/**
 * SendEmail()
 * Send a Email 
 * @param string email address to send
 * @param string email subject 
 * @param string email body
 * @return boolean 
 */

function SendEmail($to = "", $subject = "" , $body = ""){

    if (empty($body)){
        $body = "NONE";
    }
    
	// send email
    $result = mail($to, $subject, $body);

    if($result){
        return true;
    }
    else{
        return false;
    }
 }
 
 
/**
 * generateRandomString()
 * Generate ramdon string 
 * @param integer character length 
 * @return string 
 */ 
function generateRandomString($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-@[]{},.!#$%&/()';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * load on var sessions data from users
 * @param string username or email 
 * @param string password
 * @param string logintype
 * @return array 
 */
function InsertLog($tipo, $descripcion){
   	
    if ($tipo == 'u')
        $descripcion = 'Actualizar' ." - " .$descripcion; 
    
    if ($tipo == 'd')
        $descripcion = 'Eliminar' ." - " .$descripcion; 
    
    if ($tipo == 's')
        $descripcion = 'Consulta' ." - " .$descripcion; 
            
    $query ="insert into log (fecha, descripcion) values (current_timestamp, '$descripcion')";
	$result = phpmkr_query($query);
        return @$result;
}


/**
 * Send a email with attachacment
 * @param string filepath  
 * @param string mailto email to send  
 * @param string from email
 * @param string from name   
 * @param string email to reply  
 * @return object
 */
function mail_attachment($filepath, $filename, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $filepath;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";


    $nmessage = "--".$uid."\r\n";
    $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $nmessage .= $message."\r\n\r\n";
    $nmessage .= "--".$uid."\r\n";
    $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; 
    $nmessage .= "Content-Transfer-Encoding: base64\r\n";
    $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $nmessage .= $content."\r\n\r\n";
    $nmessage .= "--".$uid."--";
    error_reporting(E_ALL);
    if (mail($mailto, $subject, $nmessage, $header)) {
        return true;
    } else {
        return false;
    }

}

/**
 * Return Base url
 * @return string
 */
function getBaseUrl() {

	$protocol = 'http';
	if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')) {
		$protocol .= 's';
		$protocol_port = $_SERVER['SERVER_PORT'];
	} else {
		$protocol_port = 80;
	}

	$host = $_SERVER['HTTP_HOST'];
	$port = $_SERVER['SERVER_PORT'];
	$request = $_SERVER['PHP_SELF'];
	return dirname($protocol . '://' . $host . ($port == $protocol_port ? '' : ':' . $port) . $request);
}

