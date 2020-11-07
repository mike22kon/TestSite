<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<link rel="stylesheet" href="style_lib.css">
<?php session_start(); $_SESSION['oldp']=420; ?>

<script type="text/javascript">
  var auto_refresh = setInterval( function (){ $('#test').load('record_count.php').fadeIn("slow"); }, 5000); // refresh every 10000 milliseconds
</script>


<title>kouz/openOrders</title>
</head>


<body>


  <ul class="sidenav">
    <li><a href="index_kouzina.php">Αρχική</a></li>
    <li><a class="active" href="kouz_newOrders.php" >Νέες Παραγγελίες</a></li>
    <li><a href="kouz_order_info.php" >Λεπτομέρειες Παραγγελίας</a></li>
    <li><a href="kouz_closedOrders.php">Ολοκληρωμένες Παραγγελίες</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>


<div class="content">
  <div class="container2" >

    <form id="contact" action="" method="post" >

      <fieldset>
        <?php require "connection.php";
          $sql = "SELECT id_para, id_serv, state
                  FROM orders
                  WHERE NOT state='DELIVERED'";

          $stmt = $conn->query($sql);
          echo "<select name='id_par'>";
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value=" ' . $row['id_para'] .'">' . $row['id_para'] ."  -  ". $row['state'] .'</option>';
          }
          echo "</select>";
        ?>
      </fieldset>

      <fieldset>
        <select name="katastash">
          <option value="PREPARATION">PREPARATION</option>
          <option value="SERVING">SERVING</option>
          <option value="DELIVERED">DELIVERED</option>
        </select>
      </fieldset>

      <fieldset>
        <button name="Modify_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Εγινε αλλαγη..'); ">Change</button>
      </fieldset>

    </form>


  </div>
</div>
</br>


<div class="content" id="test">





</div>


</body>
<?php

if(isset($_POST['Modify_btn'])){
    $id_para=!empty($_POST['id_par']) ? trim($_POST['id_par']):null;
    $selected_state=!empty($_POST['katastash']) ? trim($_POST['katastash']):null; //PREPATATION, SERVING, DELIVERED

    $sql = "UPDATE orders SET state=? WHERE id_para=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$selected_state, $id_para]);
    header("Refresh:0");
}
?>




</html>
