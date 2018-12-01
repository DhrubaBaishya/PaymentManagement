<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$itemId = time();
$paymentId = time();
$itemName = $_POST['itemName'];
$itemAmount = $_POST['itemAmount'];
$itemGst = $_POST['itemGst'];
$itemDate = $_POST['itemDate'];
$time = strtotime($itemDate);
$newformat = date('Y-m-d',$time);
if ($stmt = mysqli_prepare($conn, CHECK_ITEM_EXISTENCE)) {
	$stmt->bind_param("s", $itemName);
	mysqli_stmt_execute($stmt);
	$stmt->bind_result($user_id);
	$stmt->fetch();
	mysqli_stmt_close($stmt);
	if ($user_id != ''){
		if ($stmt3 = mysqli_prepare($conn, INSERT_ITEM_PAYMENT)) {
			$stmt3->bind_param("sssss", $paymentId,$user_id,$itemAmount,$itemGst,$newformat);
			mysqli_stmt_execute($stmt3);
			mysqli_stmt_close($stmt3);
		}
	}
	else{
		if ($stmt1 = mysqli_prepare($conn, INSERT_ITEM)) {
			$stmt1->bind_param("ss", $itemId, $itemName);
			mysqli_stmt_execute($stmt1);
			mysqli_stmt_close($stmt1);
		}
		if ($stmt2 = mysqli_prepare($conn, INSERT_ITEM_PAYMENT)) {
			$stmt2->bind_param("sssss", $paymentId,$itemId,$itemAmount,$itemGst,$newformat);
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