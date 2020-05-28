<?php
 require_once '../second_header_extern.php';
 ?>
</header>
<main>

<?php
  
  $selector = $_GET["selector"];
  //token som kollar att användaren är rätt
  $validator = $_GET["validator"];

  if(empty($selector) || empty($validator)){
    echo "Oj, något blev fel";

  }else {
    if(ctype_xdigit($selector)!== false && ctype_xdigit($validator)!== false){
      ?>
      <form action="resetPassword.php" method="POST">
        <input type="hidden" name="selector" value="<?php echo $selector?>">
        <input type="hidden" name="validator" value="<?php echo $validator?>">
        <input type="text" name="password" placeholder="Skriv ditt nya lösenord...">
        <input type="text" name="passwordRepeat" placeholder="Upprepa ditt nya lösenord...">
        <button type="submit" name="resetButton">Återställ lösenord</button>
      </form>

      <?php

    }
  }

?>

<form action=""></form>

 
</main>

<?php

require_once "../footer.php"

?>
