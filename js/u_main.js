$(document).ready(function() {
	$('#example').DataTable( {
		"order": [[ 3, "asc" ] , [ 2, "desc" ]]
    } );
} );

function reload() {
    setTimeout(function() {
        window.location.reload();
    }, 100);
}

function Clip(copy) {
  	var copyText = document.createElement("input");
  	document.body.appendChild(copyText);
  	copyText.value= "http://hcm-photos-dresden.de/u/" + copy;  
  	copyText.select();
  	document.execCommand("copy");
  	document.body.removeChild(copyText);
  	alert("Link kopiert: " + copyText.value);
} 