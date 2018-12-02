<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$username = $_SESSION['username'];
$currentPassword = md5($_POST['currentPassword']);
$newPassword = md5($_POST['newPassword']);
if ($stmt = mysqli_prepare($conn, CHECK_USER_EXISTENCE)) {
	$stmt->bind_param("ss", $username,$currentPassword);
	mysqli_stmt_execute($stmt);
	$stmt->bind_result($user_id);
	$stmt->fetch();
	mysqli_stmt_close($stmt);
	if ($user_id != ''){
		if ($stmt1 = mysqli_prepare($conn, CHANGE_PASSWORD)) {
			$stmt1->bind_param("ss", $newPassword, $user_id);
			mysqli_stmt_execute($stmt1);
			mysqli_stmt_close($stmt1);
			echo 1;
		}
		else{
			echo -1;
		}
	}
	else{
		echo 0;
	}
}
else{
	echo -1;
}

?>