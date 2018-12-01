<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
$paymentId = $_POST['id'];
$result = '<div id="perItemModalContent" class="modal-content">';
	if ($stmt = mysqli_prepare($conn, LOAD_PER_ITEM_PAYMENT)) {
		$stmt->bind_param("s", $paymentId);
		mysqli_stmt_execute($stmt);
		$stmt->bind_result($pId,$itemName,$amount,$gst,$date);
		$stmt->fetch();
			$result = $result . '
				<h6>'.$itemName.'</h6>
      			<p>Payment Date: <b>'.date('d/M/y',strtotime($date)).'</b></p>
      			<p>Amount: <b>'.$amount.'</b></p>
      			<p>GST: <b>'.$gst.'</b></p>
      			<p>Amount w/ GST: <b>'.(($amount * ($gst/100)) + $amount).'</b></p>

			';
		$result = $result . '
			</div>
		    <div class="modal-footer">
		      <a class="modal-close waves-effect waves-green btn-flat" onclick="deletePayment('.$pId.')">Delete</a>
		      <a class="modal-close waves-effect waves-green btn-flat">Close</a>
		    </div>

		';
		mysqli_stmt_close($stmt);
		echo $result;	
	}
	else{
		echo 'Could not load data...';
	}
?>


      
    