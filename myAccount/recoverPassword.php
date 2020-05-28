<?php
 require_once '../second_header_extern.php';
 ?>
</header>
<main>

<h1>Återställ lösenord</h1>
<p>Skriv in din epost för att få ett mail med instruktioner för hur du återställer ditt lösenord</p>
<form action="reset.php" method="POST">
<input type="text" name="email" placeholder="Din epost här">
<button type="submit" name="reset-submit">Återställ lösenord</button>
</form>

<?php
  if(isset($_GET['reset']) == "success") {
    echo '<p>Kolla din mail för återställnings instruktioner</p>';
  }

?>

 
</main>

<?php

require_once "../footer.php"

?>
