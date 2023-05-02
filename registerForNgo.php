<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="mystyle.css">
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
		<a href="#">Logout</a>
	</div>
</div>
<div class="container">
<h1 style="text-align:center;color:#0066cc"> REGISTER </h1>


<div style="display: flex; justify-content: space-between; align-items: center;">
    <!--<h2>Head to the student dashboard</h2>-->
    <a href="http://localhost/z.php" class="btn btn-primary">Student Dashboard</a>
</div>

<div class="container">
            <!--Filter
            <div id="filter">
              <form action="welcome_get.php" method="get" id="filter">
                  GAME: <input type="text" name="game">
                  POSITION: <input type="text" name="position">
                  <input type="submit" class="button-85" value="Filter">
              </div>-->
              <!--MongoDB
              It gets redirected to welcome_get.php which should be same code but with filtered content
              db.users.find({"game": /.*m.*/})
                  db.users.find({"position": /.*m.*/})-->


            <!--Postings part-->
            <div id="st-box">
              <div id="follow-up">
              <div class="container">
              <div class="row">
                <?php
                  $sql = "SELECT * FROM ngo";
                  $result = $conn->query($sql);
                  if (!empty($result) && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo '<div class="col-lg-4 col-md-6 mb-4">';
                      echo '<div class="card h-100">';
                      //echo '<img class="card-img-top" src="'.$row['NAME'].'"/> <br/>';
                      echo '<div class="card-body">';
                      echo '<h4 class="card-title">'.$row['NAME'].'</h4>';
                      echo '<p class="card-text">DES: '.$row['DES'].'</p>';
                      echo '<p class="card-text">EMAIL: '.$row['EMAIL'].'</p>';
                      /*echo '<p class="card-text">POSITION: '.$row['POSITION'].'</p>';
                      echo '<div class="applied">';
                      echo '<img src="image/control.png" id="applier"/>';
                      echo '<p style="font-size:120%">'.$row['APPLIED'].'</p>';
                      echo '</div>';
                      echo '<p class="card-text">ENDS IN</p>';
                      echo '<p class="card-text">'.$row['TIME'].'</p>';*/
                      //echo '<form action="postingsdetails.php" method="get" id="formpost">';
                      /*echo'<input type="hidden" id="custId" name="name" value="'.$row['NAME'].'">'
                      . '<button type="submit" form="formpost" class="btn btn-primary">Apply</button>';*/
                      echo '<td><button value="'.$row['NAME'] .'" onclick="rsvp(this.value)">RSVP</button></td>';
                      echo '</form>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                    }
                  } else {
                    echo "0 results";
                  }
                  $result->close();
                  $conn->close();
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
  xhttp.open("POST", "reg.php", true); // replace with your PHP file that handles the insert query
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("eventId=" + eventId);// + "&usn=" + usn);
}
</script>
              </div>
            </div>
            
                   
                  
                  
               
              </div>
            </div>

</body>
</html