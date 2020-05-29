<?php
 require_once '../second_header_extern.php';
 require_once "../config/db.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') :
  print_r($_POST);
  if (isset($_POST['email'])) {
    $email = htmlspecialchars( $_POST['email']);
  };
  if (isset($_POST['controllQuestion'])) {
    $question = htmlspecialchars( $_POST['controllQuestion']);
  };
  if (isset($_POST['name'])) {
    $answer = htmlspecialchars( $_POST['answer']);
  };

   //else {header reset.php};


  $sql = "SELECT * FROM `webshop_user` WHERE email = '$email'";
  $stmt = $db->prepare($sql);
  $stmt-> execute();
 
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
   //print_r($row);
   $controllQuestion = htmlspecialchars($row['controllQuestion']);
   $controllAnswer = htmlspecialchars($row['controllAnswer']);
   $emailDB = htmlspecialchars($row['email']);
    
  };


  if($email == $emailDB && $question == $controllQuestion && $controllAnswer == $answer) {
    echo("yes!");
  }


endif;

?>

</header>
<main>


</main>
<?php

require_once "../footer.php"

?>