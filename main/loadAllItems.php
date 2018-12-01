<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$result = '
<table class="striped">
        <thead>
          <tr>
              <th>Date</th>
              <th>Item Name</th>
              <th>Price</th>
          </tr>
        </thead>
        <tbody>';
	if ($stmt = mysqli_prepare($conn, LOAD_TOTAL_ITEM_PAYMENT)) {
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($paymentId,$itemName,$amount,$gst,$date);
		while($stmt->fetch()){
			$result = $result . '
				<tr id="TR_'.$paymentId.'" onclick="loadPerItem('.$paymentId.')">
					<td>'.date('d/M/y',strtotime($date)).'</td>
					<td>'.$itemName.'</td>
					<td>'.$amount.'</td>
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