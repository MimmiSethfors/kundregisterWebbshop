<?php
 require_once '../second_header_extern.php';
 $error = "";
 
 require_once "../config/db.php";

 if ($_SERVER['REQUEST_METHOD'] === 'POST') :
  //print_r($_POST);

  if (empty($_POST['name'])) {
    $error[] =  "Du måste ange namn";
  } else if (isset($_POST['name'])) {
    $name = htmlspecialchars( $_POST['name']);

    if (preg_match("/^[a-öA-Ö\s]*$/", $name)) {
      $name = htmlspecialchars($_POST['name']);
    } else {
      $error[] = "Namnet får endast innehålla bokstäver och mellanslag";
    }
  }
  if (empty($_POST['email'])) {
    $error[] = "Obs! Du måste ange namn";
  } else if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
  }
  

 $sql = "SELECT * FROM `webshop_user` WHERE email = '$email' AND name = '$name'";
 $stmt = $db->prepare($sql);
 $stmt-> execute();

 if($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  //print_r($row);
  if(isset($_POST['controllQuestion'])) {

    $controllQuestion = $row['controllQuestion'];
    echo $controllQuestion;
  };
 }


 endif;

 ?>
</header>
<main>

<h1>Återställ lösenord</h1>
<span class="errors"><?php echo $error ?></span>
<p>Skriv in din epost samt ditt förnamn och efternamn för att få din kontrollfråga</p>
<form action="reset.php" method="POST">
<label for="email">Epost:</label>
<input type="text" name="email" placeholder="Din epost här" >
<br>
<label for="name">För- och efternamn:</label>
<input type="text" name="name" placeholder="Ditt för- och efternamn här">
<br>
<br>
<button type="submit">Visa kontrollfråga</button>
</form>

</main>

<?php

require_once "../footer.php"

?>
