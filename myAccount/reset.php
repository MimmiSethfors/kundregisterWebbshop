<?php

  if(isset($_POST['reset-request-submit'])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/myAccount/create-new-password.php?selector=" . $selector . "&validator" . bin2hex($token); 

    //token går ut en timme
    $expires = date("U") + 1800;


    require_once '../config/db.php';

    $userEmail = $_POST['email'];

    //töm token om det finns sen tidigare
    $sql = "DELETE FROM webshop_passwordreset WHERE pwdResetEmail=?";
    $stmt = $db->prepare($sql);
    $stmt-> execute();

    $sql = "INSERT INTO webshop_passwordreset 
            (pwdResetEmail, 
             pwdResetSelector,
             pwdResetToken,
             pwdResetExpires)
            VALUES (:pwdResetEmail, 
                    :pwdResetSelector, 
                    :pwdResetToken, 
                    :pwdResetExpires);";  

     //säkerhets optimera token  
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    $stmt = $db->prepare($sql);
    $stmt-> execute();

    $to = $userEmail;
    $subject = "Återställ ditt lösenord";
    $message =  '<p>Följ länken för att återställa ditt lösenord</p>';
    $message .= '<p>Länk: <br>';
    $message .= '<a href=" ' . $url . '">' . $url . '</a> </p>';
    $headers = "Från Spelshoppen.se";

    mail($to, $subject, $message, $headers);

    header("Location: login.php?reset=success");
   
  
  }else {
    header("Location: recoverPassword.php");
  };



?>