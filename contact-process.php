<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

//define("WEBMASTER_EMAIL", 'info@imsolutions.mobi');
//define("WEBMASTER_EMAIL1", 'atul@imsolutions.mobi');

//define("WEBMASTER_EMAIL", 'lokesh@imsolutions.mobi');

define("WEBMASTER_EMAIL", 'apnaswarg@gmail.com');//sales@aashrithaa.com
// define("WEBMASTER_EMAIL1", 'atul@imsolutions.mobi');
define("WEBMASTER_EMAIL2", 'info@imsolutions.mobi');
define("WEBMASTER_EMAIL3", 'murali@aashrithaa.com');



function ValidateEmail($value)
{
    $regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
    if ($value == '') {
        return false;
    } else {
        $string = preg_replace($regex, '', $value);
    }
    return empty($string) ? true : false;
}
function validate_mobile($phone)
{
    return preg_match('/^[0-9]{10}+$/', $phone);
}
if ($_POST) {
    $name = stripslashes(trim($_POST['name']));
    $email = stripslashes(trim($_POST['email']));
    $ccode = "91";
    $phone = stripslashes(trim($_POST['mobile']));
    $query = stripslashes(trim($_POST['comment']));
    // $captcha = $_POST['g-recaptcha-response'];
    $subject = 'Enquire Now For Brochure - Aashrithaa Divine ';
    $error = '';
    // Check fullname
    if (!$name || empty($name)) {
        $error .= 'Please enter your Name.<br />';
        die('<p style="color:red;width:100%;">Please enter your Name</p>');
    }
    if (!$email || empty($email)) {
        $error .= 'Please enter an e-mail address.<br />';
        die('<p style="color:red;width:100%;">Please enter an e-mail address</p>');
    }
    if ($email && !ValidateEmail($email)) {
        $error .= 'Please enter a valid e-mail address.<br />';
        die('<p style="color:red;width:100%;">Please enter a valid e-mail address</p>');
    }
    /*if (!$ccode) {
        $error .= 'Please Select your Country Code.<br />';
        die('<p style="color:red;width:100%;">Please Select your Country Code</p>');
    }*/
    if (!$phone || !validate_mobile($phone)) {
        $error .= 'Enter 10 digit mobile number.<br />';
        die('<p style="color:red;width:100%;">Enter 10 digit mobile number</p>');
    }
    if (!$phone || empty($phone)) {
        $error .= 'Please enter your phone.<br />';
        die('<p style="color:red;width:100%;">Please enter your phone</p>');
    }
    if (!$query || empty($query)) {
        $error .= 'Please enter your message.<br />';
        die('<p style="color:red;width:100%;">Please enter your message</p>');
    }
    if (strlen($query) != mb_strlen($query, 'utf-8')) {
        $error .= 'Please enter English words only.<br>';
        die('<p style="color:red;width:100%;margin:0px;">Please enter English words only</p>');
    }

    if (strpos($query, 'http://') !== false) {
        $error .= 'Invalid Message!.<br>';
        die('<p style="color:red;width:100%;margin:0px;">Invalid Message!</p>');
    }

    if (strpos($query, 'https://') !== false) {
        $error .= 'Invalid Message!.<br />';
        die('<p style="color:red;width:100%;margin:0px;">Invalid Message!</p>');
    }

    if (strlen($query) > 200) {
        $error .= 'Characters limit 200 only!.<br />';
        die('<p style="color:red;width:100%;margin:0px;">Characters limit 200 only!</p>');
    }

    if (preg_match("/<[^<]+>/", $query, $m) == 1) {
        $error .= 'Invalid Message!.<br />';
        die('<p style="color:red;width:100%;margin:0px;">Invalid Message!</p>');
    }



    $email_name = "Aashrithaa Divine";
    $email_to = "noreply@aashrithaa.com";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: ' . $email_name . ' <' . $email_to . '>' . "\r\n";
    $message = '<table cellspacing="0" cellpadding="0" style="width:100%; border-bottom:1px solid #eee; font-size:12px; line-height:135%">


        <tr align="center">
            <td colspan="3" style="text-align:center;">
               <img src="https://divine.aashrithaa.com/images/Aashrithaa-Logo-f.png" style="max-width:220px;background-color: rgb(36, 38, 45);">
            </td>
        </tr>
        <tr style="background-color:#f5f5f5">
                <th style="vertical-align:top ;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee">Name <span style="color:red">*</span></th>
                        <td style="vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee">' . $name . '</td>
        </tr>
        <tr style="">
                <th style="vertical-align: top;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee">Email <span style="color:red">*</span></th>
                        <td style="vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee">' . $email . '</td>
        </tr>
        <tr style="background-color:#f5f5f5">
                <th style="vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee">Phone Number <span style="color:red">*</span></th>
                        <td style="vertical-align:top;c olor:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee">' . $ccode . ' - ' . $phone . '</td>
        </tr>
        <tr>
                <th style="vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee">Message <span style="color:red">*</span></th>
                        <td style="vertical-align:top;c olor:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee">' . $query . '</td>
        </tr>

</table>';

    //ini_set("sendmail_from", 'info@imsolutions.mobi'); // for windows server
    $mail  = mail(WEBMASTER_EMAIL,$subject,$message,$headers,'-freturn@aashrithaa.com');
    // $mail1 = mail(WEBMASTER_EMAIL1,$subject,$message,$headers,'-freturn@aashrithaa.com');
    $mail2 = mail(WEBMASTER_EMAIL2,$subject,$message,$headers,'-freturn@aashrithaa.com');
    $mail3 = mail(WEBMASTER_EMAIL3,$subject,$message,$headers,'-freturn@aashrithaa.com');
    if (true) {

            date_default_timezone_set('Asia/Kolkata');
         

            $utilities_path = __DIR__ . DIRECTORY_SEPARATOR . "./../../utilities";



            $google_helper = $utilities_path . "/google/helper.php";

    

            require_once($google_helper);

    

            $data = [$name, $phone, $email, $query,'Aashrithaa Divine'];

    

            $sheet_id = "1AsVBoLE4ML5RNa1IVtEwyijVntgjYnZRxayc24j7270";

            if(saveDataToSheet($sheet_id,$data)){ 

                echo  'OK';
                die();

            }

            /////////////////////////////////google sheet code end here/////////////////////////
    }
}