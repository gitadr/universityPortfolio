<?PHP
######################################################
#                                                    #
#                Forms To Go 3.2.5                   #
#             http://www.bebosoft.com/               #
#                                                    #
######################################################



DEFINE('kOptional', true);
DEFINE('kMandatory', false);




error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('track_errors', true);

function DoStripSlashes($FieldValue) 
{ 
 if ( get_magic_quotes_gpc() ) { 
  if (is_array($FieldValue) ) { 
   return array_map('DoStripSlashes', $FieldValue); 
  } else { 
   return stripslashes($FieldValue); 
  } 
 } else { 
  return $FieldValue; 
 } 
}

#----------
# FilterCChars:

function FilterCChars($TheString)
{
 return preg_replace('/[\x00-\x1F]/', '', $TheString);
}

#----------
# Validate: Email

function check_email($email, $optional)
{
 if ( (strlen($email) == 0) && ($optional === kOptional) ) {
  return true;
 } elseif ( eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email) ) {
  return true;
 } else {
  return false;
 }
}



if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
 $ClientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
 $ClientIP = $_SERVER['REMOTE_ADDR'];
}

$FTGauthor = DoStripSlashes( $_REQUEST['author'] );
$FTGemail = DoStripSlashes( $_REQUEST['email'] );
$FTGurl = DoStripSlashes( $_REQUEST['url'] );
$FTGcomment = DoStripSlashes( $_REQUEST['comment'] );
$FTGsubmit = DoStripSlashes( $_REQUEST['submit'] );


# Fields Validations

$ValidationFailed = false;

if (!check_email($FTGemail, kMandatory)) {
 $ValidationFailed = true;
}


# Redirect user to the error page

if ($ValidationFailed === true) {

 header("Location: http://www.adroot.co.uk/portfolio/sorry");
 exit;

}
# Email to Form Owner

$emailSubject = FilterCChars("Someone has just hello!");

$emailBody = "author : $FTGauthor\n"
 . "email : $FTGemail\n"
 . "url : $FTGurl\n"
 . "comment : $FTGcomment\n"
 . "submit : $FTGsubmit\n"
 . "";
 $emailTo = 'Aaron <aaron@adroot.co.uk>';
  
 $emailFrom = FilterCChars("$FTGemail");
  
 $emailHeader = "From: $emailFrom\n"
  . "MIME-Version: 1.0\n"
  . "Content-type: text/plain; charset=\"ISO-8859-1\"\n"
  . "Content-transfer-encoding: 8bit\n";
  
 mail($emailTo, $emailSubject, $emailBody, $emailHeader);


# Redirect user to success page

header("Location: http://www.adroot.co.uk/portfolio/thankyou");
exit;
?>