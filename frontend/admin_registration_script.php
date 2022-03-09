<?php
    include 'connect.php';

        // establish server connection
        define("encryption_method", "AES-128-CBC");
        define("key", "batgirl_to_the_rescue");
    
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


    $adminname=""; //username for admin
    $email=""; //admin email
    $password=""; //admin password

    $mail_encrypted=encrypt($email);
    $password_encrypted=encrypt($password);

    $sql="INSERT INTO admin (adminname, email, password) VALUES ('$adminname', '$mail_encrypted', '$password_encrypted')";

    if(mysqli_query($link, $sql)){
        echo "Success";
    }


?>