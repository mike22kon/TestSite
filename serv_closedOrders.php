<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style_lib.css">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php session_start(); ?>
<title>Serv/ClosedOrders</title>
</head>


<body>


  <ul class="sidenav">
    <li><a href="index_Serv.php">Αρχική</a></li>
    <li><a href="serv_newOrder.html">Νέα Παραγγελία</a></li>
    <li><a href="serv_openOrders.php">Ανοιχτές Παραγγελίες</a></li>
    <li><a href="serv_closedOrders.php" class="active">Κλειστές Παραγγελίες</a></li>
    <li><a href="serv_money.php">Ταμείο</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>





  <div class="content">
    <h2 style="margin-top: 0px; margin-left: 10px;">Closed Orders</h2>

  <?php
      require "connection.php";
      $id_s = $_SESSION['user_id'];

      $sql = "SELECT id_para, id_table, cost, state
              FROM orders
              WHERE id_serv='$id_s' AND state='DELIVERED'";

      $stmt = $conn->query($sql);

    echo"
    <table >
      <tr>
        <th>Id</th>
        <th>Table</th>
        <th>State</th>
        <th>Cost</th>
      </tr>
    ";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo"<tr><td>" .$row['id_para']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td><td>" .$row['cost']. "</td></tr>";
    }

    echo "</table>";
  ?>

</div>

</body>
</html>
