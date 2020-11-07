<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style_lib.css">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php require "connection.php"; session_start(); $id_s = $_SESSION['user_id']; ?>
<style>

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding-bottom: 20px;
  padding-top:  20px;
  padding-left: 10px;
  text-align: left;
  border-bottom: 1px solid #00897b;
}
th {
  background-color: #00564d;
  color: white;
}

tr:hover {background-color:#969696;}


/*============== gia dropdown list =================*/
.dropbtn {
  background-color: #00897b;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}
.dropdown:hover .dropbtn {
  background-color: #006d62;
}
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

* {
  -webkit-box-sizing: border-box;
}

</style>

<title>Serv/openOrders</title>
</head>


<body>


  <ul class="sidenav">
    <li><a href="index_Serv.php">Αρχική</a></li>
    <li><a href="serv_newOrder.html" >Νέα Παραγγελία</a></li>
    <li><a href="serv_openOrders.php" class="active" >Ανοιχτές Παραγγελίες</a></li>
    <li><a href="serv_closedOrders.php">Κλειστές Παραγγελίες</a></li>
    <li><a href="serv_money.php">Ταμείο</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>




<div class="content">


  <div class="container2" >

    <form id="contact" action="" method="post" >

  		<fieldset>
        <?php //require "connection.php";
          $sql = "SELECT id_para, id_serv, state
                  FROM orders
                  WHERE id_serv='$id_s' AND NOT state='DELIVERED'";

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
          <option value="PREPATATION">PREPATATION</option>
          <option value="SERVING">SERVING</option>
          <option value="DELIVERED">DELIVERED</option>
        </select>
      </fieldset>

      <fieldset>
        <button name="Modify_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Εγινε αλλαγη..'); ">Change</button>
      </fieldset>

    </form>


  </div>


  <?php

  if(isset($_POST['Modify_btn'])){
      $id_para=!empty($_POST['id_par']) ? trim($_POST['id_par']):null;
      $selected_state=!empty($_POST['katastash']) ? trim($_POST['katastash']):null; //PREPATATION, SERVING, DELIVERED

      $sql = "UPDATE orders SET state=? WHERE id_para=? ";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$selected_state, $id_para]);
      header("Refresh:0");
  }



//emfanizei ton pinaka apo edv kai katw
      $sql = "SELECT id_para, id_table, cost, state
              FROM orders
              WHERE id_serv='$id_s' AND NOT state='DELIVERED'";

      $stmt = $conn->query($sql);


        echo"
        <table id='example'>
          <tr>
            <th>Id</th>
            <th>Table</th>
            <th>State</th>
          </tr>";

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              echo "<tr><td>" .$row['id_para']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td></tr>";
          }
          echo "</table>";
  ?>





</div>

</body>
</html>
