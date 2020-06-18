
var app = angular.module('ogrenciRecords', ['angularUtils.directives.dirPagination']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('ogrenciController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true; }, 1000);

        $scope.ekle = function () {
           $scope.resetForm();
            $scope.modalstate = 'ekle';
            $scope.buttonDurum = 'Kaydet';
            $scope.page_title='Öğrenci Ekle';
            $("#frmOgrenci").show();
            $("#frmOgrenciList").hide();
            $("#paginate").hide();
        }

    //.öğrencileri Listele
    $scope.loadOgrenci = function () {
        $http.get('/api/v1/ogrenci')
        .then(function success(e) {
            console.log(e.data);
            $scope.ogrenciler = e.data.ogrenciler;
            $scope.okullar = e.data.okullar;
            $scope.siniflar = e.data.sinif;
            $scope.sehirler = e.data.sehirler;
            $scope.length = e.data.length;
            $scope.satirSayisi = 5;
        });



    };
    
    $scope.loadOgrenci();

    $scope.resetForm = function () {
    $scope.errors = [];
       $scope.ogrencim = {
        TCKimlikNo: '',
        Adi: '',
        IkinciAdi: '',
        Soyadi: '',
        Tarih: $('#datemask2').val(),
        DogumYeri: '',
        Cinsiyeti: '',
        BabaAdi: '',
        AnneAdi: '',
        password: ''
    };
        $scope.frmOgrenciKontrol.$setPristine();
        $scope.frmOgrenciKontrol.$setUntouched();              
    };

    //İptal Et
    $scope.iptal=function(){
        $("#frmOgrenci").hide();
        $("#frmOgrenciList").show();
        $("#paginate").show();
    }

    $scope.errors = [];

// Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Öğrenci Düzenle';
        $scope.buttonDurum = 'Güncelle';
        $scope.id = id;
        $("#frmOgrenci").show();
        $("#frmOgrenciList").hide();
        $("#paginate").hide();
        $http.get('/api/v1/ogrenci/'+id)
        .then(function success(e) {
            console.log(e.data);
            $scope.ogrencim = e.data.ogrenci;
            $scope.okullar = e.data.okullar;
            $scope.siniflar = e.data.sinif;
            $scope.sehirler = e.data.sehirler;
        });
    };
    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/api/v1/ogrenci";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }
         
         /*
           var data = {
                TCKimlikNo: $scope.TCKimlikNo,
                Adi: $scope.Adi,
                IkinciAdi: $scope.IkinciAdi,
                Soyadi: $scope.Soyadi,
                Tarih: $scope.Tarih,
                DogumYeri: $scope.CityName,
                Cinsiyeti: $scope.Cinsiyeti,
                BabaAdi: $scope.BabaAdi,
                AnneAdi: $scope.AnneAdi,
                OkulAdi: $scope.OkulAdi,
                Sinif: $scope.SinifAdi,
                password: $scope.password
            };
         */
        console.log($.param($scope.ogrencim));
        $http({
            method: method,
            url: url,
            data: $.param($scope.ogrencim),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
            $scope.messageSuccess(response.data.message);
            $scope.loadOgrenci();
        },function (error) {
            $scope.messageError(error.data.message);
            $scope.recordErrors(error);
        });
    };

    

     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/ogrenci/' + id
            }).
            then(function (response) {
               $scope.messageSuccess(response.data.message);
               $scope.loadOgrenci();

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
        

        if (error.data.errors.TCKimlikNo) {
            $scope.errors.push(error.data.errors.TCKimlikNo[0]);
        }

        if (error.data.errors.Adi) {
            $scope.errors.push(error.data.errors.Adi[0]);
        }

        if (error.data.errors.IkinciAdi) {
            $scope.errors.push(error.data.errors.IkinciAdi[0]);
        }

        if (error.data.errors.Soyadi) {
            $scope.errors.push(error.data.errors.Soyadi[0]);
        }

        if (error.data.errors.Tarih) {
            $scope.errors.push(error.data.errors.Tarih[0]);
        }

        if (error.data.errors.DogumYeri) {
            $scope.errors.push(error.data.errors.DogumYeri[0]);
        }

        if (error.data.errors.Cinsiyeti) {
            $scope.errors.push(error.data.errors.Cinsiyeti[0]);
        }

        if (error.data.errors.BabaAdi) {
            $scope.errors.push(error.data.errors.BabaAdi[0]);
        }

        if (error.data.errors.AnneAdi) {
            $scope.errors.push(error.data.errors.AnneAdi[0]);
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
            $("#frmOgrenci").hide();
            $("#frmOgrenciList").show();
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
