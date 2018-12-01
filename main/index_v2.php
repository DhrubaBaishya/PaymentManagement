<?php
include 'common/setup.php';
include 'common/connection.php';
include 'common/constant.php';
if (!isset($_SESSION['username'])){
	header("Location: ".LOGIN_SCREEN);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../material/css/materialize.min.css"  media="screen,projection"/>
    <link href="../material/css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">

    <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  
</head>
<body onload="loadSelectedOption()">

	
  <ul id="mobile-demo" class="sidenav">
    <li><a class="subheader">Menu</a></li>
    <li><div class="divider"></div></li>
    <li><a class="sidenav-close" onclick="openAddPerson()"><i class="material-icons">person</i>Add Person Payment</a></li>
    <li><a class="sidenav-close" onclick="openAddItem()"><i class="material-icons">payment</i>Add Item Payment</a></li>
    <li><a class="sidenav-close" onclick="openPersonSearch()"><i class="material-icons">search</i>Search Person</a></li>
    <li><a class="sidenav-close" onclick="openItemSearch()"><i class="material-icons">search</i>Search Item</a></li>
    <li><a onclick="logout()"><i class="material-icons">power_settings_new</i>Logout</a></li>
  </ul>

  <nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">PayMan</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a class="active" href="#personDiv">Person Payment</a></li>
        <li class="tab"><a href="#itemDiv">Item Payment</a></li>
      </ul>
    </div>
  </nav>

  <div id="personDiv" class="col s12 personDiv">
  	<br>
  		<div class="row">
		    <div class="input-field col s12">
			    <select id="personListType" onchange="loadSelectedOption()">
			      <option value="1" selected>Total</option>
			      <option value="2">Monthly</option>
			      <option value="3">Recent</option>
			    </select>
			  </div>
		  	<div id="personMonthDiv" class="dateDiv col s6">
                 <select id="personMonthValue" onchange="loadSelectedMonth()">
                 	  <option value="0">Select Month</option>
	                  <option value="1">January</option>
	                  <option value="2">February</option>
	                  <option value="3">March</option>
	                  <option value="4">April</option>
	                  <option value="5">May</option>
	                  <option value="6">June</option>
	                  <option value="7">July</option>
	                  <option value="8">August</option>
	                  <option value="9">September</option>
	                  <option value="10">October</option>
	                  <option value="11">November</option>
	                  <option value="12">December</option>
                 </select> 
              </div>
              <div id="personYearDiv" class="dateDiv col s6">
                 <select id="personYearValue" onchange="loadSelectedMonth()">
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                  <option value="2031">2031</option>
                  <option value="2032">2032</option>
                  <option value="2033">2033</option>
                  <option value="2034">2034</option>
                  <option value="2035">2035</option>
                  <option value="2036">2036</option>
                  <option value="2037">2037</option>
                  <option value="2038">2038</option>
                  <option value="2039">2039</option>
                  <option value="2040">2040</option>
                  <option value="2041">2041</option>
                  <option value="2042">2042</option>
                  <option value="2043">2043</option>
                  <option value="2044">2044</option>
                  <option value="2045">2045</option>
                  <option value="2046">2046</option>
                  <option value="2047">2047</option>
                  <option value="2048">2048</option>
                  <option value="2049">2049</option>
                  <option value="2050">2050</option>
                 </select> 
               </div>
  			</div>
			<div id="personPaymentList" class="col s12">

			</div>

  </div>


  <div id="itemDiv" class="col s12 itemDiv">
  	<div class="row">
		  	<div id="itemMonthDiv" class="col s6">
                 <select id="itemMonthValue" onchange="loadItemSelectedMonth()">
                 	  <option value="0">Select Month</option>
                 	  <option value="1">January</option>
	                  <option value="2">February</option>
	                  <option value="3">March</option>
	                  <option value="4">April</option>
	                  <option value="5">May</option>
	                  <option value="6">June</option>
	                  <option value="7">July</option>
	                  <option value="8">August</option>
	                  <option value="9">September</option>
	                  <option value="10">October</option>
	                  <option value="11">November</option>
	                  <option value="12">December</option>
                 </select> 
              </div>
              <div id="itemYearDiv" class="col s6">
                 <select id="itemYearValue" onchange="loadItemSelectedMonth()">
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                  <option value="2031">2031</option>
                  <option value="2032">2032</option>
                  <option value="2033">2033</option>
                  <option value="2034">2034</option>
                  <option value="2035">2035</option>
                  <option value="2036">2036</option>
                  <option value="2037">2037</option>
                  <option value="2038">2038</option>
                  <option value="2039">2039</option>
                  <option value="2040">2040</option>
                  <option value="2041">2041</option>
                  <option value="2042">2042</option>
                  <option value="2043">2043</option>
                  <option value="2044">2044</option>
                  <option value="2045">2045</option>
                  <option value="2046">2046</option>
                  <option value="2047">2047</option>
                  <option value="2048">2048</option>
                  <option value="2049">2049</option>
                  <option value="2050">2050</option>
                 </select> 
               </div>
  			</div>
			<div id="itemPaymentList" class="col s12">

			</div>


  </div>



<!--div class="fixed-action-btn">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">mode_edit</i>
  </a>
  <ul>
    <li><a class="btn-floating yellow darken-1 modal-trigger" href="#addPersonPaymentModal"><i class="material-icons">person</i></a></li>
    <li><a class="btn-floating green modal-trigger"  href="#addItemPaymentModal"><i class="material-icons">payment</i></a></li>
  </ul>
</div-->


<!-- Modal Structure -->
  <div id="addPersonPaymentModal" class="modal bottom-sheet addModal">
    <div class="modal-content">
      <h4>Add Person Payment</h4>
      <div class="row">
	        <div class="input-field col s12">
	          <input placeholder="Person Name" id="personName" type="text" class="validate">
	        </div>
	        <div class="input-field col s12">
	          <input placeholder="Remark" id="remark" type="text" class="validate">
	        </div>
	        <div class="input-field col s6">
	          <input placeholder="Amount" id="personAmount" type="number" class="validate">
	        </div>
	        <div class="input-field col s6">
	        	<input type="text" class="datepicker" id="personDate">
	        </div>
	    </div>
    </div>
    <div class="modal-footer">
    	<a class="waves-effect waves-green btn-flat" onclick="addPersonPayment()">Add</a>
      	<a class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div>
  </div>

  <div id="loadPersonPaymentData" class="itemPersonData modal bottom-sheet modal-fixed-footer">
    <div class="modal-content personPaymentData">
      <h4 id="personNameHeader"></h4>
      <div class="row">
	        <div id="personMonthDiv" class="col s6">
                 <select id="individualPersonMonthValue" onchange="loadIndividualSelectedMonth()">
                 	  <option value="0">Select Month</option>
                 	  <option value="1">January</option>
	                  <option value="2">February</option>
	                  <option value="3">March</option>
	                  <option value="4">April</option>
	                  <option value="5">May</option>
	                  <option value="6">June</option>
	                  <option value="7">July</option>
	                  <option value="8">August</option>
	                  <option value="9">September</option>
	                  <option value="10">October</option>
	                  <option value="11">November</option>
	                  <option value="12">December</option>
                 </select> 
              </div>
              <div id="personYearDiv" class="col s6">
                 <select id="individualPersonYearValue" onchange="loadIndividualSelectedMonth()">
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                  <option value="2031">2031</option>
                  <option value="2032">2032</option>
                  <option value="2033">2033</option>
                  <option value="2034">2034</option>
                  <option value="2035">2035</option>
                  <option value="2036">2036</option>
                  <option value="2037">2037</option>
                  <option value="2038">2038</option>
                  <option value="2039">2039</option>
                  <option value="2040">2040</option>
                  <option value="2041">2041</option>
                  <option value="2042">2042</option>
                  <option value="2043">2043</option>
                  <option value="2044">2044</option>
                  <option value="2045">2045</option>
                  <option value="2046">2046</option>
                  <option value="2047">2047</option>
                  <option value="2048">2048</option>
                  <option value="2049">2049</option>
                  <option value="2050">2050</option>
                 </select> 
               </div>
               <div id="individualPersonPaymentList" class="col s12">

				</div>
	    </div>
    </div>
    <div class="modal-footer">
      	<a class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>

  <div id="addItemPaymentModal" class="modal bottom-sheet addModal">
    <div class="modal-content">
      <h4>Add Item Payment</h4>
      	<div class="row">
	        <div class="input-field col s6">
	          <input placeholder="Item Name" id="itemName" type="text" class="validate">
	        </div>
	        <div class="input-field col s6">
	        	<input type="text" class="datepicker" id="itemDate">
	        </div>
	        <div class="input-field col s4">
	          <input placeholder="Amount" id="itemAmount" type="number" class="validate">
	        </div>
	        <div class="input-field col s4">
	          <input placeholder="GST" id="itemGst" type="number" min="0" max="100" value="0" class="validate">
	        </div>
	        <div class="input-field col s4">
	          <input placeholder="Total" id="itemTotalAmount" type="number" class="validate" disabled>
	        </div>
	    </div>
    </div>
    <div class="modal-footer">
    	<a class="waves-effect waves-green btn-flat" onclick="calculateGSTAmount()">Calculate</a>
    	<a class="modal-close waves-effect waves-green btn-flat" onclick="addItemPayment()">Add</a>
      	<a class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div>
  </div>
      
  <div id="perItemModal" class="modal modal-fixed-footer">

  </div> 

  <div id="searchPerson" class="itemPersonData modal bottom-sheet modal-fixed-footer">
    <div class="modal-content personPaymentData">
    	<div class="row">
	        <div class="input-field col s12">
	          <input id="searchPersonInput" placeholder="Search Person" type="text" class="validate">
	        </div>
	        <div id="searchPersonList" class="col s12">
	          
	        </div>
	     </div>
    </div>

    <div class="modal-footer">
    	<a class="waves-effect waves-green btn-flat" onclick="searchPerson()">Search</a>
      	<a class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
   </div>

   <div id="searchItem" class="itemPersonData modal bottom-sheet modal-fixed-footer">
    <div class="modal-content personPaymentData">
    	<div class="row">
	        <div class="input-field col s12">
	          <input id="searchItemInput" placeholder="Search Item" type="text" class="validate">
	        </div>
	        <div id="searchItemList" class="col s12">
	          
	        </div>
	     </div>
    </div>

    <div class="modal-footer">
    	<a class="waves-effect waves-green btn-flat" onclick="searchItem()">Search</a>
      	<a class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
   </div> 

   <div id="deleteWarning" class="modal">
    <div class="modal-content">
    	<h4>Delete Warning!</h4>
    	<p>Are you sure you want to delete the payment?</p>
    </div>

    <div class="modal-footer">
    	<a class="modal-close waves-effect waves-green btn-flat" onclick="deleteConfirm()">Confirm</a>
      	<a class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div>
   </div> 
  
  <script type="text/javascript" src="../js/jquery-3.js"></script>
  <script type="text/javascript" src="js/index.js?16072018"></script>
  <script type="text/javascript" src="../material/js/materialize.min.js"></script>
</body>
</html>