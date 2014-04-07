$( document ).ready(function() {
    console.log( "ready!" );
});
/*
var print = function(o){
    var str='';

    for(var p in o){
        if(typeof o[p] == 'string'){
            str+= p + ': ' + o[p]+'; </br>';
        }else{
            str+= p + ': { </br>' + print(o[p]) + '}';
        }
    }

    return str;
}

var valGender=document.forms["myForm"]["gender"].value;
$('body').append( print(valGender) );
*/
function displayCarAccommodation()
{

	var link = document.getElementById('carAccommodation');
	link.style.display = 'block'; 
}

function hideCarAccommodation()
{

	var link = document.getElementById('carAccommodation');
	link.style.display = 'none'; 
}
console.log("DEF\n");
function validateForm()
{
	// >>> check gender
	var e = document.getElementById("idGender");
	var genderText = e.options[e.selectedIndex].text;

	if (genderText=="Select One")
	{
		alert("Please select your gender!");
		return false;		
	}	
	// <<< check gender

	// >>> check radio car
	var doDrive = true;

	var radios = document.getElementsByName('drive');

	for (var i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			// do whatever you want with the checked radio
			// alert(radios[i].value);
			if(radios[i].value == "No") {
				doDrive = false;
			} else {
				doDrive = true;
			}
			// only one radio can be logically checked, don't check the rest
			break;
		}
	}	
	
	e = document.getElementById("carAccom");
	var carAccomText = e.options[e.selectedIndex].text;
	
	if (doDrive && carAccomText=="3.14")
	{
		alert("3.14? Really? Well we don't want to chainsaw anyone :(\n");
		return false;
	}	
	// <<< check radio car
	
	// >>> check ZIP
	e = document.getElementById("idZipCode");
	var v = e.value;
	var ratio = v / 90000;

	if (v / 90000 < 1) {
		alert("Looks like you are not in CA. Sorry, we lost to distance :( \n");
		return false;		
	}
	// <<< check ZIP
	
	// >>> check Email
	e = document.getElementById("idEmail");
	v = e.value;
	var result = validateEmail(v);
	if(result) {
		//alert("Good Email\n");
	} else {
		alert("Sorry your email is not valid\n");
		return false;
	}
	// <<< check Email
	
	// >>> check Cell
	e = document.getElementById("idCell");
	v = e.value;
	result = phonenumber(v);
	if(result) {
		//alert("Good Cell\n");
	} else {
		alert("Your cell number seems not valid\n");
		return false;
	}
	// <<< check Cell

	return true;
}

function phonenumber(inputtxt)
{
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(inputtxt.match(phoneno))
     {
	   return true;     
	 }
   else
     {
	   //alert("Not a valid Phone Number");
	   return false;
     }
}


function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

// at least one checkbox
$(function(){
    var chbxs = $(':checkbox[required]');
    var namedChbxs = {};
    chbxs.each(function(){
        var name = $(this).attr('name');
        namedChbxs[name] = (namedChbxs[name] || $()).add(this);
    });
    chbxs.change(function(){
        var name = $(this).attr('name');
        var cbx = namedChbxs[name];
        if(cbx.filter(':checked').length>0){
            cbx.removeAttr('required');
        }else{
            cbx.attr('required','required');
        }
    });
});