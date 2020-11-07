<html>
<head><title>MenuEdit</title>
</head>

<?php
require "connection.php";
header('Content-Type: text/html; charset=utf-8');
session_start();


////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['add_btn'])){         //KANEI ADD USERS

  $name=!empty($_POST['onoma']) ? trim($_POST['onoma']):null;
  $timh=!empty($_POST['timh']) ? trim($_POST['timh']):null;
  $selected_category=!empty($_POST['category']) ? trim($_POST['category']):null; //1,2,3,4,5,6
  $category_name;



  switch ($selected_category) {
    case "1":
      $category_name="Ορεκτικα";
    break;
    case "2":
      $category_name="Σαλατες";
    break;
    case "3":
      $category_name="Πιτσες";
    break;
    case "4":
      $category_name="Πιατα Ημερας";
    break;
    case "5":
      $category_name="Αλκοολουχα";
    break;
    case "6":
      $category_name="Αναψυκτικα";
    break;
    default:
      $category_name="error";
      echo "ERROR";
  }

  $sql = "INSERT INTO menu (id_category, name_category, name, price, img) VALUES (?,?,?,?,?)";
  $stmt= $conn->prepare($sql);
  $stmt->execute([  $selected_category, $category_name, $name, $timh, $imgContent ]);



  header("Location: owner_menu.php");
}
///////

if(isset($_POST['delete_btn'])){         //KANEI DELETE USERS
    $selected_onoma=!empty($_POST['onomata']) ? trim($_POST['onomata']):null;

    $sql = "DELETE FROM menu WHERE name=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$selected_onoma]);




    header("Location: owner_menu.php");
}


?>





</html>
