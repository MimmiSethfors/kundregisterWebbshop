<?php
 require_once '../second_header_extern.php';
 $error ="";
 $loggedIn = false;

?>
</header>
<main>

<?php
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //print_r($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM webshop_user WHERE email = '$email' AND password = '$password'";
    $stmt = $db->prepare($sql);
    $stmt-> execute();
    
    
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      //print_r ($row);
      $name = ($row["name"]);
      $email = ($row["email"]);
      $phone = ($row["phone"]);
      $street = ($row["street"]);
      $zip = ($row["zip"]);
      $city = ($row["city"]);

      echo "<h1>Välkommen</h1>" ;
      echo "<h2 class='myName'> $name </h2>";
      echo "<h3> Dina uppgifter:<h3> 
                <ul>
                  <li class='myEmail'>$email </li>
                  <li class='myPhone'> $phone</li>
                  <li class='myStreet'>$street</li>
                  <li class='myZip'>$zip</li>
                  <li class='myCity'> $city</li>
                </ul>";
      $loggedIn = true;
      
    
    } else {
      $error = "Fel användarnamn eller lösenord";
      echo " <h1>Logga in</h1>
          <form action='#' method='POST'>
            <label for='email'></label>
            <input type='text' placeholder='Email' name='email' required>
            <label for='password'></label>
            <input type='password' placeholder='Lösenord' name='password' required>
            <button id='logIn'type='submit'>Logga in</button>
            <div> $error </div>
          </form>
          
          <h2>Saknar du konto?</h2>
          <a href='./new-account.php'>
          <button id='registerNew'>Registrera nytt konto</button>
          </a>
          <br>
          <a href='../index.php'>
            <button class='btn-back'>Tillbaka till startsidan</button>
          </a>";
          $loggedIn = false;
    }

} else {
  echo " <h1>Logga in</h1>
        <form action='#' method='POST'>
          <label for='email'></label>
          <input type='text' placeholder='Email' name='email' required>
          <label for='password'></label>
          <input type='password' placeholder='Lösenord' name='password' required>
          <button id='logIn'type='submit'>Logga in</button>
        </form>
        
        <h2>Saknar du konto?</h2>
        <a href='./new-account.php'>
        <button id='registerNew'>Registrera nytt konto</button>
        </a>
      <br>
        <a href='../index.php'>
          <button class='btn-back'>Tillbaka till startsidan</button>
        </a>";
        $loggedIn = false;
};

if($loggedIn){
//spara all persondata i localstorage
//visa inte logga in vid klick på "min sida"

}
 
?>


 
</main>

<?php

require_once "../footer.php"

?>


