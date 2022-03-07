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
    define("key", "batgirl_to_the_rescue");
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
    $username = $_REQUEST["username"]; 
    $useremail = $_REQUEST["useremail"];
    $password = $_REQUEST["userpassword"];
    $citizenship=$_REQUEST["nationality"];
 
    $error_string = "";
    #Check if username already occupied
    $sql1="SELECT * FROM users WHERE users.username='$username'";
    $sql2="SELECT * FROM admin WHERE admin.adminname='$username'";
    if (mysqli_num_rows(mysqli_query($link, $sql1))>0 || mysqli_num_rows(mysqli_query($link, $sql2))>0) {
        $error_string='Username already taken. Try another username!';
    }

    #Error message if username already used
    if ($error_string) {
    echo "<script type='text/javascript'>alert('$error_string');
    window.location='user_reg.php';
    </script>";

    } else {

    // username and user id to be encrypted
    //$username=encrypt($username);
    $useremail=encrypt($useremail);
    $password=encrypt($password);

    session_start();
    $_SESSION['username']=$username;

    //SQL Queries to insert data

    //$sql = "INSERT INTO Users (user_id, email, password) VALUES (NULL, '$usermail', '$password');";
    //if(mysqli_multi_query($link, $sql)){
    //    header("Location: ./index.php");
    //}   
    //else{
    //header("Location: ./user_reg.php");
    //}

    mysqli_autocommit($link,TRUE);

    //SQL Queries to insert data
    mysqli_query($link,"INSERT INTO users (username, email, password, citizenship) VALUES ('$username', '$useremail', '$password','$citizenship')");
   // mysqli_query($link,"INSERT INTO Vaccination_Info (user_id,vaccination_name,vaccination_dose ) VALUES ('$username', '$vaccinetype', '$vaccinedoses')");
    //if(mysqli_multi_query($link, $sql))
    //{
    //echo "Records inserted successfully.";
    //}   
    

    //Commit Transactionn
    if (!mysqli_commit($link)) {
    echo "Commit transaction failed";
    mysqli_rollback($link);
    exit();
}
    header("location: user_frontpage.php");
    // Close connection
    }
    include 'close.php';

?>

</center>
</body>
  
</html>
//
