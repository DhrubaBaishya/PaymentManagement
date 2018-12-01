<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$personId = time();
$paymentId = time();
$personName = $_POST['personName'];
$amount = $_POST['personAmount'];
$remark = $_POST['remark'];
$personDate = $_POST['personDate'];
$time = strtotime($personDate);
$newformat = date('Y-m-d',$time);
if ($stmt = mysqli_prepare($conn, CHECK_PERSON_EXISTENCE)) {
	$stmt->bind_param("s", $personName);
	mysqli_stmt_execute($stmt);
	$stmt->bind_result($user_id);
	$stmt->fetch();
	mysqli_stmt_close($stmt);
	if ($user_id != ''){
		if ($stmt3 = mysqli_prepare($conn, INSERT_PERSON_PAYMENT)) {
			$stmt3->bind_param("sssss", $paymentId,$user_id,$amount,$remark,$newformat);
			mysqli_stmt_execute($stmt3);
			mysqli_stmt_close($stmt3);
		}
	}
	else{
		if ($stmt1 = mysqli_prepare($conn, INSERT_PERSON)) {
			$stmt1->bind_param("ss", $personId, $personName);
			mysqli_stmt_execute($stmt1);
			mysqli_stmt_close($stmt1);
		}
		if ($stmt2 = mysqli_prepare($conn, INSERT_PERSON_PAYMENT)) {
			$stmt2->bind_param("sssss", $paymentId,$personId,$amount,$remark,$newformat);
			mysqli_stmt_execute($stmt2);
			mysqli_stmt_close($stmt2);
		}
	}
	echo 1;
}
else{
	echo 0;
}

?>