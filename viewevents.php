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
    <!--<h2>Head to the student dashboard</h2>-->
    <a href="http://localhost/z.php" class="btn btn-primary">Student Dashboard</a>
</div>

<?php
// Replace $USN with your actual value
$USN = $_COOKIE["usn"];
$ngo = $_POST["name"];
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "ngo");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define the query to fetch the data
$sql = "SELECT E.DATE, E.HOURS_SPENT, E.LOCATION, E.TYPE, E.NAME FROM EVENT E, LIST L WHERE L.USN='$USN' AND E.EVENTID=L.EVENTID AND E.NGO='$ngo' AND E.DATE <= NOW()";

// Execute the query and store the result set
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if there are any rows in the result set
if (mysqli_num_rows($result) > 0) {
    // Start the HTML table
    echo "<table>";
    echo "<tr><th>Date</th><th>Hours Spent</th><th>Location</th><th>Type</th><th>Name</th></tr>";
    // Loop through the result set and output the data into the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["DATE"] . "</td>";
        echo "<td>" . $row["HOURS_SPENT"] . "</td>";
        echo "<td>" . $row["LOCATION"] . "</td>";
        echo "<td>" . $row["TYPE"] . "</td>";
        echo "<td>" . $row["NAME"] . "</td>";
        echo "</tr>";
    }
    // End the HTML table
    echo "</table>";
} else {
    echo "No results found.";
}

// Close the database connection
mysqli_close($conn);
?>
</div>
</body>
</html>

<!--Query = SELECT E.DATE, E.HOURS_SPENT, E.LOCATION, E.TYPE, E.NAME FROM EVENT E, LIST L WHERE L.USN=$USN AND E.EVENTID=L.EVENTID-->