<!DOCTYPE html>
<html>
<head>
	<title>Center Div with Dropdown, Table, and Buttons</title>
	<style>
		.center-div {
			margin: 0 auto;
			width: 80%;
			height: 500px;
			border: 1px solid black;
			padding: 10px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}
	</style>
</head>
<body>
	<?php
		$conn = mysqli_connect("localhost", "root", "", "ngo");
		if (!$conn){
		    echo 'BRah';
		}
		$y=$_COOKIE["name"];
		$college = '';
		$branch = '';
		if(isset($_POST['college'])){
		    $college = $_POST['college'];
		}
		if(isset($_POST['branch'])){
		    $branch = $_POST['branch'];
		}
		if(isset($_POST['generate'])){
		    $sql = "SELECT * FROM STUDENTS WHERE  N1NAME=? OR N2NAME=? OR N3NAME=? OR N4NAME=?  AND BRANCH=? OR COLLEGE=?";
		    $stmt= $conn->prepare($sql);
		    $stmt->bind_param("ssssss", $y,$y,$y,$y,$branch,$college);
		    $stmt->execute();
		    $result = $stmt->get_result();
		}
		if(isset($_POST['export'])){
		    $sql = "SELECT * FROM STUDENTS WHERE  N1NAME=? OR N2NAME=? OR N3NAME=? OR N4NAME=?  AND BRANCH=? OR COLLEGE=?";
		    $stmt= $conn->prepare($sql);
		    $stmt->bind_param("ssssss", $y,$y,$y,$y,$branch,$college);
		    $stmt->execute();
		    $result = $stmt->get_result();
		    $file = 'students.xls';
		    $content = '';
		    while ($row = mysqli_fetch_array($result)) {
		        $content .= implode("\t", $row) . "\n";
		    }
		    header('Content-type: application/ms-excel');
		    header('Content-Disposition: attachment; filename='.$file);
		    echo $content;
		    exit();
		}
	?>
	<div class="center-div">
		<form method="POST">
			<label for="college">College:</label>
			<select id="college" name="college">
				<option value="">Select College</option>
				<?php
					$sql = "SELECT DISTINCT COLLEGE FROM STUDENTS";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result)){
					    if($row['COLLEGE'] == $college){
					        echo '<option value="'.$row['COLLEGE'].'" selected>'.$row['COLLEGE'].'</option>';
					    }else{
					        echo '<option value="'.$row['COLLEGE'].'">'.$row['COLLEGE'].'</option>';
					    }
					}
				?>
			</select>
			<label for="branch">Branch:</label>
			<select id="branch" name="branch">
				<option value="">Select Branch</option>
				<?php
					$sql = "SELECT DISTINCT BRANCH FROM STUDENTS";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result)){
					    if($row['BRANCH'] == $branch){
					        echo '<option value="'.$row['BRANCH'].'" selected>'.$row['BRANCH'].'</option>';
					    }else{
					       
                            <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="card mt-5">
                                        <div class="card-header">
                                            Student Records
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="">
                                                <div class="form-group">
                                                    <label for="college">College:</label>
                                                    <select class="form-control" id="college" name="college">
                                                        <?php
                                                        if ($college == "") {
                                                            echo '<option value="" selected>All Colleges</option>';
                                                        } else {
                                                            echo '<option value="">All Colleges</option>';
                                                        }
                                                        $college_query = "SELECT DISTINCT COLLEGE FROM STUDENTS";
                                                        $college_result = mysqli_query($conn, $college_query);
                                                        while ($row = mysqli_fetch_array($college_result)) {
                                                            if ($college == $row['COLLEGE']) {
                                                                echo '<option value="' . $row['COLLEGE'] . '" selected>' . $row['COLLEGE'] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $row['COLLEGE'] . '">' . $row['COLLEGE'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="branch">Branch:</label>
                                                    <select class="form-control" id="branch" name="branch">
                                                        <?php
                                                        if ($branch == "") {
                                                            echo '<option value="" selected>All Branches</option>';
                                                        } else {
                                                            echo '<option value="">All Branches</option>';
                                                        }
                                                        $branch_query = "SELECT DISTINCT BRANCH FROM STUDENTS";
                                                        $branch_result = mysqli_query($conn, $branch_query);
                                                        while ($row = mysqli_fetch_array($branch_result)) {
                                                            if ($branch == $row['BRANCH']) {
                                                                echo '<option value="' . $row['BRANCH'] . '" selected>' . $row['BRANCH'] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $row['BRANCH'] . '">' . $row['BRANCH'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <button type="submit" name="generate" class="btn btn-primary">Generate</button>
                                                <?php
                                                if (isset($_POST['generate']) && mysqli_num_rows($result) > 0) {
                                                    echo '<a href="export.php?college=' . $college . '&branch=' . $branch . '" class="btn btn-success ml-3">Export as Excel</a>';
                                                }
                                                ?>
                                            </form>
                                            <?php
                                            if (isset($_POST['generate'])) {
                                                echo '<div class="mt-3">';
                                                echo '<table class="table">';
                                                echo '<thead>';
                                                echo '<tr>';
                                                echo '<th>Name</th>';
                                                echo '<th>Roll No</th>';
                                                echo '<th>Branch</th>';
                                                echo '<th>College</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '<tbody>';
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['NAME'] . '</td>';
                                                    echo '<td>' . $row['USN'] . '</td>';
                                                    echo '<td>' . $row['BRANCH'] . '</td>';
                                                    echo '<td>' . $row['COLLEGE'] . '</td>';
                                                    echo '</tr>';
                                                }
                    