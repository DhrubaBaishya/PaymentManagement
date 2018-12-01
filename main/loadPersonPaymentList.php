<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$personPaymentListType = $_POST['personPaymentListType'];
$month = $_POST['month'];
$year = $_POST['year'];
$start = $_POST['start'];
$limit = $_POST['limit'];
$fetchCount = 0;
$result = '<table class="striped">
		        <tbody>';
if($personPaymentListType == 1){

	if ($stmt = mysqli_prepare($conn, LOAD_TOTAL_PERSON_PAYMENT)) {
		$stmt->bind_param("ss", $start,$limit);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($personId,$personName,$amount);
		while($stmt->fetch()){
			$fetchCount++;
			$result = $result . '
				<tr>
					<td>
						<a class="personItemName" onclick="loadPersonData('.$personId.',\''.ucwords($personName).'\')">'.ucwords($personName).' <b>('.$amount.')</b></a>
					</td>
					<td>
						<a class="secondary-content" id="'.ucwords($personName).'" onclick="addPersonPaymentFromList(this.id)"><i class="material-icons">add_circle_outline</i></a>
					</td>
				</tr>

			';

		}
		if($fetchCount > 0){
			$result = $result . '
				<tr id="LPTR_'.$start.'">
					<td colspan="2" style="text-align:center;color:#ee6e73;">
						<span onclick="loadPersonMore('.$start.')">Load More</span>
					</td>
				</tr>
			';
		}
		$result = $result . '</tbody></table>';
		mysqli_stmt_close($stmt);
		echo $result;	
	}
	else{
		echo 'Could not load data...';
	}
}
else if($personPaymentListType == 2){
	if ($stmt = mysqli_prepare($conn, LOAD_MONTHLY_PERSON_PAYMENT)) {
		$stmt->bind_param("ssss", $month,$year,$start,$limit);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($personId,$personName,$amount);
		while($stmt->fetch()){
			$fetchCount++;
			$result = $result . '
				<tr>
					<td>
						<a class="personItemName" onclick="loadPersonData('.$personId.',\''.ucwords($personName).'\')">'.ucwords($personName).' <b>('.$amount.')</b></a>
					</td>
					<td>
						<a class="secondary-content" id="'.ucwords($personName).'" onclick="addPersonPaymentFromList(this.id)"><i class="material-icons">add_circle_outline</i></a>
					</td>
				</tr>

			';

		}
		if($fetchCount > 0){
			$result = $result . '
				<tr id="LPTR_'.$start.'">
					<td colspan="2" style="text-align:center;color:#ee6e73;">
						<span onclick="loadPersonMore('.$start.')">Load More</span>
					</td>
				</tr>
			';
		}
		$result = $result . '</tbody></table>';
		mysqli_stmt_close($stmt);
		echo $result;	
	}
	else{
		echo 'Could not load data...';
	}
}
else if($personPaymentListType == 3){
	if($start == 0){
	$result = '
		<table class="striped">
		        <thead>
		          <tr>
		              <th>Date</th>
		              <th>Name</th>
		              <th>Amount</th>
		              <th></th>
		          </tr>
		        </thead>
		        <tbody>';
		    }
	if ($stmt = mysqli_prepare($conn, LOAD_RECENT_PERSON_PAYMENT)) {
		$stmt->bind_param("ss", $start,$limit);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($paymentId,$date,$personId,$personName,$amount);
		while($stmt->fetch()){
			$fetchCount++;
			$result = $result . '

				<tr id="TR_'.$paymentId.'">
					<td>'.date('d/M/y',strtotime($date)).'</td>
					<td>'.$personName.'</td>
					<td>'.$amount.'</td>
					<td><i class="material-icons" onclick="deletePayment('.$paymentId.')">delete</i></td>
				</tr>';
		}
		if($fetchCount > 0){
			$result = $result . '
				<tr id="LPTR_'.$start.'">
					<td colspan="4" style="text-align:center;color:#ee6e73;">
						<span onclick="loadPersonMore('.$start.')">Load More</span>
					</td>
				</tr>
			';
		}
		$result = $result . '</tbody></table>';
		mysqli_stmt_close($stmt);
		echo $result;	
	}
	else{
		echo 'Could not load data...';
	}
}

?>