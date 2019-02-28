function imagesource(src){
	location.replace("#show");
  	document.getElementById("imgsrc").setAttribute("src", src);
  	document.getElementById("imgsrc").setAttribute("alt", "Image");
}

function hideimg(){
	location.replace("#/");
  	setTimeout(function(){document.getElementById("imgsrc").setAttribute("src", "");}, 100);
  	document.getElementById("imgsrc").setAttribute("alt", "");
}

function switchPage(test) {
    var page = test;
    $("#includedContent").load(page); 
    setTimeout(function(){$('html, body').animate({scrollTop: '0px'}, 500);}, 200);
}

function isMobile() {
    try{ document.createEvent("TouchEvent"); return true; }
    catch(e){ return false; }
}

if ( isMobile() == true ) {
    $(function() {
        $("#includedContent").swipe( {
            allowPageScroll: "vertical",		
            swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
                if(direction=="left"){ 	
                    var nextpage = $('#edttxt').attr('nextPage')
                    if(!nextpage){ 
                        return; 
                    } else { 
                        switchPage(nextpage); 
                    } 
                }
                if(direction=="right"){
                    var prevpage = $('#edttxt').attr('prevPage')
                    if(!prevpage){
    				    return;
                    } else {
                        switchPage(prevpage);
                    }
                }
            }
        });
    });
        document.getElementById("seitenzahl").innerHTML += '<br><span style="font-size: 20px;"><i>Nach links wischen um nächste Seite anzuzeigen.</i></span>';
}