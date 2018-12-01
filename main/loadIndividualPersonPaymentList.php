<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$personId = $_POST['personId'];
$month = $_POST['month'];
$year = $_POST['year'];
$start = $_POST['start'];
$limit = $_POST['limit'];
$fetchCount = 0;
$result = '<table class="striped">
		        <tbody>';
if($start == 0){
	$result = '
	<table class="striped">
	        <thead>
	          <tr>
	              <th>Date</th>
	              <th>Remark</th>
	              <th>Amount</th>
	          </tr>
	        </thead>
	        <tbody>';
}
	if ($stmt = mysqli_prepare($conn, LOAD_MONTHLY_INDIVIDUAL_PERSON_PAYMENT)) {
		$stmt->bind_param("sssss", $personId,$month,$year,$start,$limit);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($date,$amount,$remark);
		while($stmt->fetch()){
			$fetchCount++;
			$result = $result . '
				<tr>
					<td>'.date('d/M/y',strtotime($date)).'</td>
					<td>'.$remark.'</td>
					<td>'.$amount.'</td>
				</tr>

			';
		}
		if($fetchCount > 0){
			$result = $result . '
				<tr id="LIPTR_'.$start.'">
					<td colspan="3" style="text-align:center;color:#ee6e73;">
						<span onclick="loadIndividualPersonMonthMore('.$start.')">Load More</span>
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

?>