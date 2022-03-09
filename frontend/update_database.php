<?php
    include 'connect.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';
    
    define("encryption_method", "AES-128-CBC");
    define("key", "batgirl_to_the_rescue");

   
    //include 'admin_frontpage.php';
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
      

    $FROM=$_GET["from"];
    $TO=$_GET["to"];
    $id=$_GET["id"];
    $boarding=$_GET["boarding"];
    $quarantine=$_GET["quarantine"];
    $vaccination=$_GET["vaccination"];
    $facemask=$_GET["face_mask"];
    $transport=$_GET["transport"];
    $business=$_GET["business"];
    $restaurants=$_GET["restaurants"];
    $reminder=$_GET["reminder"];
    //$sources=$_GET["sources"];

    
    //typo in db, therefore qurantine, instead of Quarantine.
    $sql="UPDATE regulation 
    SET 
    regulation.Boarding='$boarding', 
    regulation.Qurantine='$quarantine', 
    regulation.Vaccine='$vaccination',
    regulation.Face_mask='$facemask',
    regulation.Public_transportation='$transport',
    regulation.Businesses='$business',
    regulation.Restaurants='$restaurants',
    regulation.Reminder='$reminder'
    
    WHERE regulation.id='$id'";
    //echo  $sql;
    if(!mysqli_query($link,$sql))
    {
        echo "The update process has failed.";
            
    }

    
    $sql = "SELECT * FROM bookmark WHERE bookmark.country_id IN
        (SELECT country.country_id
        FROM country WHERE country.country_name= '$TO'
        )";
    $users=mysqli_query($link,$sql);



        //echo $email

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
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
    $mail->Subject = 'Changes in Your Bookmarked Destinations in CoTRACK';
    $mail->Body    = "Hello!
    There are new changes in your bookmarked destination FROM: $FROM TO: $TO. 
    Visit CoTRACK to check them out before your travels.
    Safe Journeys!
    CoTRACK19 TEAM";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    foreach($users as $row)
    {
    $userid=$row['user_id'];
    $sql="SELECT * FROM users WHERE users.user_id='$userid';";
    $row_user=mysqli_fetch_row(mysqli_query($link, $sql));
    $email_en=$row_user[1];
    $username=$row_user[4];
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
    
    
    
    //echo 'Message has been sent';  
    //$mail->clearAddresses();
    }
    $mail->send();
    header("Location: ./admin_frontpage.php?FROM=$FROM&TO=$TO");
    
    include 'close.php';
?>