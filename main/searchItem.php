<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$searchTerm = $_POST['searchTerm'];
$result = '<ul class="collection with-header">';

	if ($stmt = mysqli_prepare($conn, SEARCH_ITEM)) {
		$stmt->bind_param("s",$searchTerm);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($itemId,$itemName);
		while($stmt->fetch()){
			$result = $result . '<li class="collection-item">

			<div>

			<a class="personItemName"  onclick="loadItemData('.$itemId.',\''.ucwords($itemName).'\')">'.ucwords($itemName).'</a>
			</div></li>';
		}
		$result = $result . '</ul>';
		mysqli_stmt_close($stmt);
		echo $result;	
	}
	else{
		echo 'Could not load data...';
	}

?>