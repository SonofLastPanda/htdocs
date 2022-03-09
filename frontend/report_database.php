<?php
    include 'connect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';
    
    define("encryption_method", "AES-128-CBC");
    define("key", "batgirl_to_the_rescue");

    function decrypt($data) {
        $key = key;
        $c = base64_decode($data);
        $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        if (hash_equals($hmac, $calcmac))
        {
            return $original_plaintext;
        }
    }


    


    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'cotrack19@outlook.com';                     //SMTP username
    $mail->Password   = 'batgirl.ims';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->setFrom('cotrack19@outlook.com', 'CoTRACK19');    

    $mail->addAttachment('./logo1.2.png');    //Optional name
        
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'There Are New Reports in COTRACK!';

    /*
    $body_script="
    There are new reports for invalid information for the destination: \n
    FROM: $FROM TO: $TO. \n";

    $boarding=$_REQUEST["new_boarding_info"];
    $quarantine=$_GET["new_quarantine_info"];
    //$regulation=$_GET["new_regulation_info"];
    $vaccination=$_GET["new_vaccination_info"];
    $facemask=$_GET["new_facemask_info"];
    $transport=$_GET["new_publictransport_info"];
    $business=$_GET["new_business_info"];
    $sources=$_GET["new_sources_info"];

    if(!empty($boarding)){
        $body_script=$body_script."Boarding:" .$boarding." \n";
    }
    if(!empty($quarantine)){
        $body_script=$body_script."Quarantine: ".$quarantine." \n";
    }
    if(!empty($vaccination)){
        $body_script=$body_script."Vaccination: ".$vaccination." \n";
    }
    if(!empty($transport)){
        $body_script=$body_script."Public Transport :".$transport." \n";
    }
    if(!empty($business)){
        $body_script=$body_script."Business: ".$business." \n";
    }
    if(!empty($sources)){
        $body_script=$body_script."Sources: ".$sources." \n";
    }
    

    $body_script=$body_script."Go to CoTRACK to review those reports! \n Safe Days,\n CoTRACK TEAM";

    */
    $from=$_GET["FROM"];
    $to=$_GET["TO"];
    $sql="SELECT * FROM regulation WHERE regulation.FROM='$from' AND regulation.TO='$to'";
    //echo $sql;
    $result=mysqli_query($link, $sql);
    $row=mysqli_fetch_row($result);
    $id=$row[0];
    //echo $id;


    $sql="SELECT * FROM admin";
    $result=mysqli_query($link,$sql);

    foreach($result as $row)
    {
    $email_en=$row['email'];
    $name=$row['adminname'];
    //echo $email_en;
    $email=decrypt($email_en);
    //echo $email;
    //Recipients
 
    $mail->addAddress($email);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC($email);
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->Body  = "Hello $name! \n".$body_script;
    
    $mail->send();
    //echo 'Message has been sent';  
    $mail->clearAddresses();
    }


?>