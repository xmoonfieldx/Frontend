
<!DOCTYPE html>
<html lang = "en">
 <head>
 <title> Process the popcorn3.html form </title>
<meta charset = "utf-8" />
 <style type = "text/css">
 td, th, table {border: thin solid black;}
 </style>
 </head>
 <body>
 <?php
// Get form data values
 $Name = $_POST["Username"];
 $Password = $_POST["Password"];

 //Set Cookies
 $cookie_name = "name";
 $cookie_value = $Name;
 setcookie($cookie_name, $cookie_value,time()+(24*60*60));

 $conn = mysqli_connect("localhost", "root", "", "ngo");
 if (!$conn) {
 die("Connection failed: " . $conn->connect_error);
 }

$sql = "SELECT * FROM ngo N WHERE N.NAME=? AND N.PASSWORD=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $Name, $Password);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
if (mysqli_num_rows($result) > 0) {
  header("Location: http://localhost/x.php");
  exit();
} else {
  $sql = "SELECT * FROM students N WHERE N.USN=? AND N.PASSWORD=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $Name, $Password);
  $stmt->execute();
  $result = $stmt->get_result(); // get the mysqli result
  
  $cookie_name = "usn";
 $cookie_value = $Name;
 setcookie($cookie_name, $cookie_value,time()+(24*60*60));
  if (mysqli_num_rows($result) > 0) {
    header("Location: http://localhost/z.php");
    exit();
  }
    // Display the alert box
    echo "<script>
    alert('You may have entered wrong values!');
    window.location.href='http://localhost/loginpage.html';
    </script>";
}
  ?>
 </body>
</html>
