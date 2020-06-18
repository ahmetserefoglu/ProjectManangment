
var app = angular.module('okulOgretmenRecords', ['angularUtils.directives.dirPagination']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);

app.controller('okulOgretmenController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true;  }, 1000);

        $scope.ekle = function () {
         $scope.resetForm();
         $scope.buttonDurum='Kaydet';
         $scope.modalstate = 'ekle';
         $scope.page_title='Öğretmen Ekle';
         $("#frmOgretmen").show();
         $("#frmOgretmenList").hide();
         $("#frmDetayList").hide();
         $("#paginate").hide();
         $("#btnEkle").hide();
         $("#frmOgretmenDetay").hide();
     }

    //Kullanıcıları Listele
    $scope.loadOkulPlanlama = function () {
        $("#frmDetayList").hide();
        $http.get('/api/v1/okulplanlama')
        .then(function success(e) {
            //onsole.log(e.data);
            $scope.okullarx = e.data.okul;
            $scope.satirSayisi = 10;
        });

    };
    
    $scope.loadOkulPlanlama();

    $scope.okul="";
    $( "#okuldurum" ).change(function() {

        $scope.okul=this.value;
      $http.get('/api/v1/okulplanlama/'+this.value)
      .then(function success(e) {
        console.log(e.data);
        $scope.okullar = e.data.okul;
        $scope.okulogretmen = e.data.okulogretmen;
        $scope.sehirler=e.data.sehirler;
        $scope.branslar = e.data.brans;
        $scope.okulogretmen = e.data.ogretmen;
        $scope.okulogrenci = e.data.ogrenci;
        $scope.okulveli = e.data.veli;
        $scope.okulders = e.data.ders;
        $scope.okulsinif = e.data.sinif; 

    });
  });



    $scope.ogretmenlerdetay=function (id) {
        $("#frmOgretmenlerDetayList").removeAttr('style');
        $http.get('/api/v1/okulplanlama/'+id)
        .then(function success(e) {

            $scope.ogretmenler = e.data.ogretmen;
        });
    }

    $scope.ogrencilerdetay=function (id) {
        $("#frmOgrencilerDetayList").removeAttr('style');
        $http.get('/api/v1/okulplanlama/'+id)
        .then(function success(e) {
            $scope.ogrenciler = e.data.ogrenci;
        });
    }

    $scope.velilerdetay=function (id) {
        $("#frmVelilerDetayList").removeAttr('style');
         $http.get('/api/v1/okulplanlama/'+id)
        .then(function success(e) {
            $scope.veliler = e.data.veli;
        });
    }

     $scope.subelerdetay=function (id) {
        $("#frmSubelerDetayList").removeAttr('style');
         $http.get('/api/v1/okulplanlama/'+id)
        .then(function success(e) {
            $scope.siniflar = e.data.sinif;
        });
    }

    $scope.resetForm = function () {
        $scope.errors = [];
        $scope.ogretmen = {
            AdiSoyadi: '',
            TelefonUlkeKodu: '',
            TelefonNo: '',
            password: '',
            Resim:'',

        };
        $scope.frmOgretmenKontrol.$setPristine();
        $scope.frmOgretmenKontrol.$setUntouched();              
    };

    //İptal Et
    $scope.iptal=function(){
        $("#frmOgretmen").hide();
        $("#frmOgretmenList").show();
        $("#paginate").show();
        $("#btnEkle").show(); 
    }

    $scope.errors = [];

    var formData = new FormData();

    $scope.setTheFiles = function ($files) {

     angular.forEach($files, function (value, key) {
        $scope.ogretmen.Resim=value.name;
        formData.append('image_file[]', value);
    });

 };


    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/api/v1/ogretmen";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }

        $http({
            method: method,
            url: url,
            data: $.param($scope.ogretmen),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
            //$scope.uploadFile(response.data.ogretmenid);
            $scope.messageSuccess(response.data.message);
            $scope.loadOgretmen();
        },function (error) {
            $scope.messageError(error.data.message);
            $scope.recordErrors(error);
        });
    };

    // Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Öğretmen Düzenle';
        $scope.buttonDurum='Güncelle';
        $scope.id = id;
        $("#frmOgretmen").show();
        $("#frmOgretmenList").hide();
        $("#paginate").hide();
        $("#btnEkle").hide();
        $("#frmOgretmenDetay").hide();
        $http.get('/api/v1/ogretmen/'+id)
        .then(function success(e) {
            $scope.ogretmen = e.data.ogretmen;
            $scope.okullar = e.data.okullar;
            $scope.branslar = e.data.brans;
            $scope.sehirler = e.data.sehirler;
        });
    };

    // Kullanıcı Düzenle
    $scope.detay = function (id) {
        //$scope.modalstate = 'detay';
        $scope.page_title='Öğretmen Düzenle';
        $scope.id = id;
        $("#frmOgretmen").hide();
        $("#frmOgretmenList").hide();
        $("#paginate").hide();
        $("#frmOgretmenDetay").show();
        $("#btnEkle").hide();
        $http.get('/api/v1/ogretmen/'+id)
        .then(function success(e) {
            //console.log(e.data);
            $scope.ogretmen = e.data.ogretmen;
        });
    };

     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/ogretmen/' + id
            }).
            then(function (response) {
             $scope.messageSuccess(response.data.message);
             $scope.loadOgretmen();

         },function (error) {
            $scope.messageError('Kayit Silinirken Hata Oluştu');
        });
        } else {
            return false;
        }
    }

    //Hatalar
    $scope.recordErrors = function (error) {
        $scope.errors = [];
        $(".alert-warning").removeAttr("style");
        if (error.data.errors.AdiSoyadi) {
            $scope.errors.push(error.data.errors.AdiSoyadi[0]);
        }

        if (error.data.errors.TelefonUlkeKodu) {
            $scope.errors.push(error.data.errors.TelefonUlkeKodu[0]);
        }

        if (error.data.errors.TelefonNo) {
            $scope.errors.push(error.data.errors.TelefonNo[0]);
        }

        if (error.data.errors.password) {
            $scope.errors.push(error.data.errors.password[0]);
        }
    };

    //Başarılı Mesalar
    $scope.messageSuccess=function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $(".alert-success").removeAttr("style");
        $('.alert-success').delay(2000).slideUp(function(){
            $('.alert-success > p').html('');
            $("#frmOgretmen").hide();
            $("#frmOgretmenList").show();
            $("#frmOgretmenDetay").hide();
            $("#btnEkle").show();
            $("#paginate").show();
        });
    };

    //Hata Mesajlar
    $scope.messageError=function(msg){
        $('.alert-danger > p').html(msg);
        $('.alert-danger').show();
        $(".alert-danger").removeAttr("style");
        $('.alert-danger').delay(2000).slideUp(function(){
            $('.alert-danger > p').html('');
        });
    };
});



}]);


app.directive('ngFiles', ['$parse', function ($parse) {

    function file_links(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function (event) {
            //console.log(event.target.files);
            onChange(scope, {$files: event.target.files});

            //console.log(event);

        });
    }

    return {
        link: file_links
    }
}]);