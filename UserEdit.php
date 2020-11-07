<html>
<head><title>UserEdit</title>
</head>



<?php
require "connection.php";
header('Content-Type: text/html; charset=utf-8');
session_start();


////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['add_btn'])){         //KANEI ADD USERS

  $username=!empty($_POST['uname']) ? trim($_POST['uname']):null;
  $pass=!empty($_POST['pass']) ? trim($_POST['pass']):null;
  $fname=!empty($_POST['fname']) ? trim($_POST['fname']):null;
  $lname=!empty($_POST['lname']) ? trim($_POST['lname']):null;
  $selected_role = !empty($_POST['rolos']) ? trim($_POST['rolos']):null;  // 1,2,3,4



  $hashpass = password_hash($pass, PASSWORD_BCRYPT);





  $sql = "INSERT INTO users ( name, lastname, username, password, id_role) VALUES (?,?,?,?,?)";
  $stmt= $conn->prepare($sql);
  $stmt->execute([$fname, $lname, $username, $hashpass, $selected_role]);



  //auto gia ton servitoro kai thn marka
  $sql = "SELECT id_user
          FROM users
          WHERE username='$username'";
  $stmt = $conn->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $used_id=$row['id_user'];


  if ($selected_role=="3"){
    $sql="INSERT INTO marka (id, cash_sum) VALUES (?,?) ";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$used_id, "0"]);
  }
  if ($selected_role=="2"){
    $sql="INSERT INTO servs (id_serv, cash) VALUES (?,?) ";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$used_id, "0"]);
  }


  header("location:javascript://history.go(-1)");
}
////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['delete_btn'])){         //KANEI DELETE USERS
    $selected_id=!empty($_POST['onomata']) ? trim($_POST['onomata']):null; //to allaksa se id


    //auto gia ton servitoro kai thn marka
    $sql = "SELECT id_role
            FROM users
            WHERE id_user='$selected_id'";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $role_id=$row['id_role'];



    if($role_id=="2"){
      $sql = "DELETE FROM servs WHERE id_serv='$selected_id' ";
      $stmt = $conn->query($sql);

    }
    if($role_id=="3"){
      $sql = "DELETE FROM marka WHERE id='$selected_id' ";
      $stmt = $conn->query($sql);
    }



    $sql = "DELETE FROM users WHERE id_user='$selected_id' ";
    $stmt = $conn->query($sql);





    header("location:javascript://history.go(-1)");
}
////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['modify_btn'])){

    $selected_user=!empty($_POST['users']) ? trim($_POST['users']):null;
    $selected_role=!empty($_POST['rolos2']) ? trim($_POST['rolos2']):null;

    $sql = "UPDATE users SET id_role=? WHERE username=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$selected_role, $selected_user]);



    header("location:javascript://history.go(-1)");

}
////////////////////////////////////////////////////////////////////////////////



$conn=null;
?>
</html>
