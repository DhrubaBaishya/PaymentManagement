<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$month = $_POST['month'];
$year = $_POST['year'];
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
	if ($stmt = mysqli_prepare($conn, LOAD_MONTHLY_ITEM_PAYMENT)) {
		$stmt->bind_param("ss", $month,$year);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($itemId,$itemName,$amount,$gst,$date);
		while($stmt->fetch()){
			$result = $result . '
				<tr id="TR_'.$itemId.'" onclick="loadPerItem('.$itemId.')">
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