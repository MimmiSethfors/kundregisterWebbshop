<?php
 require_once '../second_header_extern.php';
 require_once "../config/db.php";
 $emailExists = "";
 $success = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') :
  //print_r($_POST);
  $errors = "";
  $error = array();
  $name = $email = $phone = $street = $zip = $city = $password = "";

  
  //php validering av alla fält
  if (empty($_POST['name'])) {
    $error[] =  "Du måste ange namn";
  } else if (isset($_POST['name'])) {
    $name = $_POST['name'];

    if (preg_match("/^[a-öA-Ö\s]*$/", $name)) {
      $name = $_POST['name'];
    } else {
      $error[] = "Namnet får endast innehålla bokstäver och mellanslag";
    }
  }

  if (empty($_POST['email'])) {
    $error[] = "Obs! Du måste ange namn";
  } else if (isset($_POST['email'])) {
    $email = $_POST['email'];
  }

  if (empty($_POST['phone'])) {
    $error[] = "Obs! Du måste ange telefonnummer";
  } else if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
  }

  if (empty($_POST['street'])) {
    $error[] = "Obs! Du måste ange gatuadress";
  } else if (isset($_POST['street'])) {
    $street = $_POST['street'];
  }

  if (empty($_POST['zip'])) {
    $error[] = "Obs! Du måste ange gatuadress";
  } else if (isset($_POST['zip'])) {
    $zip = str_replace(' ', '', $_POST['zip']);
  }

  if (empty($_POST['city'])) {
    $error[] = "Obs! Du måste ange gatuadress";
  } else if (isset($_POST['city'])) {
    $city = $_POST['city'];
  }

  if(empty($_POST['passwordInput'])){
    $error[] = "Obs! Du måste ange ett lösenord";
  }else if (isset($_POST['passwordInput'])){
    $password = $_POST['passwordInput'];
   
  }

  
  //Utan felmeddelanden
  if (count($error) == 0) {
   
    $checkemailSQL = "SELECT `email` FROM `webshop_user` WHERE `email` = '$email'";
    $stmt = $db->prepare($checkemailSQL);
    $stmt-> execute();

    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      
      $emailExists .= "Det finns redan ett konto med denna epostadress";
      

    }else {

      
      //Skicka ny användare till databasen
      $sql = "INSERT INTO webshop_user (name, email, phone, street, zip, city, password)
            VALUES (:name, :email, :phone, :street, :zip, :city, :password)";


$stmt = $db->prepare($sql);

$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':street', $street);
$stmt->bindParam(':zip', $zip);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':password', $password);

$stmt->execute();
$success = "Du är nu tillaggd! Klicka på Mitt Konto för att logga in";
}

}
//Vid felmeddelanden

if (count($error) > 0) {
    //echo "flera fel";
    foreach ($error as $e) {
      $errors .= "<div class='errors'><p> $e </p></div><br />";
     print_r($error);
    }
  }

endif;
?>
</header>
<main>

<h1>Nytt konto</h1>
<span class="errors"><?php echo $emailExists ?></span>
<span class="success"><?php echo $success ?></span>

<form name="orderForm" action="#" method="POST" id="contact-form" class="form-container" onsubmit="return hiddenProducts()">

<div class="order_field-name form-container__box">
        <label for="name">För- och efternamn:</label><br>
        <input type="text" name="name" id="name" onblur="validateName()" class="form-container__box-input" required>
        <br>
        <span class="nameValidationText"></span>
      </div>

      <div class="order_field-email form-container__box">
        <label for="email">E-post:</label><br>
        <input type="text" name="email" id="email" onblur="validateEmail()" class="form-container__box-input" placeholder="exempel@test.com" required>
        <br>
        
        <span class="emailValidationText"></span>
      </div>

      <div class="order_field-phone form-container__box">
        <label for="phone">Mobilnummer:</label><br>
        <input type="text" name="phone" id="phone" onblur="validatePhone()" class="form-container__box-input" placeholder="(ex. 0701234567)" required>
        <br>
        <span class="phoneValidationText"></span>
      </div>

      <div class="order_field-street form-container__box">
        <label for="street">Gatuadress:</label><br>
        <input type="text" name="street" id="street" onblur="validateStreet() " class="form-container__box-input" required>
        <br>
        <span class="streetValidationText"></span>
      </div>

      <div class="order_field-postalcode form-container__box">
        <label for="zip">Postnr:</label><br>
        <input type="text" name="zip" id="zip" oninput="validateZipcode()" placeholder="(ex. 123 45)" class="form-container__box-input" required>
        <br>
        <span class="zipcodeValidationText"></span>
      </div>

      <div class="order_field-city form-container__box">
        <label for="city">Ort:</label><br>
        <input type="text" name="city" id="city" onblur="validateCity()" class="form-container__box-input" required>
        <br>
        <span class="cityValidationText"></span>
      </div>

      <div class="order_field-password form-container__box">
        <label for="password">Lösenord:</label><br>
        <input type="text" name="passwordInput" id="passwordInput" class="form-container__box-input" required>
        <br>

        <div class="strength-meter" id="strength-meter"></div>

        <div class="passwordValidationText" id="passwordValidationText"></div>
      </div>

      <div class="order_field-submit form-container__submit">
        <input type="submit" value="Registrera" class="form-container__submit-button" id="form-container__submit-button">
      </div>
    </form>
     
  </section>

<br>
  <a href="./my-account.php">
    <button class="btn-back">Tillbaka</button>
  </a>
</main>



<?php
require_once "../footer.php";

?>

