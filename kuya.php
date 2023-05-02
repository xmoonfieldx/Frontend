<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <?php
                echo '<h1 style="color:#fff">';
                printf("Welcome %s",$_COOKIE["name"]); echo '</h1>';
            ?>
            <!--Add the welcome thing here in a div-->
        </div>
        <div class="nav_links">
            <ul>
                <li><a href="http://localhost/deets.php">Change Details</a></li>
                <li><a href="http://localhost/ok.php">Events</a></li>
                <li><a href="#">Attendance</a></li>
                <li class="logout_li"><a href="#" class="logout"><button class="logout">Logout</button></a></li>
             </ul>
        </div>
            <a href="#" class="toggle-button">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
    </nav>
    <script>
        const toggleButton = document.getElementsByClassName('toggle-button')[0]
        const navbarLinks = document.getElementsByClassName('nav_links')[0]

        toggleButton.addEventListener('click', () => {
            navbarLinks.classList.toggle('active')
        })
    </script>
    <h1 style="text-align:center;color:#0066cc"> NGO DASHBOARD</h1>

<?php
$conn = mysqli_connect("localhost", "root", "", "ngo");
$x=$_COOKIE["name"];
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

// Display options in sidebar
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<button class='sidebar-option branch-option' value='" . $row["BRANCH"] . "'>" . $row["BRANCH"] . "</button>";
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
    echo "<button class='sidebar-option branch-option' value='" . $row["COLLEGE"] . "'>" . $row["COLLEGE"] . "</button>";
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
    echo "<button class='sidebar-option branch-option' value='" . $row["DATE"] . "'>" . $row["DATE"] . "</button>";
  }
}
mysqli_close($conn);
?>
    </div>
  </div>

<div class="container">
  <h1>Okay</h1>
</div>

<!--End-->
</div>
</div>
</body>
</html>