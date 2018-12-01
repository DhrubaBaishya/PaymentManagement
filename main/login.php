<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
if ($stmt = mysqli_prepare($conn, CHECK_USER_EXISTENCE)) {
	$stmt->bind_param("ss", $username,$password);
	mysqli_stmt_execute($stmt);
	$stmt->bind_result($user_id);
	$stmt->fetch();
	if ($user_id != ''){
		$_SESSION['username'] = $username;
		$_SESSION['userid'] = $user_id;
		echo DASHBOARD;
	}
	else
		echo 1;
	mysqli_stmt_close($stmt);
}
else{
	echo 0;
}

?>