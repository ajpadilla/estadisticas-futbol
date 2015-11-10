var ventana=0;
      function popup(nl, ft) {
        ventana=1;
       $( "#somediv" ).empty();
       var ale = Math.round(Math.random()*9999);
      $("#somediv").load('generador.php?id='+nl+'&ft='+ft+'&al='+ale).dialog({
       modal:true
        });
     $( "#somediv" ).css({"top": "5%", "left": "5%", "display": ""});
        }
        
 jQuery.ajaxSetup({ cache: false });
  
 setInterval("loadJSON()",25000);
 
function elsonido() {
window.location.href = "sonido.php";
};
 
 function haygol(id) {
   $(id).css({"background": "red", "color": "white"});
    setTimeout(function() {
          $(id).css({"background": "white", "color": "black"});
    },20000);
}

function canal(elcanal) {
    if (elcanal=='2') {
    return ' <img src="images/canales/americatv.png" />';    
    } else if (elcanal=='9') {
     return ' <img src="images/canales/canal9.png" />';      
    } else if (elcanal=='17') {
    return ' <img src="images/canales/tycsports.png" />';       
    } else if (elcanal=='15') {
    return ' <img src="images/canales/tvpublica.png" />';       
    } else if (elcanal=='40') {
    return ' <img src="images/canales/deportv.png" width="15px" />';       
    } else if (elcanal=='18') {
    return ' <img src="images/canales/fox2.png" />';       
    }else if (elcanal=='26') {
      return ' <img src="images/canales/canal26.png" />';      
    }else if (elcanal=='11') {
      return ' <img src="images/canales/telefe.png" />';      
    }else if (elcanal=='4') {
      return ' <img src="images/canales/cronica.png" />';      
    }   else {
     return '';    
    }
}



function loadJSON()
{  
     
 /*$.getJSON("scores.json",function(jso){ 

    $.each(jso.pa, function( uno ) {
      
      if (jso.pa[uno].st!=0 && jso.pa[uno].pe!=1) {
      var rant1 = $("#r1_"+jso.pa[uno].li+"_"+jso.pa[uno].id).text();
       var rant2 = $("#r2_"+jso.pa[uno].li+"_"+jso.pa[uno].id).text();
       
        if ((jso.pa[uno].r1!==rant1 || jso.pa[uno].r2!==rant2) && ventana==1) {
        recargar();    
        }
       
       $( "#r1_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).text( jso.pa[uno].r1 );
       $( "#r2_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).text( jso.pa[uno].r2 );
       if (jso.pa[uno].r1 > 0 && jso.pa[uno].r1 > rant1 && rant1) {
         haygol("#r1_"+jso.pa[uno].li+"_"+jso.pa[uno].id); 
         if (sonido==1) {
         var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'images/gol.mp3'); 
        audioElement.play();
         }
            
       }
      if (jso.pa[uno].r2 > 0 && jso.pa[uno].r2 > rant2 && rant2) {
         haygol("#r2_"+jso.pa[uno].li+"_"+jso.pa[uno].id); 
         if (sonido==1) {
         var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'images/gol.mp3'); 
        audioElement.play();
         }
       }

       }
       
       if (jso.pa[uno].pe==1) {
       $( "#r1_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( jso.pa[uno].r1 );
        $( "#r1_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html("<span style='font-size:11px;'>"+jso.pa[uno].r1+"</span><span style='color:red;font-size:11px;'>("+jso.pa[uno].p1+")</span>" );
       $( "#r2_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html("<span style='font-size:11px;'>"+jso.pa[uno].r2+"</span><span style='color:red;font-size:11px;'>("+jso.pa[uno].p2+")</span>"  ); 
       }
       
     
       if (jso.pa[uno].g1 !== '' || jso.pa[uno].g2 !== '') {
       $( "#gole_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).css('display', ''); 
     $( "#g1_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( jso.pa[uno].g1 );
      $( "#g2_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( jso.pa[uno].g2 );
       }
      
       if (jso.pa[uno].st==1 || jso.pa[uno].st==2 || jso.pa[uno].st==3 || jso.pa[uno].st==5 || jso.pa[uno].st==9 || jso.pa[uno].st==11) {
    
    $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).css('background', '#820300'); 
    
       if (jso.pa[uno].st==2) {
       $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( "E. T."+canal(jso.pa[uno].ca) );
       } else if (jso.pa[uno].st==5) {
       $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).text( "Susp.");
       } else if (jso.pa[uno].st==9) {
       $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( "Pen."+canal(jso.pa[uno].ca) );
       } else if (jso.pa[uno].st==11) {
       $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( "T.S."+canal(jso.pa[uno].ca) );
       } else {
        if (jso.pa[uno].li==5 || jso.pa[uno].li==6) {
        $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( "Jugando" );     
        } else {
       $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( jso.pa[uno].ti+"'"+canal(jso.pa[uno].ca) ); 
       }
       }
       }
         
       if (jso.pa[uno].st==4 || jso.pa[uno].st==8) {
         $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).css('background', '#222');
         $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).text( "Final" );  
       }
       
        if (jso.pa[uno].st==0) {
         $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).css('background', '#155219'); 
         $( "#ti_"+jso.pa[uno].li+"_"+jso.pa[uno].id ).html( jso.pa[uno].ti+" "+canal(jso.pa[uno].ca) );
       }
     
   
     });

  
    }); */
        
}   