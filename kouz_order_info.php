<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="style_lib.css">


<title>kouz/InfoOrders</title>
</head>


<body>


  <ul class="sidenav">
    <li><a href="index_kouzina.php">Αρχική</a></li>
    <li><a href="kouz_newOrders.php" >Νέες Παραγγελίες</a></li>
    <li><a class="active" href="kouz_order_info.php" >Λεπτομέρειες Παραγγελίας</a></li>
    <li><a href="kouz_closedOrders.php">Ολοκληρωμένες Παραγγελίες</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>



<div class="content">
<div class="container2">

  <form id="contact" action="" method="POST">
    <fieldset>
  <input type="text" placeholder="id παραγγελίας" name="testt" id="kappas" />
  </fieldset>
  <fieldset>
  <button name="submit_btn" type="submit" id="contact-submit" data-submit="...Sending">Show</button>
  </fieldset>
  </form>
  </br>
  </div>

  <?php
  require "connection.php";
  session_start();



  $sql = "SELECT *
          FROM orders
          WHERE NOT state='DELIVERED'";

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




<br></br>

<?php
if (isset($_POST['submit_btn'])){
  $orderID=!empty($_POST['testt']) ? trim($_POST['testt']):null;

  $sql = "SELECT *
          FROM orders
          WHERE id_para ='$orderID'";
  $stmt = $conn->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);


  echo"
  <table id='newTable' border='1' style='text-align:center; width:30%'>
    <tr>
      <th>Id: ".$row['id_para']."</th>
      <td>time: " .$row['date']. "</td>
    </tr>";

  echo"<tr>
          <td>state: " .$row['state']. "</td>
          <td>Τραπέζι: " .$row['id_table']. "</td>

      </tr>
  ";

  $sql = "SELECT *
          FROM order_details
          WHERE id_para ='$orderID'";
  $stmt = $conn->query($sql);

  echo"<tr>
          <td>Proion\t\Posothta</td>
          <td>timh</td>
        </tr>";
  while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo"
            <td>id. " .$row2['id_proion']. "x".$row2['quantity']. "</td>

            <td>" .$row2['cost']. "</td>
        </tr>
    ";
  }






  echo "</table>";



}
?>
</div>


</body>
</html>
<style>
#newTable table{

}
#newTable th{
  padding-left: 5px;
  padding-right: 0px;
  padding-top: 6px;
  padding-bottom: 6px;
  margin: 0px;
}
#newTable td{

    vertical-align: bottom;
    text-align: left;

    margin: 0px;
    padding-left: 5px;
    padding-right: 0px;
    padding-top: 3px;
    padding-bottom: 3px;

}
* {
  -webkit-box-sizing: border-box;
}
</style>

<script>
    var table = document.getElementById('myTable'), rIndex;

    for(var i=0; i<table.rows.length; i++){
        table.rows[i].onclick = function(){
            rIndex= this.rowIndex;
            document.getElementById("kappas").value = this.cells[0].innerHTML;

        };
    }
</script>
