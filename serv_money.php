<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style_lib.css">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php require "connection.php"; session_start(); $id_s = $_SESSION['user_id'];?>


<title>Serv/ClosedOrders</title>
</head>


<body>


  <ul class="sidenav">
    <li><a href="index_Serv.php">Αρχική</a></li>
    <li><a href="serv_newOrder.html">Νέα Παραγγελία</a></li>
    <li><a href="serv_openOrders.php">Ανοιχτές Παραγγελίες</a></li>
    <li><a href="serv_closedOrders.php">Κλειστές Παραγγελίες</a></li>
    <li><a href="serv_money.php" class="active">Ταμείο</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>


  <div class="content">

    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openTab(event, 't_sum')" id="defaultOpen">All</button>
      <button class="tablinks" onclick="openTab(event, 't_serving')">Serving</button>
      <button class="tablinks" onclick="openTab(event, 't_pre_ready')">Pre/Ready</button>
      <button class="tablinks" onclick="openTab(event, 't_delivered')">Delivered</button>
    </div>


    <!-- Tab content -->
    <!--1o-->
    <div id="t_sum" class="tabcontent">
      <h3>All money</h3>






    </div>

<!--2o-->
    <div id="t_serving" class="tabcontent">
      <h3>Serving</h3>

      <?php
      $sql = "SELECT *
              FROM orders
              WHERE id_serv='$id_s' AND state='SERVING'";

      $stmt = $conn->query($sql);

      echo"
      <table>
        <tr>
          <th>Id</th>
          <th>Date</th>
          <th>Table</th>
          <th>State</th>
          <th>AMOUNT</th>
        </tr>";

        $sum_cost=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo"<tr><td>" .$row['id_para']. "</td><td>" .$row['date']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td><td>" .$row['cost']. "</td></tr>";
          $sum_cost=$sum_cost+$row['cost'];
        }

        echo"<tr>
              <td>Total</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td> $sum_cost </td>
            </tr>";

        echo "</table>";
        ?>

    </div>

<!--3o-->
    <div id="t_pre_ready" class="tabcontent">
      <h3>Preparation/Ready</h3>

      <?php
      $sql = "SELECT *
              FROM orders
              WHERE id_serv='$id_s' AND state='PREPARATION' OR state='READY'";

      $stmt = $conn->query($sql);

      echo"
      <table>
        <tr>
          <th>Id</th>
          <th>Date</th>
          <th>Table</th>
          <th>State</th>
          <th>AMOUNT</th>
        </tr>";

        $sum_cost=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo"<tr><td>" .$row['id_para']. "</td><td>" .$row['date']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td><td>" .$row['cost']. "</td></tr>";
          $sum_cost=$sum_cost+$row['cost'];
        }

        echo"<tr>
              <td>Total</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td> $sum_cost </td>
            </tr>";

        echo "</table>";
        ?>

    </div>

<!--4o-->
    <div id="t_delivered" class="tabcontent">
      <h3>Delivered</h3>

      <?php
      $sql = "SELECT *
              FROM orders
              WHERE id_serv='$id_s' AND state='DELIVERED'";

      $stmt = $conn->query($sql);

      echo"
      <table>
        <tr>
          <th>Id</th>
          <th>Date</th>
          <th>Table</th>
          <th>State</th>
          <th>AMOUNT</th>
        </tr>";

        $sum_cost=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo"<tr><td>" .$row['id_para']. "</td><td>" .$row['date']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td><td>" .$row['cost']. "</td></tr>";
          $sum_cost=$sum_cost+$row['cost'];
        }

        echo"<tr>
              <td>Total</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td> $sum_cost </td>
            </tr>";

        echo "</table>";
        ?>

    </div>



    <script>
    function openTab(evt, name) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");

      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      document.getElementById(name).style.display = "block";
      evt.currentTarget.className += " active";
    }
    // Open default
    document.getElementById("defaultOpen").click();
    </script>



</div>


</body>
</html>
