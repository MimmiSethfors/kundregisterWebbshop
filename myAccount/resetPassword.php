<?php

  if(isset($_POST['resetButton'])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];

    if(empty($password) || empty($passwordRepeat)){
      header("Location: create-new-password.php?newpwd=empty");
      exit();
    }else if($password != $passwordRepeat){
      header("Location: create-new-password.php?newpwd=passwordnotsame");
      exit();
    }
      $currentDate = date("U");

      require_once '../config/db.php';

      $sql = "SELECT * FROM webshop_passwordreset 
              WHERE pwdResetSelector=? 
              AND pwdResetExpires >= ?";

              $stmt = $db->prepare($sql);
              $stmt-> execute();

      $result = $stmt;
      if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
      
        if($tokenCheck === false){
          echo "Oops, det blev något fel, försök igen"
        }elseif ($tokenCheck === true) {
          $tokenEmail = $row['pwdResetEmail'];
          $sql = "SELECT * FROM webshop_user WHERE email=?;";
        
        }

      }

  }else {
    header("Location: login.php")
  }

?>