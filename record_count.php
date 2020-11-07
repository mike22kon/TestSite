<html>
<script>
function PlaySound(soundObj) {
  var sound = document.getElementById(soundObj);
  sound.Play();
}
</script>
<style>
  table tr:not(:first-child){
    cursor: poiner; transition: all .25s ease-in-out;
  }
</style>


<body>
<?php
require "connection.php";
session_start();
//$id_s = $_SESSION['user_id'];
 //mono prwth fora thelw 0





$sql = "SELECT *
        FROM orders
        WHERE state='PREPARATION'";

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

  $new=0;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo"<tr><td>" .$row['id_para']. "</td><td>" .$row['date']. "</td><td>" .$row['id_table']. "</td><td>" .$row['state']. "</td><td>" .$row['cost']."  € ". "</td></tr>";
    $new++;//metraei kathe fora ton aithmo tvw paraggeliwn gtxs
  }
  echo "</table>";


  if($new> $_SESSION['oldp']){
    echo "<embed src='beep_sound01.wav' autostart='false' width='0' height='0' id='sound1' enablejavascript='true'>";

    $message = "Νεα Παραγγελια";
    //echo "<script type='text/javascript'>alert('$message');</script>";
    echo"<h2>$message<h2>";
  }

  $_SESSION['oldp']=$new;

?>

</body>
</html>
