<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .koo
{
  background-color: #f8d7da;
  text-align:center; 
  size:20px; 
  font-size: 150%
}
.topbar {
			background-color: #333;
			color: #fff;
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 10px;
		}

		.topbar a {
			color: #fff;
			margin: 0 10px;
			text-decoration: none;
			font-weight: bold;
		}
</style>
</head>
<body>
<!--TopBar-->
<div class="topbar">
	<?php
  $conn = mysqli_connect("localhost", "root", "", "ngo");
  if (!$conn){
      echo 'BRah';
  }
  $y=$_COOKIE["name"];
  $sql = "SELECT N.NAME FROM STUDENTS N WHERE N.USN=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("s", $y);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $name = $row["NAME"];
echo '<h1 style="color:#fff">';
 printf("Welcome %s",$name); echo '</h1>';

?>
	<div>
		<a href="#">View Certificate</a>
		<a href="#">Change Password</a>
		<a href="http://localhost/logins.html">Logout</a>
	</div>
</div>
<div class="container">
<h1 style="text-align:center;color:#0066cc"> STUDENT DASHBOARD </h1>


<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Register for NGO</h2>
    <a href="http://localhost/registerForNgo.php" class="btn btn-primary">Take me there</a>
</div>

</div>
    <!--TABLE OF NGOs REGISTERED-->
    <div class="alert alert-danger">
    <?php
        //$x='Smile Foundation';
        $y=$_COOKIE["name"];
        $sql = "SELECT * FROM STUDENTS N WHERE N.USN=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("s", $y);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $n1 = $row["N1NAME"];
        $h1 = $row["N1HOURS"]; 
        $n2 = $row["N2NAME"];
        $h2 = $row["N2HOURS"]; 
        $n3 = $row["N3NAME"];
        $h3 = $row["N3HOURS"]; 
        $n4 = $row["N4NAME"];
        $h4 = $row["N4HOURS"]; 
if(1) {
  echo "<table>";
  echo "<tr><th>Name</th><th>Hours</th></tr>";
  
  if(!empty($n1)) {
    echo "<tr><td>$n1</td><td>$h1</td></tr>";
  }
  
  if(!empty($n2)) {
    echo "<tr><td>$n2</td><td>$h2</td></tr>";
  }
  
  if(!empty($n3)) {
    echo "<tr><td>$n3</td><td>$h3</td></tr>";
  }
  
  if(!empty($n4)) {
    echo "<tr><td>$n4</td><td>$h4</td></tr>";
  }
  
  echo "</table>";
}


        
?>
</div>
<div class="alert alert-info">
<?php
        $sql = "SELECT N.N1NAME FROM STUDENTS N WHERE N.USN=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("s", $y);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $n1 = "0";
        $n1 = $row["N1NAME"];

        $sql = "SELECT N.N2NAME FROM STUDENTS N WHERE N.USN=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("s", $y);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $n2 = "0";
        $n2 = $row["N2NAME"];

        $sql = "SELECT N.N3NAME FROM STUDENTS N WHERE N.USN=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("s", $y);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $n3 = "0";
        $n3 = $row["N3NAME"];

        $sql = "SELECT N.N4NAME FROM STUDENTS N WHERE N.USN=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("s", $y);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $n4 = "0";
        $n4 = $row["N4NAME"];


        $sql = "SELECT * FROM event WHERE date > NOW() AND NGO=? OR NGO=? OR NGO=? OR NGO=?";
        
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("ssss", $n1, $n2, $n3, $n4);
        $stmt->execute();
        $result = $stmt->get_result();

// Display the events in a table
echo '<h2>Upcoming Events </h2>';
echo '<div>';
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>Event Name</th>';
echo '<th>Event Date</th>';
echo '<th>Event Location</th>';
echo '<th></th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
  echo '<tr>';
  echo '<td>' . $row['NGO'] . '</td>';
  echo '<td>' . $row['DATE'] . '</td>';
  echo '<td>' . $row['LOCATION'] . '</td>';
  //echo '<td><button value="' . $row['EVENTID'] . '">RSVP</button></td>';
  echo '<td><button value="'.$row['EVENTID'] .'" onclick="rsvp(this.value)">RSVP</button></td>';

  echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';
// Close the database connection
mysqli_close($conn);
?>
<script>
function rsvp(eventId) {
  //var usn = '<?php echo $_COOKIE["usn"]; ?>'; // replace with your session variable or hardcoded value
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText); // do something with the response, if needed
    }
  };
  xhttp.open("POST", "rsvp.php", true); // replace with your PHP file that handles the insert query
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("eventId=" + eventId);// + "&usn=" + usn);
}
</script>

</div>
<div class="alert alert-danger">
   <!--FORM TO PICK NGO-->
   <h2>Events Volunteered For</h2>



<form action = "http://localhost/viewevents.php" method = "post" style="font-family: Comfortaa; font-size: 110%; letter-spacing: 1.5px;">
    <div class = "usualDiv">
    <table>
        <tr>
          <td>Enter the NGO name</td>
          <td><input type = "text" name = "name" size = "30" /></td>
        </tr>
        <tr>
          <td></td>
          <td><input type = "submit" value = "Create" class = "koo"/></td>
       </tr>
     </table>
    </div>
</form>
</div>
</div>
</body>
</html> 