<!--INSERT INTO STUDNGO(USN, NGO, Hours) VALUES (?,?,0);-->
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
</style>
</head>
<body>
<div class="container">
<div class="alert alert-info">
<?php
   $conn = mysqli_connect("localhost", "root", "", "ngo");
   $usn = $_COOKIE["name"];
   $ngo = $_POST["name"];
   echo '<h1>'; echo($ngo); echo '</h1>';
   //$desc = $_POST["name"];
   //$desc = 'Yes';
   //$n = 'Smile Foundation';
   //if ($desc == "") $desc = '0';
   $sql = "INSERT INTO STUDNGO(USN, NGO, Hours) VALUES (?,?,0)";
   $stmt= $conn->prepare($sql);
   $stmt->bind_param("ss", $usn, $ngo);
   $result= $stmt->execute();
?>
  <form id = "login" action = "http://localhost/z.php" method = "post">
    <div class = "usualDiv">
      <table style="margin-top:70px; font-family:Comfortaa; font-size:150%; letter-spacing: 2px;">
        <tr>
          <td>You have selected the NGO!</td>
        </tr>
         <tr>
           <td></th>
           <td style= "text-align:center; ">&nbsp&nbsp<input type = "submit" value = "Okay" class = "koo"/></td>
        </tr>
      </table>
  </div>
  </form>
  </div>
  </div>
</body>
</html> 