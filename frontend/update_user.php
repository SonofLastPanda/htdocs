<?php
#This file updates userinformation

    // establish server connection
    define("encryption_method", "AES-128-CBC");
    define("key", "batgirl_to_the_rescue");
    include 'connect.php';
    session_start();

    //encrypt data
    function encrypt($data) {
    $key = key;
    $plaintext = $data;
    $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
    return $ciphertext;
    }
   
    $old_username=$_SESSION["username"];
    $new_username=$_POST["new_username"];
    $new_email=$_POST["new_useremail"];
    $new_password=$_POST["new_userpassword"];
    $new_confirmpassword=$_POST["new_confirmpassword"];
    $new_nationality=$_POST["new_nationality"];
    $remove_bookmark=$_POST["TO"];

    $error_string = "";
    #Check if username already occupied
    if ($new_username!=$old_username) {
        $sql1="SELECT * FROM users WHERE users.username='$new_username'";
        $sql2="SELECT * FROM admin WHERE admin.adminname='$new_username'";
        #print mysqli_query($link, $sql1);
        if (mysqli_num_rows(mysqli_query($link, $sql1))>0 || mysqli_num_rows(mysqli_query($link, $sql2))>0) {
            $error_string='Username already taken. Try another username!';
        }
    }

    #Check if different passwords were entered
    if ($new_password != $new_confirmpassword) {
        $error_string='Failed updating password. Passwords does not match.';
    }

    #Error message if passwords doesn't match or username already used
    if ($error_string) {
    echo "<script type='text/javascript'>alert('$error_string');
    window.location='user_info.php';
    </script>";

    } else {
    header("location: user_frontpage.php");
    #Transaction to update database
    mysqli_autocommit($link, FALSE);
    $queries_ok=TRUE;

    if ($remove_bookmark!="Bookmark") {
        mysqli_query($link, "DELETE FROM bookmark WHERE bookmark.user_id IN
        (SELECT users.user_id
        FROM users
        WHERE users.username='$old_username')
        AND bookmark.country_id IN
        (SELECT country.country_id
        FROM country
        WHERE country.country_name='$remove_bookmark')") ? null: $queries_ok=FALSE;
    }

    $en_email=encrypt($new_email);
    $en_password=encrypt($new_password);
    
    mysqli_query($link, "UPDATE users SET password='$en_password', email='$en_email', citizenship='$new_nationality', username='$new_username' WHERE username='$old_username'") ? null: $queries_ok=FALSE;

    //Commit Transactionn
    if ($queries_ok) {
        mysqli_commit($link);
        $_SESSION['username']=$new_username;
    } else {
        echo "Commit transaction failed";
        mysqli_rollback($link);
        exit();
    }
    }

    include 'close.php';
?>