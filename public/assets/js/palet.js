 $(function () {

  /*console.log($('select[name=palet]').val());
  */
  $('select').on('change', function() {
    if(this.value=='custompalet'){
      //$("#custompaletx").removeAttr("style");
    }else{
      //$("#custompaletx").attr("style", "display:none");
    }
  });
/*
$( "#palet" ).change(function() {
 if(this.value='custompalet'){
    $("#custompaletx").removeAttr("style");
  }else{
    $("#custompaletx").attr("style", "display:none");
  }
});*/
function myFunction(p1, p2) {
  return p1 * p2;
}

$("#btnTopla").on("click", function () {
  var temp = $("#palet option:selected").val();

  var width=Number($('#width').val());
  var length=Number($('#length').val());
  var height=Number($('#height').val());
  var customwidth=Number($('#customwidth').val());
  var customlength=Number($('#customlength').val());
  var loadingheight=2000;
  //Number($('#loadingheight').val());
  var eurowidth=800;
  var eurolength=1200;
  var standartwidth=1000;
  var standartlength=1100;


  var sonuc1=parseInt(1000/width);/*2*/
  var sonuc2=parseInt(1100/length);/*2*/

  var sonuc3 = parseInt(1000/length);/*1*/
  var sonuc4 = parseInt(1100/width);/*3*/
  var katman=parseInt(loadingheight/height);

 
  if (standartwidth<standartlength) {
    var kucuk = standartwidth;
  }else{
    var kucuk = standartlength;
  }

  for (var i = 0; i < kucuk; i++) {
    if ((standartwidth%i==0) && (standartlength%i==0)) {
      var obeb=i;
      var x1=parseInt(width/obeb);
      var x2=parseInt(length/obeb);
      var h1=parseInt(loadingheight/height);
       }
  }

  console.log(x1);
  console.log(x2);
      var a1=parseInt(standartwidth/width);
      var a2=parseInt(standartwidth/length);
      var a3=parseInt(standartlength/width);
      var a4=parseInt(standartlength/length);
      
      if ((a1*a2)<=(a3*a4)) {
         var kalan1 = (standartwidth-(length));
          var deger1 = parseInt(kalan1/width);
          if (a2==1) {
            var deger2 = parseInt(standartlength-(length*a2));
            if (deger2>length) {
              console.log("asdasdas");
            $('#katman').html("Katman Sayısı Toplamı : "+h1);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+((a3+a4))*h1);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((a3+a4)));
            }else{
              console.log("asdasdas");
            $('#katman').html("Katman Sayısı Toplamı : "+h1);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+((a3+deger1))*h1);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((a3+deger1)));
            }
        
          }else{
            var deger = parseInt(standartlength-length);
             var deger1 = parseInt(standartlength-(length*a1));
              var kalandeger = parseInt(deger/width);
              if (width==length) {
                console.log("xxxx111v111a1");
                $('#katman').html("Katman Sayısı Toplamı : "+h1);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+((a1*a2))*h1);
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((a1*a2)));
              }else if (width<length && a1>a2) {
                var deger1 = parseInt(standartlength-(width*a2));
                if (deger1>length) {
                  console.log("xxxx111v11adsadas1");
                $('#katman').html("Katman Sayısı Toplamı : "+h1);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+((a2*a2)+a1)*h1);
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((a2*a2)+a1));
                }
                
              }else{
                console.log("xxxx111v111");
                $('#katman').html("Katman Sayısı Toplamı : "+h1);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+((kalandeger*kalandeger)+x1)*h1);
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((kalandeger*kalandeger)+x1));
              }
          
          }
      }else{
        if(x2>x1){
        if (width>length) {
          var kalan = (standartlength-(x2*length));
          if (kalan>width && kalan>length) {
            var deger = parseInt(standartwidth/length);
            console.log("1");
            $('#katman').html("Katman Sayısı Toplamı : "+h1);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+((x2*x2)+deger)*h1);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((x2*x2)+deger));
          }
        }else{
          var kalan = (standartlength-(x2*width));
          var kalan1 = (standartlength-(x1*width));
          if (x1*width<standartlength) {
             if (kalan>width && kalan>length) {
              console.log(x1);
              console.log(x2);
              console.log("xxxx222a");
              var deger = parseInt(standartwidth/width);
              $('#katman').html("Katman Sayısı Toplamı : "+h1);
              $('#paket').html("Yüklenebilecek Paket Toplamı : "+((x2*x2)+deger)*h1);
              $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((x2*x2)+deger));
            }else{
              var deger = parseInt(standartlength-length);
              var kalandeger = parseInt(deger/width);
              var deger1 = parseInt(standartwidth-length);
              var kalandeger1 = parseInt(standartwidth/length);
              
              if (deger1>length) {
                console.log("xxxx111v111");
                $('#katman').html("Katman Sayısı Toplamı : "+h1);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+((kalandeger*kalandeger)+x1)*h1);
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((kalandeger*kalandeger)+x1));
              }else{
                console.log("xxxx111asdasv");
                $('#katman').html("Katman Sayısı Toplamı : "+h1);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+(kalandeger1+x1)*h1);
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+(kalandeger1+x1));
              }
            }
          }else{
              var deger = parseInt(standartlength/width);
              var deger1 = parseInt(standartwidth/length);
              console.log("xxxx111s");
              $('#katman').html("Katman Sayısı Toplamı : "+h1);
              $('#paket').html("Yüklenebilecek Paket Toplamı : "+((deger*deger1))*h1);
              $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((deger*deger1)+x1));
          }
         
        }

      }else{
        if (width>length) {
          var kalan = (standartlength-(x1*length));
          if (kalan>width && kalan>length) {
            console.log("3");
            var deger = parseInt(standartwidth/length);
            $('#katman').html("Katman Sayısı Toplamı : "+h1);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+((x1*x1)+deger)*h1);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((x1*x1)+deger));
          }else{
            var deger = parseInt(standartlength-width);
            var kalandeger = parseInt(deger/length);
            console.log("xxxx111");
            $('#katman').html("Katman Sayısı Toplamı : "+h1);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+((kalandeger*kalandeger)+x2)*h1);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((kalandeger*kalandeger)+x2));
          }
        }else if (width==length) {
          console.log("4");
            $('#katman').html("Katman Sayısı Toplamı : "+h1);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+((x1*x1))*h1);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((x1*x1)));
        }else{
          var kalan = (standartlength-(x2*width));
          if (kalan>width && kalan>length) {
            console.log("4");
            var deger = parseInt(standartwidth/width);
            $('#katman').html("Katman Sayısı Toplamı : "+h1);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+((x1*x1)+deger)*h1);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((x1*x1)+deger));
          }else{
            var deger = parseInt(standartlength-width);
            var kalandeger = parseInt(deger/length);
            console.log("xxxx111");
            $('#katman').html("Katman Sayısı Toplamı : "+h1);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+((kalandeger*kalandeger)+x2)*h1);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+((kalandeger*kalandeger)+x1));
          }
        }
      }
      }
     
   



  /*if (standartwidth>standartlength) {
    var buyuk = standartwidth;
  }else{
    var buyuk = standartlength;
  }

  for (var i = standartwidth*standartlength; i > buyuk; i--) {
    if ((i%standartwidth==0) && (i%standartlength==0)) {
      var okek=i;
      var x1=parseInt(okek/width);
      var x2=parseInt(okek/length);

      $('#katman').html("Katman Sayısı Toplamı : "+okek);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+x1);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+x2);
    }
  }*/























  /*if(temp=='europalet'){
    if((width*2)>eurowidth && (length*2)>eurolength ){
      //$('#kutuToplam').val("Girilen Sayıların Toplamı : "+length/width);
    }else{
      var sonuc1=parseInt(eurowidth/width);
      var sonuc2=parseInt(eurolength/length);
      var kalanyer=eurolength-(sonuc2*length);
      var sonuc4 = parseInt(customwidth/length);
      var sonuc5 = parseInt(customlength/width);

      console.log(kalanyer);
      if(kalanyer>=width){
        var kalansonuc=parseInt(eurowidth/length);
        var toplam=(sonuc1*sonuc2)+kalansonuc;
        

        var sonuc3=parseInt(loadingheight/height);

        //document.getElementById("katman").innerHTML="Katman Sayısı Toplamı : "+sonuc3;

        $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
        //document.getElementById("paket").innerHTML="Yüklenebilecek Paket Toplamı : "+sonuc3*toplam;


      }else{
        var toplam=(sonuc1*sonuc2);
        var toplam1=(sonuc4*sonuc5);

        if(toplam1>toplam){
          var sonuc3=parseInt(loadingheight/height);

          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);

        }
        else{
          var sonuc3=parseInt(loadingheight/height);

          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
        }
      }
      

    }

  }else if(temp=='standartpalet'){

    if((width*2)>standartwidth && (length*2)>standartlength ){
      //document.getElementById("kutuToplam").innerHTML="Girilen Sayıların Toplamı : "+length/width;
    }else{
      var sonuc1=parseInt(standartwidth/width);
      var sonuc2=parseInt(standartlength/length);
      var sonuc4 = parseInt(customwidth/length);
      var sonuc5 = parseInt(customlength/width);

      var kalanyer=standartlength-(sonuc2*length);
      console.log(kalanyer);
      if(kalanyer>=width){
        var kalansonuc=parseInt(standartwidth/length);
        var toplam=(sonuc1*sonuc2)+kalansonuc;
        //var loadingheight=Number(document.getElementById("loadingheight").value);

        var sonuc3=parseInt(loadingheight/height);

        $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);


      }else if((kalanyer+width)>=length){

        console.log("burası");

      }else{
        var toplam=(sonuc1*sonuc2);
        var toplam1=(sonuc4*sonuc5);

        if(toplam1>toplam){
          var sonuc3=parseInt(loadingheight/height);

          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);
        }
        else{
          var sonuc3=parseInt(loadingheight/height);

          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
        }
      }
      

    }


  }else{
  }*/


});



  /*var btn=document.getElementById("btnTopla");
  btn.onclick=function(){
   

    var singleValues = $( "#single" ).val();
    console.log($('select[name=palet]').val());

$('select').on('change', function() {
  alert( this.value );
});

$( "#palet" ).change(function() {
  console.log(this.value);
});
               
    


}*/


})