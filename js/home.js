$( document ).ready(function(){
	checkDevice();
	$("#username").keydown(function (e) {
        
            if (e.keyCode == 13) {
                
                login();
            }
        });
     $("#password").keydown(function (e) {
        
            if (e.keyCode == 13) {
                
                login();
            }
        });
    });
function checkDevice(){
	if(document.body.offsetWidth > 500){
		window.location="http://www.pay-man.in/paymanDesktop.html";
	}		
}
function login(){
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	$.post("login.php",{username: username, password: password},function(data){
		if(data == 0){
			M.toast({html: 'Could not login.'});
		}
		else if(data == 1){
			M.toast({html: 'Invalid Username or Password.'});
		}
		else{
			window.location = data;
		}
	});
}