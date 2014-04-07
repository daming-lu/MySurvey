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
	console.log("ABC\n");
	var error_msg = "";
	var hasError = false;

	// >>> check gender
	var e = document.getElementById("idGender");
	var genderText = e.options[e.selectedIndex].text;

	if (genderText=="Select One")
	{
		error_msg += "Please choose your gender!\n";
		//alert(error_msg);
		hasError = true;
	}	
	// <<< check gender
	
	// >>> check radio car
	var doDrive = true;
	var doDriveDom = document.getElementsByTagName("drive");
	doDriveDom = doDriveDom[0];
	
	if (doDriveDom == "No") {
		doDrive = false;
	}
	
	
	e = document.getElementById("carAccom");
	var carAccomText = e.options[e.selectedIndex].text;
	
	if (carAccomText=="3.14")
	{
		error_msg += "Please choose your gender!\n";
		alert("3.14? Really? Well we don't want to chainsaw anyone\n");
		hasError = true;
	}	
	// <<< check radio car
	
	// >>> check ZIP
	e = document.getElementById("idZipCode");
	var v = e.text;
	console.log("idZipCode == "+v);
	// <<< check ZIP	
		
	if (hasError == true) {
		alert(error_msg);
		return false;
	}
	return true;
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