<?php
#This file updates admin account information

    // establish server connection
    define("encryption_method", "AES-128-CBC");
    define("key", "batgirl_to_the_rescue");
    include 'connect.php';
    session_start();

    #To prevent unlogged in users to enter this page
    if ((!isset($_SESSION['username'])) || ($_SESSION['admin']==FALSE)) {
    header("location: login.php");
    die();
    }

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

    $username=$_SESSION['username'];
    $new_email=$_POST["useremail"];
    $new_password=$_POST["userpassword"];

    header("location: admin_frontpage.php");
    #Transaction to update database
    mysqli_autocommit($link, FALSE);
    $queries_ok=TRUE;

    $en_email=encrypt($new_email);
    $en_password=password_hash($new_password,PASSWORD_ARGON2I);

    mysqli_query($link, "UPDATE admin SET password='$en_password', email='$en_email' WHERE adminname='$username'") ? null: $queries_ok=FALSE;

    //Commit Transactionn
    if ($queries_ok) {
        mysqli_commit($link);
    } else {
        echo "Commit transaction failed";
        mysqli_rollback($link);
        exit();
    }
    }

    include 'close.php';
?>