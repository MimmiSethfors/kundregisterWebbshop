<?php
 require_once '../second_header_extern.php';
 require_once '../config/db.php';
 $error = "";
 ?>
</header>
<main>


<h1>Byt lösenord<h1>
<form action='#' method='POST'>
<label for='email'>E-postadress</label>
<input type='text' name='email' required> <br>
<label for='oldPassword'>Gammalt lösenord</label>
<input type='text' name='oldPassword' required> <br>
<label for='newPassword'>Nytt lösenord</label>
<input type='text' name='newPassword' id="password" onblur="validatePasswordChange()" required> <br>
<div class="passwordValidationText"></div>

<button type='submit' class="form-container__submit-button">Byt lösenord</button>
<div> <?php echo $error ?></div>
</form>

<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = htmlspecialchars($_POST['email']);
$oldPassword = htmlspecialchars($_POST['oldPassword']);
$newPassword = htmlspecialchars($_POST['newPassword']);



$sql = "SELECT * FROM webshop_user WHERE email = '$email' AND password = '$oldPassword'";
  $stmt = $db->prepare($sql);
  $stmt-> execute();

  if($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    
    $updateSql = "UPDATE webshop_user 
            SET password = :password
            WHERE email = '$email' AND password = '$oldPassword'";

            $stmt = $db->prepare($updateSql);
            $stmt->bindParam(':password', $newPassword);
          
            $stmt->execute();
    
  }else {
    $error = "Fel användarnamn eller lösenord, försök igen";
  }

}
?>



 
</main>

<?php

require_once "../footer.php"

?>
