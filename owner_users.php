<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style_lib.css">
<style>

* {
  -webkit-box-sizing: border-box;
}
</style>

<script>
$(document).ready(function() {

    $('#example tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>


<title>owner/modifyUsers</title>
</head>


<body>


  <ul class="sidenav">
    <li><a href="index_owner.php">Αρχική</a></li>
    <li><a class="active" href="owner_users.php">Διαμόρφωση Χρηστών</a></li>
    <li><a href="owner_menu.php">Διαμόρφωση Μενού</a></li>
    <li><a href="owner_orders.php">Διαχείρηση Παραγγελιών</a></li>
    <li><a href="logout.php">Αποσύνδεση</a></li>
  </ul>

  <div class="content">

      <div class="tab">
        <button id="defaultOpen" class="tablinks" onclick="openTab(event, 'adduser')" >Add User</button>
        <button  class="tablinks" onclick="openTab(event, 'deluser')">Delete User</button>
        <button class="tablinks" onclick="openTab(event, 'modifyuser')">Modify User</button>
      </div>

	<!--1o TAB -->
	<div id="adduser" class="tabcontent">
		<div class="container2">

		<form id="contact" action="UserEdit.php" method="post">  <!--1h FORMA -->
			<fieldset>
				<input name="uname" placeholder="Username" type="text" tabindex="1" required autofocus>
			</fieldset>

			<fieldset>
				<input name="pass" placeholder="Password" type="text" tabindex="2" required>
			</fieldset>

			<fieldset>
				<input name="fname" placeholder="Όνομα" type="text" tabindex="3" required>
			</fieldset>

			<fieldset>
				<input name="lname" placeholder="Επίθετο" type="text" tabindex="4" required>
			</fieldset>

			<fieldset>
				<select name="rolos">
					<option value="4">Ιδιοκτήτης</option>
					<option value="2">Σερβιτόρος</option>
					<option value="1">Κουζίνα</option>
					<option value="3">Μάρκα</option>
				</select>
			</fieldset>

			<fieldset>
				<button name="add_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Προστέθηκε ')" >Add</button>
			</fieldset>

		</form>
		</div>
	</div>

	<!--2o TAB -->
	<div id="deluser" class="tabcontent">
	  <div class="container2">

		<form id="contact" action="UserEdit.php" method="post">
		  <fieldset>
                            <?php require "connection.php";
                              $sql = "SELECT *
                                      FROM users";
                              $stmt = $conn->query($sql);
                              echo '<select name="onomata">';
                              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value=" ' . $row['id_user'] .'">' . $row['id_user'] . " - " . $row['username'] .'</option>';
                              }
                              echo '</select>';
                            ?>
		  </fieldset>

		  <fieldset>
			<button name="delete_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Διαγράφτηκε ')">Delete</button>
		  </fieldset>

		</form>


	  </div>
	</div>

	<!--3o TAB -->
	<div id="modifyuser" class="tabcontent">
	  <div class="container2">
		<form id="contact"  action="UserEdit.php" method="post">

		  <fieldset>
        <?php require "connection.php";
          $sql = "SELECT username
                  FROM users";
          $stmt = $conn->query($sql);
          echo '<select name="users">';
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value=" ' . $row['username'] .'">' . $row['username'] .'</option>';
          }
          echo '</select>';
        ?>
		  </fieldset>

		  <fieldset>
        <select name="rolos2">
          <option value="4">Ιδιοκτήτης</option>
          <option value="2">Σερβιτόρος</option>
          <option value="1">Κουζίνα</option>
          <option value="3">Μάρκα</option>
        </select>
		  </fieldset>

		  <fieldset>
			<button name="modify_btn" type="submit" id="contact-submit" data-submit="...Sending" onclick="alert('Εγινε Αλλαγή ')">Submit</button>
		  </fieldset>

		</form>
	  </div>
	</div>


</div>
</body>
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
// Open default
document.getElementById("defaultOpen").click();
</script>
</html>
