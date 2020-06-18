if((sonuc1*sonuc2) <= (sonuc3*sonuc4)){
    var toplam=(sonuc3*sonuc4);
    console.log("1.kosul");

    console.log(sonuc1);
    console.log(sonuc2);
    console.log(sonuc3);
    console.log(sonuc4);

    var kalanalan=(1000-(sonuc2*width));
    var kalanalan2=(1100-(sonuc2*width));
    var kalanalan3=(1000-(sonuc2*length));
    var kalanalan4=(1100-(sonuc2*length));
    if(kalanalan>width && kalanalan2>width){
      var toplam=((sonuc3*sonuc4)+1);
      console.log("1.kosul-1");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

    }else if((kalanalan3<width) && ((sonuc1*sonuc2) > (sonuc3*sonuc4))){
      var toplam = (sonuc2*sonuc4)+1;
      console.log("1.kosul-2");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

    }else if((kalanalan<0) && ((sonuc3*sonuc4) > (sonuc1*sonuc2))){
      console.log("1.kosul-3");
      var toplam = (sonuc2+sonuc3);
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }else if((kalanalan4>kalanalan3) && ((sonuc3*sonuc4) > (sonuc1*sonuc2))){
      console.log("1.kosul-4");
      var toplam = (sonuc2*sonuc4);
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }else if((kalanalan<kalanalan2) && ((sonuc1*sonuc2) == (sonuc3*sonuc4))){
      console.log("1.kosul-5");
      var toplam = (sonuc1*sonuc2)+1;
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }else if((kalanalan<0) && ((sonuc1*sonuc2) == (sonuc3*sonuc4))){
      console.log("1.kosul-6");
      var toplam = (sonuc1*sonuc2);
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }else if((kalanalan4<width) && ((sonuc1*sonuc3) < (sonuc2*sonuc4))){
      console.log("1.kosul-7");
      var toplam = (sonuc1+sonuc2);
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }else if((kalanalan4<width) && ((sonuc1*sonuc2) < (sonuc3*sonuc4))){
      console.log("1.kosul-8");
      var toplam = (sonuc2+sonuc3);
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }else if(((sonuc2*width)==(sonuc3*length)) && ((sonuc1*sonuc2) == (sonuc3*sonuc4))){
      var toplam = (sonuc2*sonuc4);
      console.log("1.kosul-9");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

    }else if((sonuc1>sonuc2) &&(sonuc3<sonuc4)) {
      var toplam = (sonuc1*sonuc2)+1;
      console.log("1.kosul-10");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }
  }else if ((sonuc3*sonuc4) < (sonuc1*sonuc2)) {
    var toplam=(sonuc1*sonuc2);
    console.log("2.kosul");
    var kalanalan=(1000-(sonuc1*length));
    var kalanalan2=(1100-(sonuc1*length));
    var kalanalan3=(1000-(sonuc2*length));
    var kalanalan4=(1100-(sonuc2*length));
    console.log(sonuc1);
    console.log(sonuc2);
    console.log(sonuc3);
    console.log(sonuc4);
    if(kalanalan>width && kalanalan2>width){
      var toplam=((sonuc2+1)*(sonuc1));
      console.log("2.kosul-1");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
    }else if(kalanalan3<kalanalan4 && ((sonuc3*sonuc4) < (sonuc1*sonuc2))){
      console.log("2.kosul-2");
      
    if(kalanalan>kalanalan2){
      var kalanlength = 1100-length;
      var yerlestir = parseInt(kalanlength/length);
      var yerlestir2 = parseInt(kalanlength/width);
      var deger = yerlestir*sonuc1; 
      var toplam= deger+sonuc3;
      if (yerlestir2<yerlestir) {
        var deger = yerlestir2*sonuc3; 
        var toplam= deger+sonuc4;
        console.log("3.kosul-1");
        $('#katman').html("Katman Sayısı Toplamı : "+katman);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
      }
      
      console.log("3.kosul");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

    }else{
      var kalanlength = 1100-length;
      var yerlestir = parseInt(kalanlength/width);
      var deger = yerlestir*sonuc2; 
      var toplam= sonuc1+sonuc4;
      console.log("4.kosul");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

    }

    }else if(kalanalan3<width){
      console.log("2.kosul-3");
      var toplam = (sonuc2+sonuc4);
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

    }
    $('#katman').html("Katman Sayısı Toplamı : "+katman);
    $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
    $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
  }else {
    var kalanalan=(1000-(sonuc1*width));
    var kalanalan2=(1000-(sonuc2*length));
    var kalanalan3=(1000-(sonuc3*length));
    if(kalanalan>kalanalan2){
      var kalanlength = 1100-length;
      var yerlestir = parseInt(kalanlength/length);
      var yerlestir2 = parseInt(kalanlength/width);
      var deger = yerlestir*sonuc1; 
      var toplam= deger+sonuc3;
      if (yerlestir2<yerlestir) {
        var deger = yerlestir2*sonuc3; 
        var toplam= deger+sonuc4;
        console.log("3.kosul-1");
        $('#katman').html("Katman Sayısı Toplamı : "+katman);
        $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
        $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);
      }
      console.log("3.kosul");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

    }else{
      var kalanlength = 1100-length;
      var yerlestir = parseInt(kalanlength/width);
      var deger = yerlestir*sonuc2; 
      var toplam= deger+sonuc1;
      console.log("4.kosul");
      $('#katman').html("Katman Sayısı Toplamı : "+katman);
      $('#paket').html("Yüklenebilecek Paket Toplamı : "+katman*toplam);
      $('#paketsayisi').html("Yüklenebilecek Paket Sayısı : "+toplam);

    }
  }