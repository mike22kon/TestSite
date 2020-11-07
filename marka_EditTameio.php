<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style_lib.css">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="refresh" content="60">
<?php require "connection.php"; session_start(); $id_s = $_SESSION['user_id'];?>

<title>marka/ShowTameio</title>
</head>
<body>

  <ul class="sidenav">
    <li><a href="index_marka.php">Αρχική</a></li>
    <li><a href="marka_ShowOrders.php">Παραγγελίες</a></li>
    <li><a href="marka_ShowTameio.php">Επισκόπηση Ταμείου</a></li>
    <li><a href="marka_EditTameio.php" class="active">Επεξεργασία Ταμείου</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>


<div class="content">


    <form id="contact" action="" method="post" style="background-color:#7a7a7a;">
      <h2 style="color:#89c5c2;" >Αρχικοποίηση Ταμείου Επιχείρησης</h2>

      <fieldset>
        <input name="arx_tameiou" placeholder="Αρχικοποίηση ταμείου" type="number" tabindex="1" required autofocus>
      </fieldset>
      <fieldset>
				<button name="arxTameiou_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Ολοκληρώθηκε η αλλαγή.. ')" >Submit</button>
			</fieldset>
    </form>


    </br>
    <form id="contact" action="" method="post" >
      <h2>Αρχικοποίηση Ταμείου Σερβιτόρου</h2>

      <fieldset>
                            <?php
                              $sql = "SELECT *
                                      FROM users
                                      WHERE id_role=2";
                              $stmt = $conn->query($sql);

                              echo '<select name="id_serv">';
                              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value=" ' . $row['id_user'] .'">' . $row['id_user'] ." - ". $row['name'] ." ". $row['lastname'] .'</option>';
                              }
                              echo '</select>';
                            ?>
		  </fieldset>

      <fieldset>
        <input name="arx_tameiou2" placeholder="Αρχικοποίηση ταμείου" type="number" tabindex="1" required autofocus>
      </fieldset>

      <fieldset>
				<button name="arxTameiou2_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Ολοκληρώθηκε η αλλαγή.. ')" >Submit</button>
			</fieldset>

    </form>


    </br>
    <form id="contact" action="" method="post">
      <h2>Επιστροφή Ταμείου Σερβιτόρου</h2>

      <fieldset>
                            <?php
                              $sql = "SELECT *
                                      FROM users
                                      WHERE id_role=2";
                              $stmt = $conn->query($sql);

                              echo '<select name="id_serv">';
                              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value=" ' . $row['id_user'] .'">' . $row['id_user'] ." - ". $row['name'] ." ". $row['lastname'] .'</option>';
                              }
                              echo '</select>';
                            ?>
		  </fieldset>

      <fieldset>
				<button name="arxTameiou3_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Ολοκληρώθηκε η αλλαγή.. ')" >Submit</button>
			</fieldset>

    </form>











</div>

</body>

<?php

  if(isset($_POST['arxTameiou_btn'])){
    //$id_s gnwsto
    $new_timh=!empty($_POST['arx_tameiou'])?trim($_POST['arx_tameiou']):null;

    $sql = "UPDATE marka SET cash_sum='$new_timh' WHERE id='$id_s' ";
    $stmt = $conn->query($sql);
  }



  if(isset($_POST['arxTameiou2_btn'])){
    $new_timh=!empty($_POST['arx_tameiou2'])?trim($_POST['arx_tameiou2']):null;
    $selected_id=!empty($_POST['id_serv'])?trim($_POST['id_serv']):null;

    $sql = "UPDATE marka SET cash_sum = cash_sum - '$new_timh' WHERE id='$id_s' ";
    $stmt = $conn->query($sql);
    //periptvsh arnitikou RIP

    $sql = "UPDATE servs SET cash='$new_timh' WHERE id_serv='$selected_id' ";
    $stmt = $conn->query($sql);

  }



  if(isset($_POST['arxTameiou3_btn'])){
    $selected_id=!empty($_POST['id_serv'])?trim($_POST['id_serv']):null;

    $sql = "SELECT *
            FROM servs
            WHERE id_serv='$selected_id'";
    $stmt = $conn->query($sql);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $money=$row['cash'];




    $sql = "UPDATE servs SET cash=0 WHERE id_serv='$selected_id' ";
    $stmt = $conn->query($sql);

    $sql = "UPDATE marka SET cash_sum = cash_sum + '$money' WHERE id='$id_s' ";
    $stmt = $conn->query($sql);

  }




?>


















</html>
<style>
h2{
  text-align: center;
  margin-left: 15px;
  margin-top: 0px;
  color:#0a4643;
}
* {
  -webkit-box-sizing: border-box;
}
</style>
