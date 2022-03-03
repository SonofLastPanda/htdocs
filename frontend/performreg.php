<!DOCTYPE html>
<html>
  
<head>
    <title>Validation</title>
</head>
  
<body>
    <center>

<?php
    // establish server connection
    define("encryption_method", "AES-128-CBC");
    define("key", "your_amazing_key_here"); //change the encryption key?? The web site says one should
    include 'connect.php';

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

    // valuess
    //$username = $_REQUEST["username"]; 
    $usermail = $_REQUEST["usermail"];
    $password = $_REQUEST["userpassword"];
    $citizenship=$_REQUEST["nationality"];
 




    


    // username and user id to be encrypted
    //$username=encrypt($username);
    $usermail=encrypt($usermail);
    $password=encrypt($password);

   // $username=encrypt($username);
    $usermail=encrypt($usermail);
    $password=encrypt($password);

    session_start();
    $_SESSION['username']=$username;

    //SQL Queries to insert data

    $sql = "INSERT INTO Users (user_id, email, password) VALUES (NULL, '$usermail', '$password');";
    if(mysqli_multi_query($link, $sql)){
        header("Location: ./index.php");
    }   
    else{
    header("Location: ./user_reg.php");
    }

    //SQL Queries to insert data
    mysqli_query($link,"INSERT INTO users (username, email, password, citizenship) VALUES ('$username', '$usermail', '$password','$citizenship')");
   // mysqli_query($link,"INSERT INTO Vaccination_Info (user_id,vaccination_name,vaccination_dose ) VALUES ('$username', '$vaccinetype', '$vaccinedoses')");
    //if(mysqli_multi_query($link, $sql))
    //{
    //echo "Records inserted successfully.";
    //}   
    

    //Commit Transactionn
    if (!mysqli_commit($link)) {
    echo "Commit transaction failed";
    mysqli_rollback($con);
    exit();
}
    header("location: user_frontpage.php");
    // Close connection

    include 'close.php';

?>

</center>
</body>
  
</html>
//
