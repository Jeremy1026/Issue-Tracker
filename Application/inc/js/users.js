var obj;

function ProcessAJAX(url) {
	// native  object
	if (window.XMLHttpRequest) {
		// obtain new object
		obj = new XMLHttpRequest();
		// set the callback function
		obj.onreadystatechange = processChange;
		// we will do a GET with the url; "true" for asynch
		obj.open("GET", url, true);
		// null for GET with native object
		obj.send(null);
	// IE/Windows ActiveX object
	}
	else if (window.ActiveXObject) {
		obj = new ActiveXObject("Microsoft.XMLHTTP");
		if (obj) {
			obj.onreadystatechange = processChange;
			obj.open("GET", url, true);
			// don't send null for ActiveX
			obj.send();
		}
	}
	else {
		alert("Your browser does not support AJAX");
	}
}

function processChange() {
	// 4 means the response has been returned and ready to be processed
	if (obj.readyState == 4) {
		// 200 means "OK"
		if (obj.status == 200) {
			var arr = JSON.parse(obj.responseText);
			var i = 0;
			for (key in arr) {
				var firstName = JSON.stringify(arr[i]['first_name']);
				var lastName = JSON.stringify(arr[i]['last_name']);
				var id = JSON.stringify(arr[i]['id']);
				firstName = firstName.replace(/"/g, '');				
				lastName = lastName.replace(/"/g, '');				
				var x=document.getElementById("users_assigned[]");
				var option=document.createElement("option");
				option.value = id;
				option.text = firstName + ' ' + lastName;
				
				try {
					// for IE earlier than version 8
					x.add(option,x.options[null]);
				}
				catch (e) {
					x.add(option,null);
				}
			i++;
			}
		}
		else {
			alert(obj.status);
		}
	}
}

function getUsers() {
	url = './getUsers.php';
	ProcessAJAX(url);	
}