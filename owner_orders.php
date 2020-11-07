<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="style_lib.css">

<style>
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 20px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #ccc;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #eee;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #00564d;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>


<title>owner/orders</title>
</head>


<body>


  <ul class="sidenav" >
    <li><a href="index_owner.php">Αρχική</a></li>
    <li><a href="owner_users.php" >Διαμόρφωση Χρηστών</a></li>
    <li><a href="owner_menu.php">Διαμόρφωση Μενού</a></li>
    <li><a class="active" href="owner_orders.php">Διαχείρηση Παραγγελιών</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>





	<div class="content">
	<div class="container2" >


    <form id="contact" action="" method="post" >

  		<fieldset>
  			<input name="selected_d" type="date" value="<?php echo date('Y-m-d'); ?>" />

  		</fieldset>

<fieldset>
      <label class="container">Και τις προηγούμενες
        <input type="checkbox" name="flag" value="true">
        <span class="checkmark"></span>

      </label>
</fieldset>



</br>


  		<fieldset>
        <?php require "connection.php";
          $sql = "SELECT name, lastname, id_user
                  FROM users
                  WHERE id_role=2";
          $stmt = $conn->query($sql);
          echo "<select name='id_serv'>";
          echo '<option value="420" > Ολοι </option>';
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value=" ' . $row['id_user'] .'">' . $row['id_user'] ." - ". $row['name'] ."  ". $row['lastname'] .'</option>';

          }
          echo "</select>";
        ?>
  		</fieldset>

      <fieldset>
        <button name="show_btn" type="submit" id="contact-submit" data-submit="...Sending">Show</button>
      </fieldset>
    </form>


  </div>



  <?php
    require "connection.php";
    if(isset($_POST['show_btn'])){

      //$checkB
      $id_s=!empty($_POST['id_serv']) ? trim($_POST['id_serv']):null;
      $new_date = date('Y-m-d', strtotime($_POST['selected_d']));
      $new_date=!empty($new_date)?trim($new_date):null;



      if (isset($_POST['flag'])){

        if($id_s=="420"){
            $sql = "SELECT id_para, id_serv, id_table, date, cost, state
                    FROM orders
                    WHERE date<='$new_date'";
        }else{
            $sql = "SELECT id_para, id_serv, id_table, date, cost, state
                    FROM orders
                    WHERE date<='$new_date'AND id_serv='$id_s'";
        }
      }else{

        if($id_s=="420"){
            $sql = "SELECT id_para, id_serv, id_table, date, cost, state
                    FROM orders
                    WHERE date='$new_date'";
        }else{
            $sql = "SELECT id_para, id_serv, id_table, date, cost, state
                    FROM orders
                    WHERE date='$new_date'AND id_serv='$id_s'";
        }
      }

      $stmt = $conn->query($sql);

      echo"
      <table id='myTable' border='1' style='text-align:center;'>
        <tr>
          <th>Id_order</th>
          <th>time</th>
          <th>id_servitorou</th>
          <th>Table</th>
          <th>State</th>
          <th>AMOUNT</th>
        </tr>
        ";


          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo"<tr><td>" .$row['id_para']. "</td><td>" .$row['date']. "</td><td>" .$row['id_serv']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td><td>" .$row['cost']. "</td></tr>";
          }

      echo "</table>";




    }
    $conn=null;

  ?>




</div>

</body>
</html>




<style>
* {
  -webkit-box-sizing: border-box;
}

</style>
