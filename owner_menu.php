<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />


<link rel="stylesheet" href="style_lib.css">


<title>owner/menu</title>
</head>
<body>


  <ul class="sidenav">
    <li><a href="index_owner.php">Αρχική</a></li>
    <li><a href="owner_users.php">Διαμόρφωση Χρηστών</a></li>
    <li><a class="active" href="owner_menu.php">Διαμόρφωση Μενού</a></li>
    <li><a href="owner_orders.php">Διαχείρηση Παραγγελιών</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>




  <div class="content">

    <div class="tab">
      <button class="tablinks" onclick="openTab(event, 'add')" id="defaultOpen">Add</button>
      <button class="tablinks" onclick="openTab(event, 'remove')">Delete</button>
    </div>



    <div id="add" class="tabcontent"> <!-- gia to tab -->
      <div class="container2">        <!-- gia thn css -->
        <form id="contact" action="MenuEdit.php" method="post">

          <fieldset>
            <input name="onoma" placeholder="Όνομα Προιόντος" type="text" tabindex="1" required autofocus>
          </fieldset>

          <fieldset>
            <select name="category">
              <option value="1">Ορεκτικά</option>
              <option value="2">Σαλάτες</option>
              <option value="3">Πίτσες</option>
              <option value="4">Πιάτα Ημέρας</option>
              <option value="5">Αλκοολούχα</option>
              <option value="6">Αναψυκτικά</option>
            </select>
          </fieldset>

          <fieldset>
            <input  name="timh" placeholder="Τιμή Προιόντος" type="number" tabindex="1" required autofocus>
          </fieldset>



          <fieldset>
            <button name="add_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Προστέθηκε '); openTab(event, 'add');">Add</button>
          </fieldset>

        </form>
      </div>
    </div>


    <div id="remove" class="tabcontent">  <!-- gia to tab -->
      <div class="container2">            <!-- gia thn css -->
        <form id="contact" action="MenuEdit.php" method="post">

          <fieldset>
            <?php require "connection.php";
              $sql = "SELECT name, price, name_category
                      FROM menu";
              $stmt = $conn->query($sql);
              echo "<select name='onomata'>";
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value=" ' . $row['name'] .'">' . $row['name_category'] ." - ". $row['name'] ."   ". $row['price'] ."€".'</option>';

              }
              echo "</select>";
            ?>
          </fieldset>

          <fieldset>
            <button name="delete_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Διαγραφτηκε '); openTab(event, 'remove');">Delete</button>
          </fieldset>

        </form>
      </div>
    </div>

  </div>
</body>


</html>



<style>
* {
  -webkit-box-sizing: border-box;
}
</style>










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
function submit(){
  alert('Διαγράφτηκε');
}


// Open default
document.getElementById("defaultOpen").click();
</script>

<?php
//alert("Hello World");

function alertMsg($msg,$a) {
    //echo "<script type='text/javascript'>alert('$msg');</script>";

    if($a=="1"){

    }elseif($a=="2"){
      //header("Refresh:1");
      //openTab(event, 'remove');
    }
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>
