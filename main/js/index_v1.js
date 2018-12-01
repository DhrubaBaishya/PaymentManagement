var personPaymentListType = 1;
$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.tabs').tabs();
    $('.fixed-action-btn').floatingActionButton({
	    direction: 'left'
	  });
    $('.modal').modal();
    $('select').formSelect();
    $('.dropdown-trigger').dropdown();
  });
function logout(){
	$.post("logout.php",{},function(data){
		window.location = data;
	});
}
function addPersonPaymentFromList(name){
	document.getElementById("personName").value = name;
	$("#addPersonPaymentModal").modal('open');
}
function addPersonPayment(){
	var personName = document.getElementById("personName").value;
	var remark = document.getElementById("remark").value;
	var personAmount = document.getElementById("personAmount").value;
	if(personName == '' || personAmount == ''){
		M.toast({html: 'Please enter both values.'});
		return;
	}
	$.post("addPersonPayment.php",{personName: personName,personAmount: personAmount,remark: remark},function(data){
		if(data == 1){
			M.toast({html: 'Payment added.'});
			document.getElementById("personName").value = '';
			document.getElementById("personAmount").value = '';
			$("#addPersonPaymentModal").modal('close');
			loadSelectedMonth();
		}
		else{
			M.toast({html: 'Error! Please try again.'});
		}
	});
}
function loadPersonPaymentList(month,year){
		$.post("loadPersonPaymentList.php",{personPaymentListType: personPaymentListType,month: month,year: year},function(data){
			document.getElementById("personPaymentList").innerHTML = data;
		});
}
function loadSelectedOption(){
	personPaymentListType = document.getElementById("personListType").value;
	var d = new Date();
	document.getElementById("itemYearValue").value = d.getYear() + 1900;
	loadAllItems();
	if(personPaymentListType == 1){
		document.getElementById("personMonthDiv").style.display="none";
		document.getElementById("personYearDiv").style.display="none";
	}
	else if(personPaymentListType == 2){
		document.getElementById("personMonthDiv").style.display="block";
		document.getElementById("personYearDiv").style.display="block";
		var dt = new Date();
		document.getElementById("personYearValue").value = dt.getYear() + 1900;
	}
	loadSelectedMonth();
}
function loadSelectedMonth(){
	var month = document.getElementById("personMonthValue").value;
	var year = document.getElementById("personYearValue").value;
	loadPersonPaymentList(month,year);
}
var individualPersonId = 0;
function loadPersonData(id,personName){
	document.getElementById("individualPersonPaymentList").innerHTML = "";
	var d = new Date();
	document.getElementById("individualPersonYearValue").value = d.getYear() + 1900;
	$("#loadPersonPaymentData").modal('open');
	document.getElementById("personNameHeader").innerHTML = personName;
	individualPersonId = id;
	loadIndividualSelectedMonth();
}
function loadIndividualSelectedMonth(){
	var month = document.getElementById("individualPersonMonthValue").value;
	var year = document.getElementById("individualPersonYearValue").value;
	if(month == 0){
		return;
	}
	loadIndividualPersonPaymentList(month,year);
}
function loadIndividualPersonPaymentList(month,year){
		$.post("loadIndividualPersonPaymentList.php",{personId: individualPersonId,month: month,year: year},function(data){
			document.getElementById("individualPersonPaymentList").innerHTML = data;
		});
}


function calculateGSTAmount(){
	var itemName = document.getElementById("itemName").value;
	var itemAmount = document.getElementById("itemAmount").value;
	var itemGst = document.getElementById("itemGst").value;
	if(itemName == '' || itemAmount == '' || itemGst == ''){
		M.toast({html: 'Please enter missing values.'});
		return;
	}
	document.getElementById("itemTotalAmount").value = ((itemAmount * itemGst)/100) + parseInt(itemAmount);
}
function addItemPayment(){
	var itemName = document.getElementById("itemName").value;
	var itemAmount = document.getElementById("itemAmount").value;
	var itemGst = document.getElementById("itemGst").value;
	var itemTotalAmount = document.getElementById("itemTotalAmount").value;

	if(itemName == '' || itemAmount == '' || itemGst == '' ){
		M.toast({html: 'Please enter missing values.'});
		return;
	}
	$.post("addItemPayment.php",{itemName: itemName,itemAmount: itemAmount,itemGst: itemGst},function(data){
		if(data == 1){
			M.toast({html: 'Payment added.'});
			document.getElementById("itemName").value = '';
			document.getElementById("itemAmount").value = '';
			document.getElementById("itemGst").value = '';
			document.getElementById("itemTotalAmount").value = '';
			$("#addItemPaymentModal").modal('close');
			loadItemSelectedMonth();
		}
		else{
			M.toast({html: 'Error! Please try again.'});
		}
	});
}

function loadAllItems(){
	$.post("loadAllItems.php",{},function(data){
			document.getElementById("itemPaymentList").innerHTML = data;
		});
}
function loadItemSelectedMonth(){
	var month = document.getElementById("itemMonthValue").value;
	var year = document.getElementById("itemYearValue").value;
	if(month == 0)
		loadAllItems();
	else
		loadItemPaymentList(month,year);
}
function loadItemPaymentList(month,year){
	$.post("loadItemPaymentList.php",{month: month,year: year},function(data){
			document.getElementById("itemPaymentList").innerHTML = data;
		});
}
function loadPerItem(id){
	$.post("loadPerItem.php",{id: id},function(data){
		document.getElementById("perItemModalContent").innerHTML = data;
		$("#perItemModal").modal('open');
	});
}