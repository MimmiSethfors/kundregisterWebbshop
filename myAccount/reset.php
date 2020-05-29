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

 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  //print_r($row);
  $email = htmlspecialchars($row['email']);
  $controllQuestion = htmlspecialchars($row['controllQuestion']);
  $controllAnswer = htmlspecialchars($row['controllAnswer']);

 };


 endif;

 ?>

</header>
<main>
  <h1>Din kontrollfråga är:</h1>
 <p><?php echo $controllQuestion ?> </p>
 <form action="checkAnswer.php" method="POST">
<label for="answer">Svar</label>
<input type="text" name="answer" placeholder="Ditt svar här">
<input type="hidden" id="email" name="email" value="<?php echo $email?>">
<input type="hidden" id="controllQuestion" name="controllQuestion" value="<?php echo $controllQuestion?>">
<br>
<button type="submit">Svara</button>
</form>
</main>
<?php





require_once "../footer.php"

?>