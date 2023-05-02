<!DOCTYPE html>
<html>
<head>
<title>NGO Dashboard</title>
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
.center {
  text-align: center;
  border: 3px solid green;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
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

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}


input:checked + .slider {
  background-color: #cce5ff;
}

input:focus + .slider {
  box-shadow: 0 0 1px #cce5ff;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

label {
  display: inline-block;
  margin-right: 10px;
}
</style>
</head>
<body>
<div class="topbar">
	<?php
echo '<h1 style="color:#fff">';

$ngo=$_COOKIE["name"];
$branch = null;
$college = null;
$date = null;
if (isset($_POST['BRANCH'])) {
    setcookie('myCookie', 'value1', time() + 24 * 3600, '/');
    $branch = $_POST['BRANCH'];
}
if (isset($_POST['COLLEGE'])) {
  setcookie('myCookie', 'value1', time() + 24 * 3600, '/');
  $college = $_POST['COLLEGE'];
}
if (isset($_POST['DATE'])) {
    setcookie('myCookie', 'value1', time() + 24 * 3600, '/');
    $date = $_POST['DATE'];
}
 printf("Welcome %s",$ngo); echo '</h1>';

?>
	<div>
		<a href="http://localhost/deets.php">Change Details</a>
		<a href="http://localhost/ok.php">Event</a>
		<a href="http://localhost/attendance.php">Attendance</a>
	</div>
</div>
<h1 style="text-align:center;color:#0066cc"> NGO DASHBOARD </h1>

<?php
$branch = null;
$college = null;
$date = null;
if (isset($_POST['BRANCH'])) {
    setcookie('myCookie', 'value1');
    $branch = $_POST['BRANCH'];

}
if (isset($_POST['COLLEGE'])) {
  setcookie('myCookie', 'value1');
  $college = $_POST['COLLEGE'];
}
if (isset($_POST['DATE'])) {
    setcookie('myCookie', 'value1');
    $date = $_POST['DATE'];
}
$conn = mysqli_connect("localhost", "root", "", "ngo");

/*$sql = "SELECT N.URL FROM NGO N WHERE N.NAME=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("s", $x);
    $stmt->execute();*/
?>

<!--Sidebar-->
<div class="sidebar">
  <div class="sidebar-section">
    <h3>Branch</h3>
    <div class="sidebar-options" id="branch-options">
      <!-- Options fetched from database will be inserted here -->
      <?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ngo";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Fetch branch options from database
$sql = "SELECT DISTINCT BRANCH FROM STUDENTS";
$result = mysqli_query($conn, $sql);
echo "<form method='POST'>";
// Display options in sidebar
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<label> <input type ='radio' class='sidebar-option branch-option' name='BRANCH' value='" . $row["BRANCH"] . "'>" . $row["BRANCH"] . "</label>";
  }
}

mysqli_close($conn);
?>

    </div>
  </div>
  <div class="sidebar-section">
    <h3>College</h3>
    <div class="sidebar-options" id="college-options">
      <!-- Options fetched from database will be inserted here -->
      <?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ngo";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Fetch branch options from database
$sql = "SELECT DISTINCT COLLEGE FROM STUDENTS";
$result = mysqli_query($conn, $sql);

// Display options in sidebar
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<label> <input type ='radio' class='sidebar-option branch-option' name='COLLEGE' value='" . $row["COLLEGE"] . "'>" . $row["COLLEGE"] . "</label>";
  }
}

mysqli_close($conn);
?>
    </div>
  </div>
  <div class="sidebar-section">
    <h3>Date</h3>
    <div class="sidebar-options" id="college-options">
      <!-- Options fetched from database will be inserted here -->
      <?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ngo";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Fetch branch options from database
$sql = "SELECT DISTINCT DATE FROM EVENT";
$result = mysqli_query($conn, $sql);

// Display options in sidebar
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo  "<label> <input type ='radio' class='sidebar-option branch-option' name='DATE' value='" . $row["DATE"] . "'>" . $row["DATE"] . "</label>";
  }
}
echo "<br><button type='submit'>Filter</button>";
mysqli_close($conn);
echo"</form><br>";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * from students where (N1NAME = '$ngo' or N2NAME = '$ngo' or N3NAME = '$ngo' or N4NAME = '$ngo') ";
if($branch!=null)
{
  $sql= $sql."AND BRANCH = '$branch' ";
}
if($college!=null)
{
  $sql= $sql."AND COLLEGE = '$college' ";
}
if($date!=null)
{
  $sql= $sql."AND DATE = '$date' ";
}
$sql = $sql.";";
$result = mysqli_query($conn, $sql);
echo '<table class="table table-bordered table-hover table-striped">
  <thead class="thead-dark"><tr>
      <th>USN</th>
      <th>Name</th>
      <th>Email</th>
      <th>College</th>
      <th>Branch</th>
    </tr>';
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo  "<tr><td>".$row["USN"]."</td><td>".$row["NAME"]."</td><td>".$row["EMAIL"]."</td><td>".$row["COLLEGE"]."</td><td>".$row["BRANCH"]."</td></tr>";
  }
}
echo"</table>";
?>
    </div>
  </div>

<div class="container">
</div>

<!--End-->
</div>
</div>
</body>
</html>