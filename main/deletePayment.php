<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$id = $_POST['id'];
	if ($stmt = mysqli_prepare($conn, DELETE_PAYMENT)) {
		$stmt->bind_param("s", $id);
		mysqli_stmt_execute($stmt);
		echo 'Payment deleted!';
	}
	else{
		echo 'Could not delete...';
	}
?>


      
    