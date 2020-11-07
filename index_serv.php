<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php session_start(); require "connection.php";?>
<link rel="stylesheet" href="style_lib.css">
<title>Index_Serv</title>



</head>
<ul class="sidenav">
  <li><a class="active" href="index_Serv.php">Αρχική</a></li>
  <li><a href="serv_newOrder.html">Νέα Παραγγελία</a></li>
  <li><a href="serv_openOrders.php">Ανοιχτές Παραγγελίες</a></li>
  <li><a href="serv_closedOrders.php">Κλειστές Παραγγελίες</a></li>
  <li><a href="serv_money.php">Ταμείο</a></li>
  <li><a href="logout.php">Αποσύνδεση</a></li>
</ul>



<body>
  <div class="content">
  </br>
  <div style="margin-left:15px;">
    <h2 >Καλως Όρισες..</h2>
    </br>
    <?php
        $id_s = $_SESSION['user_id'];
        $sql = "SELECT *
                FROM users
                WHERE id_user='$id_s'";
        $stmt = $conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo"<p style='margin-bottom:7px;'>Επιτυχημένη συνδεση</p>";
        echo"Για τον χρήστη:   (" .$row['id_user']. ") " .$row['name']. " " .$row['lastname']."";

    ?>


  </div>
  </div>





</body>


</html>
