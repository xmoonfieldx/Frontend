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
</style>
</head>
<body>
<div class="topbar">
	<?php
echo '<h1 style="color:#fff">';
 printf("Welcome %s",$_COOKIE["name"]); echo '</h1>';

?>
	<div>
		<a href="http://localhost/deets.php">Change Details</a>
		<a href="http://localhost/ok.php">Event</a>
		<a href="#">Attendance</a>
	</div>
</div>
<div class="container">
<?php

// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "", "ngo");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_COOKIE["name"];
    $availability = $_POST["availability"];
    $description = $_POST["description"];
    $logo_url = $_POST["logo"];

    // Update NGO details in database
    $sql = "UPDATE NGO SET AVAILABILITY=?, DES=?, LOGO=? WHERE NAME=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $availability, $description, $logo_url, $name);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Success message
        $msg = "NGO details updated successfully.";
    } else {
        // Error message
        $msg = "NGO details could not be updated.";
    }
}

// Fetch current NGO details from database
$name = $_COOKIE["name"];
$sql = "SELECT * FROM ngo WHERE NAME=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// Close database connection
mysqli_close($conn);

?>

<!-- HTML form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <img src="<?php echo $row["LOGO"]; ?>" alt="NGO Logo" width="200" height="200">
    <br/>
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $row["NAME"]; ?>" disabled>
    <br>
    <label>Availability:</label>
    <input type="text" name="availability" value="<?php echo $row["AVAILABILITY"]; ?>">
    <br>
    <label>Description:</label>
    <textarea name="description"><?php echo $row["DES"]; ?></textarea>
    <br>
    <label>Logo URL:</label>
    <input type="text" name="logo" value="<?php echo $row["LOGO"]; ?>">
    <br>
    <input type="submit" value="Update">
</form>

<!-- Display success/error message -->
<?php if (!empty($msg)): ?>
    <p><?php echo $msg; ?></p>
<?php endif; ?>

<!--End-->
</div>
</div>
</body>
</html>
