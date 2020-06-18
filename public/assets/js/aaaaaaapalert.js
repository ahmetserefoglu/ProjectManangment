 $(function () {

  /*console.log($('select[name=palet]').val());
  */
  $('select').on('change', function() {
    if(this.value=='custompalet'){
      $("#custompaletx").removeAttr("style");
    }else{
      $("#custompaletx").attr("style", "display:none");
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


$("#btnTopla").on("click", function () {
  var temp = $("#palet option:selected").val();

  var width=Number($('#width').val());
  var length=Number($('#length').val());
  var height=Number($('#height').val());
  var customwidth=Number($('#customwidth').val());
  var customlength=Number($('#customlength').val());
  var loadingheight=Number($('#loadingheight').val());
  var eurowidth=800;
  var eurolength=1200;
  var standartwidth=1000;
  var standartlength=1100;


  if(temp=='europalet'){
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



    if((width*2)>customwidth && (length*2)>customlength ){
      var sonuc1=parseInt(customwidth/width);
      var sonuc2=parseInt(customlength/length);

      var sonuc4 = parseInt(customwidth/length);
      var sonuc5 = parseInt(customlength/width);

      var kalanyer=customlength-(sonuc2*length);
      var kalanyer2=customwidth-(sonuc1*width);

      if(kalanyer<width && kalanyer<length){
        console.log('Tek Bir Adet');
        var toplam=sonuc1;
        var sonuc3=parseInt(loadingheight/height);

        $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
      }
      //document.getElementById("kutuToplam").innerHTML="Girilen Sayıların Toplamı : "+length/width;
      
    }else{
      console.log("burası");
      var sonuc1=parseInt(customwidth/width);
      var sonuc2=parseInt(customlength/length);

      var sonuc4 = parseInt(customwidth/length);
      var sonuc5 = parseInt(customlength/width);

      var kalanyer=customlength-(sonuc2*length);

      if((sonuc1*sonuc2)>=(sonuc4*sonuc5)){

        console.log(kalanyer);
        if(kalanyer>=width){
          if((width+length)<customwidth && (width+length)<customlength){

            console.log("buras");
            console.log(sonuc1);

            var a1= customlength-(sonuc2*length);
        if(a1>width){
          var cz = parseInt(customlength/width);
          var aaa= (sonuc1*sonuc2)+cz;
          var sonuc3=parseInt(loadingheight/height);
          console.log("sadasdas asdasda");
          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
        }else{
          
          //var kalansonuc=parseInt(customwidth/length);
          var toplam=parseInt((parseInt((customwidth/(width+length))*2)+parseInt((customlength/(width+length))*2)));
          //var loadingheight=Number(document.getElementById("loadingheight").value);
          console.log(toplam);
          var sonuc3=parseInt(loadingheight/height);

          console.log(sonuc3);

          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
        }


        }else{
          console.log("burassonuscdss");
          var kalansonuc=parseInt(customwidth/length);
          var toplam=(sonuc1*sonuc2)+kalansonuc;
        //var loadingheight=Number(document.getElementById("loadingheight").value);

        var sonuc3=parseInt(loadingheight/height);

        
        
        $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
      }


    }else if((kalanyer+width)>=length){

      console.log("burası asdasd");

      if(sonuc2>sonuc1){


        console.log("burası asdaasdasdsasd");
        var kalanwidth=parseInt(customwidth/width);

        var toplam=(sonuc1*sonuc2);
        var toplam1=(sonuc4*sonuc5);

        if(toplam1>toplam){
          if(sonuc5>sonuc2){
            console.log("sadasdas asdasda");
            var sonuc3=parseInt(loadingheight/height);

            $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
            $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
            $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
          }else{
            console.log("burası asdasd");

            console.log("burassonusc");

            var kalansonuc=parseInt(customwidth/width);
            console.log(kalansonuc);
            console.log(sonuc2);
            console.log(sonuc1);
            var toplamx=(sonuc2*sonuc1)+kalansonuc+sonuc1;
        //var loadingheight=Number(document.getElementById("loadingheight").value);

        var sonuc3=parseInt(loadingheight/height);

        
        
        $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplamx);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplamx);
      }

    }else{

      var deger = customwidth-(width*sonuc1);

      if(deger>length){

        var x1 = parseInt(deger/length);  

        var sonuc3=parseInt(loadingheight/height);

        var paketsayisi=toplam+x1;
        $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*(toplam+x1));
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+paketsayisi);
        
      }else{

        console.log(sonuc1);
        console.log(sonuc2);
        console.log(sonuc4);
        console.log(sonuc5);


            var a1= customlength-(sonuc5*length);


        if(a1>length){
          var cz = parseInt(customlength/length);
          var az = parseInt(a1/length);

          
          var bz = customlength-((sonuc5-1)*width);
          if(bz>width){
            var xz = bz/length;
            var aaa= (sonuc1*xz)+(sonuc4*xz);
          var sonuc3=parseInt(loadingheight/height);
          console.log("sadasdas asdasda");

          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
          }else{
            var aaa= (sonuc1*sonuc2)+az;
          var sonuc3=parseInt(loadingheight/height);
          console.log("sadasdas asdasda");
          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
          }
          
        }else{
           console.log("sadasdas asdasda");
        var sonuc3=parseInt(loadingheight/height);

        $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

        }





       
      }

    }

  }else{

    console.log("burası asdaasdasdsasd");
    var kalanwidth=parseInt(customwidth/width);

    var toplam=((sonuc1-1)*(sonuc2))+kalanwidth;
    var toplam1=(sonuc4*sonuc5);

    if(toplam1>toplam){
      var sonuc3=parseInt(loadingheight/height);

      $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);
    }else{
      var sonuc3=parseInt(loadingheight/height);

      $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }

  }



}else{

  console.log("burası");

  var toplam=(sonuc1*sonuc2);
  var toplam1=(sonuc4*sonuc5);

  if(toplam1>toplam){
    var sonuc3=parseInt(loadingheight/height);

    $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
    $('#paket').html("Yüklenebilecek Paket Toplamıx : "+sonuc3*toplam1);
    $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
  }else{
    console.log("buras");
    console.log(sonuc1);
          //var kalansonuc=parseInt(customwidth/length);
          var xx=parseInt(customwidth/(width));
          var yy=parseInt(customwidth/(length));

          var zz = customwidth-(xx*width);
          var tt = customwidth-(yy*length);
          if (zz>tt) {
            console.log("asdasd");
            var s1=parseInt(customlength/length);
            var s2=parseInt(customwidth/length);

            var aa =customlength-( xx*width);

            if(aa> width){

              console.log("bakıp görecez");

            }else{

              var bb= parseInt(customwidth/width);
              var ss = (s1*s2)+bb;

              var sonuc3=parseInt(loadingheight/height);

              console.log(sonuc3);

              $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
              $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*ss);
              $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+ss);

            }

          }else{
            if(toplam1>toplam){
              var sonuc3=parseInt(loadingheight/height);

              $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
              $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
              $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);
            }else{
              var sonuc3=parseInt(loadingheight/height);

              $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
              $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
              $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
            }
          }
          
        }
        //var loadingheight=Number(document.getElementById("loadingheight").value);


      }
    }else{

      console.log("burası");

      var toplam=(sonuc1*sonuc2);
      var toplam1=(sonuc4*sonuc5);

      if(toplam1>toplam){

        console.log("sadasdas asdasda");

        console.log(sonuc1);
        console.log(sonuc2);
        console.log(sonuc4);
        console.log(sonuc5);
        var a1= customlength-(sonuc2*width);
        if(a1>length){
          var aaa= ((sonuc5-1)*sonuc2)+sonuc1;
          var sonuc3=parseInt(loadingheight/height);
          console.log("sadasdas asdasda");
          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
        }else{
          var sonuc3=parseInt(loadingheight/height);
          console.log("sadasdas asdasda");
          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);
        }

      }else{
        console.log("buras");
        console.log(sonuc1);
          //var kalansonuc=parseInt(customwidth/length);
          var xx=parseInt(customwidth/(width));
          var yy=parseInt(customwidth/(length));

          var zz = customwidth-(xx*width);
          var tt = customwidth-(yy*length);
          if (zz>tt) {
            console.log("asdasd");
            var s1=parseInt(customlength/length);
            var s2=parseInt(customwidth/length);

            var aa =customlength-( xx*width);

            if(aa> width){

              console.log("bakıp görecez");

            }else{
              console.log("asdasd");
              var a1= customlength-(sonuc1*length);
              if(a1>length){
                var aaa= ((sonuc2-1)*sonuc1)+sonuc2;
                var sonuc3=parseInt(loadingheight/height);

                $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
              }else{

                var bb= parseInt(customwidth/width);
                var ss = (s1*s2)+bb;

                var sonuc3=parseInt(loadingheight/height);

                console.log(sonuc3);

                $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*ss);
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+ss);
              }


            }

          }else{
            if(toplam1>toplam){
              var sonuc3=parseInt(loadingheight/height);
              console.log("asdasd");
              $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
              $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
              $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);
            }else{
              var deger = customwidth-(width*sonuc1);

              if(deger>length){

                var x1 = parseInt(deger/length);  

                var sonuc3=parseInt(loadingheight/height);

                var paketsayisi=toplam+x1;
                $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*(toplam+x1));
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+paketsayisi);

              }else{

                console.log("sadasdas asdasda");

                console.log(sonuc1);
                console.log(sonuc2);
                console.log(sonuc4);
                console.log(sonuc5);
                var a1= customlength-(sonuc2*width);
                if(a1>length){
                  var aaa= ((sonuc5-1)*sonuc2)+sonuc5;
                  var sonuc3=parseInt(loadingheight/height);

                  $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
                  $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
                  $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
                }else{
                  var sonuc3=parseInt(loadingheight/height);

                  $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
                  $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam);
                  $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
                }






              }
            }
          }
          
        }

      }


    }


  }


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