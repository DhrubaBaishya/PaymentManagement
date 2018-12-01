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
    $('.datepicker').datepicker({
    	defaultDate: new Date,
    	setDefaultDate: true
    });
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
	var personDate = document.getElementById("personDate").value;
	if(personName == '' || personAmount == '' || personDate == ''){
		M.toast({html: 'Please enter both values.'});
		return;
	}
	$.post("addPersonPayment.php",{personName: personName,personAmount: personAmount,remark: remark,personDate: personDate},function(data){
		if(data == 1){
			M.toast({html: 'Payment added.'});
			document.getElementById("personName").value = '';
			document.getElementById("personAmount").value = '';
			document.getElementById("remark").value = '';
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
	if(personPaymentListType == 1 || personPaymentListType == 3){
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
	loadIndividualRecentData();
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
function loadIndividualRecentData(){
		$.post("loadIndividualRecentData.php",{personId: individualPersonId},function(data){
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
	var itemDate = document.getElementById("itemDate").value;

	if(itemName == '' || itemAmount == '' || itemGst == '' ){
		M.toast({html: 'Please enter missing values.'});
		return;
	}
	$.post("addItemPayment.php",{itemName: itemName,itemAmount: itemAmount,itemGst: itemGst,itemDate: itemDate},function(data){
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
		document.getElementById("perItemModal").innerHTML = data;
		$("#perItemModal").modal('open');
	});
}
function openPersonSearch(){
	document.getElementById("searchPersonInput").value = '';
	document.getElementById("searchPersonList").innerHTML = '';
	$("#searchPerson").modal('open');
}
function openItemSearch(){
	document.getElementById("searchItemInput").value = '';
	document.getElementById("searchItemList").innerHTML = '';
	$("#searchItem").modal('open');
}
function searchPerson(){
	var searchTerm = document.getElementById("searchPersonInput").value;
	if(searchTerm == ''){
		M.toast({html: 'Please enter a search term.'});
		return;
	}
	$.post("searchPerson.php",{searchTerm: searchTerm},function(data){
		document.getElementById("searchPersonList").innerHTML = data;
	});
}
function searchItem(){
	var searchTerm = document.getElementById("searchItemInput").value;
	if(searchTerm == ''){
		M.toast({html: 'Please enter a search term.'});
		return;
	}
	$.post("searchItem.php",{searchTerm: searchTerm},function(data){
		document.getElementById("searchItemList").innerHTML = data;
	});
}
var deleteId = '';
function deletePayment(id){
	deleteId = id;
	$("#deleteWarning").modal('open');
}
function deleteConfirm(){
	$.post("deletePayment.php",{id: deleteId},function(data){
		M.toast({html: data});
		$( "#TR_"+deleteId ).remove();
	});
}
function openAddPerson(){
	document.getElementById("personName").value = '';
	document.getElementById("personAmount").value = '';
	document.getElementById("remark").value = '';
	$('.datepicker').datepicker({
    	defaultDate: new Date,
    	setDefaultDate: true
    });
	$("#addPersonPaymentModal").modal('open');
}
function openAddItem(){
	document.getElementById("itemName").value = '';
	document.getElementById("itemAmount").value = '';
	document.getElementById("itemGst").value = '';
	document.getElementById("itemTotalAmount").value = '';	
	$('.datepicker').datepicker({
    	defaultDate: new Date,
    	setDefaultDate: true
    });
	$("#addItemPaymentModal").modal('open');
}