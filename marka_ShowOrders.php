<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="style_lib.css">
<meta http-equiv="refresh" content="300">
<?php require "connection.php"; session_start(); $id_s = $_SESSION['user_id'];?>

<style>


#myInput {
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */

  /*padding: 12px 20px 12px 40px; /* Add some padding */
  padding: 12px 0px 12px 3px;

  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
  margin-right: 11px;
}

</style>


<title>marka/ShowOrders</title>
</head>
<body>

  <ul class="sidenav">
    <li><a href="index_marka.php">Αρχική</a></li>
    <li><a href="marka_ShowOrders.php"class="active">Παραγγελίες</a></li>
    <li><a href="marka_ShowTameio.php">Επισκόπηση Ταμείου</a></li>
    <li><a href="marka_EditTameio.php">Επεξεργασία Ταμείου</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>


  <div class="content">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Type state..">



      <?php


      $sql = "SELECT *
              FROM orders";

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

        //$sum_cost=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo"<tr><td>" .$row['id_para']. "</td><td>" .$row['date']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td><td>" .$row['cost']."  € ". "</td></tr>";
          //$sum_cost=$sum_cost+$row['cost'];
        }

        echo "</table>";

        ?>

  <script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");


      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    </script>



  </div>


</body>
</html>
