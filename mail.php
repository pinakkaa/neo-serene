<?php

session_start();

 //define("WEBMASTER_EMAIL", 'info@imsolutions.mobi');

 //define("WEBMASTER_EMAIL1", 'atul@imsolutions.mobi');

 //define("WEBMASTER_EMAIL2", 'apnaswarg@gmail.com');

 //ini_set('display_errors', 1);
 //ini_set('display_startup_errors', 1);
 //error_reporting(E_ALL);

define("WEBMASTER_EMAIL", 'info@imsolutions.mobi');
define("WEBMASTER_EMAIL1", 'atul@imsolutions.mobi');
define("WEBMASTER_EMAIL2", 'apnaswarg@gmail.com');


error_reporting(E_ALL & ~E_NOTICE);

function ValidateEmail($value) {
    $regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
    if ($value == '') {
        return false;
    } else {
        $string = preg_replace($regex, '', $value);
    }
    return empty($string) ? true : false;
}

function validate_mobile($phone) {
    return preg_match('/^[0-9]{10}+$/', $phone);
}

if(isset($_POST['FirstName']) && isset($_POST['Mobile']) && isset($_POST['Email'])){
    $name = $_POST['FirstName'];
    $email = $_POST['Email'];
    $phone = $_POST['Mobile'];
    $query = $_POST['Remark'];
   // echo 'working';
  
    $subject = 'Enquiry from  Aashrithaa Divine';
    $error = '';

    // Check fullname
    

    $email_name =  "Aashrithaa Divine";
    $email_to = "noreply@aashrithaa.com";
    $headers = 'MIME-Version: 2.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: ' . $email_name . ' <' . $email_to . '>' . "\r\n";
    $message = '
    <img src = "https://divine.aashrithaa.com/images/Aashrithaa-Logo.png" alt="newtown" style = "width:100px; display:block; margin:0% auto">

    <table cellspacing="0" cellpadding="0" style="width:100%; border-bottom:1px solid #eee; font-size:12px; line-height:135%">

    
   
    <tr style="background-color:#f5f5f5">
        <th style="vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee">Name <span style="color:red">*</span></th>
        <td style="vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee">' . $name . '</td>
    </tr>
    <tr style="">
        <th style="vertical-align: top;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee">Email <span style="color:red">*</span></th>
        <td style="vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee">' . $email . '</td>
    </tr>
    <tr style="background-color:#f5f5f5">
        <th style="vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee">Phone Number <span style="color:red">*</span></th>
        <td style="vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee">' . $phone . '</td>
    </tr>
    <tr>
        <th style="vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee">Message <span style="color:red">*</span></th>
        <td style="vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee">' . $query . '</td>
    </tr>
    </table>';

    // ini_set("sendmail_from", 'info@imsolutions.mobi'); // for windows server
    $mail = mail(WEBMASTER_EMAIL, $subject, $message, $headers, '-freturn@aashrithaa.com');
    $mail1 = mail(WEBMASTER_EMAIL1, $subject, $message, $headers, '-freturn@aashrithaa.com');
    $mail2 = mail(WEBMASTER_EMAIL2, $subject, $message, $headers, '-freturn@aashrithaa.com');
   
    
  //  echo json_encode(['result' => true]);

    if (true) {  
       
        date_default_timezone_set('Asia/Kolkata');

        $utilities_path = __DIR__ . DIRECTORY_SEPARATOR . "./../../utilities";

        $google_helper = $utilities_path . "/google/helper.php";

        require_once($google_helper);

        $data = [$name,$phone, $email, $query, 'Aashrithaa Divine'];

        $sheet_id = "1AsVBoLE4ML5RNa1IVtEwyijVntgjYnZRxayc24j7270";
        if(saveDataToSheet($sheet_id,$data)) {
            echo json_encode(['result' => true]);
        }
       
           
       
       
      
    }
}


