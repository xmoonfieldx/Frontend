<?php
$ngo = $_POST['eventId'];
$conn = mysqli_connect("localhost", "root", "", "ngo");
$usn = $_COOKIE["usn"];

// Fetch the student record
$sql = "SELECT * FROM STUDENTS WHERE USN=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $usn);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Get the student row
$row = mysqli_fetch_assoc($result);

// Check which name field is empty
if (empty($row['N1NAME'])) {
    $field = "N1NAME";
} elseif (empty($row['N2NAME'])) {
    $field = "N2NAME";
} elseif (empty($row['N3NAME'])) {
    $field = "N3NAME";
} elseif (empty($row['N4NAME'])) {
    $field = "N4NAME";
} else {
    // All name fields are already filled
    $msg = "All name fields are already filled.";
}

if (isset($field)) {
    // Update the empty field
    $sql = "UPDATE STUDENTS SET $field = ? WHERE USN = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $ngo, $usn);
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Success message
        $msg = "NGO registered successfully.";
    } else {
        // Error message
        $msg = "NGO could not be updated.";
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
