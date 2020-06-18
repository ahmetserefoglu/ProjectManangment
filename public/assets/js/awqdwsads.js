



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
      

      var sonuc1=parseInt(1000/width);
      var sonuc2=parseInt(1100/length);

      var sonuc3 = parseInt(1000/length);
      var sonuc4 = parseInt(1100/width);
      var katman=parseInt(loadingheight/height);

      if((sonuc1*sonuc2) < (sonuc3*sonuc4)){
        var toplam=(sonuc3*sonuc4);
        console.log("1.kosul");
        $('#katman').html("Katman Sayısı Toplamı : "+katman);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
      }else if ((sonuc3*sonuc4) < (sonuc1*sonuc2)) {
        var toplam=(sonuc1*sonuc2);
        console.log("2.kosul");
        $('#katman').html("Katman Sayısı Toplamı : "+katman);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
      }else {


      console.log("burası");
      var sonuc1=parseInt(1000/width);
      var sonuc2=parseInt(1100/length);

      var sonuc4 = parseInt(1000/length);
      var sonuc5 = parseInt(1100/width);

      var kalanyer=1100-(sonuc2*length);

      if((sonuc1*sonuc2)>=(sonuc4*sonuc5)){

        console.log(kalanyer);
        if(kalanyer>=width){
          if((width+length)<1000 && (width+length)<1100){

            console.log("buras");
            console.log(sonuc1);

            var a1= 1100-(sonuc2*length);
        if(a1>width){
          var cz = parseInt(1100/width);
          var aaa= (sonuc1*sonuc2)+cz;
          var sonuc3=parseInt(loadingheight/height);
          console.log("sadasdas asdasda");
          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
        }else{
          
          //var kalansonuc=parseInt(customwidth/length);
          var toplam=parseInt((parseInt((customwidth/(width+length))*2)+parseInt((1100/(width+length))*2)));
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
          var toplam=(sonuc1*sonuc2)+1000;
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
        var kalanwidth=parseInt(1000/width);

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

            var kalansonuc=parseInt(1000/width);
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

      var deger = 1000-(width*sonuc1);

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
           if((sonuc1*sonuc2)>=(sonuc4*sonuc5)){

             var toplama=((sonuc1)*(sonuc2));
    var toplam1=(sonuc4*sonuc5);

    if(toplam1>toplama){
      var sonuc3=parseInt(loadingheight/height);
console.log("burası asdaasdasdsasd");
      $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);
    }else{

      if(bz>width){


      console.log("burası asdaasdasdsasd");
    var kalanwidth=parseInt(1000/length);

    var toplam=((sonuc4-1)*(sonuc2))+kalanwidth;
    var toplam1=(sonuc4*sonuc5);

    if(toplam1>toplam){
      if((sonuc1*sonuc2)==(sonuc4*sonuc5)){
        var sonuc3=parseInt(loadingheight/height);
console.log("burası asdaasdasdsasd");
      $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);
      }
    }else{
      var sonuc3=parseInt(loadingheight/height);
console.log("burası asdaasdasdsasd");
      $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplama);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplama);
    }

          }else{
            var aaa= (sonuc1*sonuc2)+az;
          var sonuc3=parseInt(loadingheight/height);
          console.log("sadasdas asdasda");
          $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
          $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
          $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
          }

      
    }


           }else{
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
    var kalanwidth=parseInt(1000/width);

    var toplam=((sonuc1-1)*(sonuc2))+kalanwidth;
    var toplam1=(sonuc4*sonuc5);

    if(toplam1>toplam){
      var sonuc3=parseInt(loadingheight/height);
console.log("burası asdaasdasdsasd");
      $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*toplam1);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam1);
    }else{
      var sonuc3=parseInt(loadingheight/height);
console.log("burası asdaasdasdsasd");
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
          var xx=parseInt(1000/(width));
          var yy=parseInt(1000/(length));

          var zz = 1000-(xx*width);
          var tt = 1000-(yy*length);
          if (zz>tt) {
            console.log("asdasd");
            var s1=parseInt(1100/length);
            var s2=parseInt(1000/length);

            var aa =1100-( xx*width);

            if(aa> width){

              console.log("bakıp görecez");

            }else{

              var bb= parseInt(1000/width);
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
        var a1= 1100-(sonuc2*width);
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
          var xx=parseInt(1000/(width));
          var yy=parseInt(1000/(length));

          var zz = 1000-(xx*width);
          var tt = 1000-(yy*length);
          if (zz>tt) {
            console.log("asdasd");
            var s1=parseInt(1100/length);
            var s2=parseInt(1000/length);

            var aa =1100-( xx*width);

            if(aa> width){

              console.log("bakıp görecez");

            }else{
              console.log("asdasd");
              var a1= 1100-(sonuc1*length);
              if(a1>length){
                var aaa= ((sonuc2-1)*sonuc1)+sonuc2;
                var sonuc3=parseInt(loadingheight/height);

                $('#katman').html("Katman Sayısı Toplamı : "+sonuc3);
                $('#paket').html("Yüklenebilecek Paket Toplamı : "+sonuc3*aaa);
                $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+aaa);
              }else{

                var bb= parseInt(1000/width);
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
              var deger = 1000-(width*sonuc1);

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
                var a1= 1100-(sonuc2*width);
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