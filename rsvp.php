<?php
$eventId = $_POST['eventId'];
//$usn = $_POST['usn'];
$conn = mysqli_connect("localhost", "root", "", "ngo");
$y=$_COOKIE["usn"];
// your database connection and insert query here
$sql = "INSERT INTO LIST (EVENTID, USN) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $eventId, $y);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Success message
        $msg = "Event registered successfully.";
    } else {
        // Error message
        $msg = "Event could not be updated.";
    }

?>





