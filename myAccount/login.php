<?php
 require_once '../second_header_extern.php';
 $error = "";
 $loggedIn = false; 
 $myOrders = ""
 
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

  $myOrders .= "<section class='table_container'>
  <table class='table_orders_admin' id='table-orders'>
      <tbody>
          <tr class='table_orders_admin-row'>
              <th class='table_orders_admin-head'>Orderid</th>
              <th class='table_orders_admin-head'>Produkter</th>
              <th class='table_orders_admin-head'>Summa</th>
              <th class='table_orders_admin-head'>Orderdatum</th>
              <th class='table_orders_admin-head'>Orderstatus</th>
              </tr>";
  
  
  if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    //print_r ($row);
    $name = htmlspecialchars($row["name"]);
    $email = htmlspecialchars($row["email"]);
    $phone = htmlspecialchars($row["phone"]);
    $street = htmlspecialchars($row["street"]);
    $zip = htmlspecialchars($row["zip"]);
    $city = htmlspecialchars($row["city"]);


    //Hämta beställningshistorik
    $sqlOrders = "SELECT * FROM webshop_orders 
                  UNION ALL SELECT * FROM webshop_orderscomplete 
                  WHERE email = '$email' 
                  ORDER BY `orderdate` 
                  DESC";
    $stmt = $db->prepare($sqlOrders);
    $stmt-> execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $orderid = htmlspecialchars($row['orderid']);
      $date = htmlspecialchars($row['orderdate']);
      $status = htmlspecialchars($row['status']);
      $products = json_decode($row['products'], true);
      $totalprice = htmlspecialchars($row['totalprice']);
      $freight = htmlspecialchars($row['freight']);

      $productsspec = "";
      foreach ($products as $key => $value) {
          $pOutlet="";
          $pPrice="";
          foreach ($value as $ky => $val) {
            if ($ky == "cartQty") {
              $productsspec .= $val . " st ";
            }
            if ($ky == "title") {
              $productsspec .= $val;
            }
            if ($ky == "outletprice") {
              $pOutlet = $val;
            }
            if ($ky == "price") {
              $pPrice = $val;
              if ($pOutlet != null) {
                  $productsspec .= " pris " . $pOutlet . " kr (ord pris " . $pPrice . " kr)";
              }
              else {
                  $productsspec .= " pris " . $pPrice . " kr";
              }
            }
          }
          $productsspec .= "<br>";
        }


      if ($status == 1) {
        $status = "Ny, väntar på att behandlas";
    } elseif ($status == 2) {
        $status = "Behandlas";
    } elseif ($status == 3) {
        $status = "Skickat";
    };

      $myOrders .= "<tr class='table_orders_admin-row'>
                <td class='table_orders_admin-cell'> $orderid</td>
                <td class='table_orders_admin-cell products' style='width: 20%'> $productsspec <br>
                                                                            Frakt: $freight kr</td>
                <td class='table_orders_admin-cell'> $totalprice </td>
                <td class='table_orders_admin-cell'> $date</td>
                <td class='table_orders_admin-cell'> $status</td></tr> ";
                

    }


    $loggedIn = true;
  }else {
    //echo "tets";
    $error = "Fel användarnamn eller lösenord, försök igen";
    $loggedIn = false;
  }
}

if (!$loggedIn){
    echo " <h1>Logga in</h1>
        <form action='#' method='POST'>
          <label for='email'></label>
          <input type='text' placeholder='Email' name='email' required>
          <label for='password'></label>
          <input type='password' placeholder='Lösenord' name='password' required>
          <button id='logIn'type='submit'>Logga in</button>
          <div class='errors'> $error </div>
          <p><a href='recoverPassword.php'>Har du glömt ditt lösenord?</a></p>

        </form>
        
        <h2>Saknar du konto?</h2>
        <a href='./new-account.php'>
        <button id='registerNew'>Registrera nytt konto</button>
        </a>
      <br>
        <a href='../index.php'>
          <button class='btn-back'>Tillbaka till startsidan</button>
        </a>";

} else  {
  
  echo "<h1>Hej</h1>" ;
  echo "<h2 class='myName'> $name </h2>";
  echo "<h3> Dina beställningar: <h3>
        $myOrders
        </tbody></table>
        <br>";
  echo "<h3> Dina uppgifter:<h3> 
  <section class='table_container'>
  <table class='table_orders_admin' id='table-orders'>
      <tbody>
          <tr class='table_orders_admin-row'>
              <th class='table_orders_admin-head'>Namn</th>
              <th class='table_orders_admin-head'>Epost</th>
              <th class='table_orders_admin-head'>Telefon</th>
              <th class='table_orders_admin-head'>Gatuadress</th>
              <th class='table_orders_admin-head'>Postadress</th>
              <th class='table_orders_admin-head'>Ort</th>
              <th class='table_orders_admin-head'>Ändra lösenord</th>
              </tr>
              
              <tr class='table_orders_admin-row'>
                <td class='table_orders_admin-cell myName'>$name</td>
                <td class='table_orders_admin-cell myEmail'>$email</td>
                <td class='table_orders_admin-cell myPhone'>$phone</td>
                <td class='table_orders_admin-cell myStreet'>$street</td>
                <td class='table_orders_admin-cell myZip'>$zip</td>
                <td class='table_orders_admin-cell myCity'>$city</td>
                <td class='table_orders_admin-cell'><a href='../myAccount/changepassword.php' ><button class='passwordBtn'>Byt lösenord</button></a></td>
             </tr>
        </tbody>
    </table> <br>";

  
  echo "<a href='../myAccount/login.php'><button id='logoutBtn' class='logoutBtn'>Logga ut</button></a>";

 
  $loggedIn = true;

}

?>


 
</main>
<script type="application/javascript" src="../myAccount/logout.js"></script>
<?php

require_once "../footer.php"

?>


