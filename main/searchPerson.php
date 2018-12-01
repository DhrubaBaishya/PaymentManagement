<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$searchTerm = $_POST['searchTerm'];
$result = '<ul class="collection with-header">';

	if ($stmt = mysqli_prepare($conn, SEARCH_PERSON)) {
		$stmt->bind_param("s",$searchTerm);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($personId,$personName);
		while($stmt->fetch()){
			$result = $result . '<li class="collection-item">

			<div>

			<a class="personItemName" onclick="loadPersonData('.$personId.',\''.ucwords($personName).'\')">'.ucwords($personName).'</a>

			<a class="secondary-content" id="'.ucwords($personName).'" onclick="addPersonPaymentFromList(this.id)"><i class="material-icons">add_circle_outline</i></a>
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