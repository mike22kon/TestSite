<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="style_lib.css">



<title>kouz/closedOrders</title>
</head>


<body>


  <ul class="sidenav">
    <li><a href="index_kouzina.php">Αρχική</a></li>
    <li><a href="kouz_newOrders.php">Νέες Παραγγελίες</a></li>
    <li><a href="kouz_order_info.php" >Λεπτομέρειες Παραγγελίας</a></li>
    <li><a class="active" href="kouz_closedOrders.php">Ολοκληρωμένες Παραγγελίες</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>




  <div class="content">
    <div class="container3">


      <?php
      require "connection.php";



      $sql = "SELECT *
              FROM orders
              WHERE state='DELIVERED'";

      $stmt = $conn->query($sql);

      echo"
      <table id='myTable' border='1' style='text-align:center;'>
        <tr>
          <th>Id</th>
          <th>Date</th>
          <th>Table</th>
          <th>State</th>
          <th>AMOUNT</th>
        </tr>";


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo"<tr><td>" .$row['id_para']. "</td><td>" .$row['date']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td><td>" .$row['cost']."  € ". "</td></tr>";}
        echo "</table>";
      ?>




    </div>
  </div>

</body>


</html>
