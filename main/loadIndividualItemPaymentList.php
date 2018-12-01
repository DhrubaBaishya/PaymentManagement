<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$itemId = $_POST['itemId'];
$month = $_POST['month'];
$year = $_POST['year'];
$result = '
<table class="striped">
        <thead>
          <tr>
              <th>Date</th>
              <th>Amount</th>
              <th>GST</th>
              <th>Total</th>
          </tr>
        </thead>
        <tbody>';
	if ($stmt = mysqli_prepare($conn, LOAD_MONTHLY_INDIVIDUAL_ITEM_PAYMENT)) {
		$stmt->bind_param("sss", $itemId,$month,$year);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($date,$amount,$gst);
		while($stmt->fetch()){
			$result = $result . '
				<tr>
					<td>'.date('d/M/y',strtotime($date)).'</td>
					<td>'.$amount.'</td>
					<td>'.$gst.'</td>
					<td>'.(($amount*($gst/100))+$amount).'</td>
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