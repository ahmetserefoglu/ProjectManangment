
var app = angular.module('okulVeliRecords', ['angularUtils.directives.dirPagination']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);

app.controller('okulVeliController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true;  }, 1000);

        $scope.ekle = function () {
            $scope.resetForm();
            $scope.modalstate = 'ekle';
            $scope.buttonDurum = 'Kaydet';
            $scope.page_title='Veli Ekle';
            $("#frmVeli").show();
            $("#frmVeliList").hide();
            $("#paginate").hide();
            $("#btnEkle").hide();
        }

    //Kullanıcıları Listele
    $scope.loadUsers = function () {
        $http.get('/api/v1/okulveli')
        .then(function success(e) {
            console.log(e.data);
            $scope.veliler = e.data.veli;
            $scope.okullar = e.data.okul;
            $scope.satirSayisi = 5;
        });



    };
    
    $scope.loadUsers();

    $( "#okuldurum" ).change(function() {

      $http.get('/api/v1/okulveli/'+this.value)
      .then(function success(e) {
        //console.log(e.data);
        $scope.okullar = e.data.okul;
        $scope.okulogretmen = e.data.okulogretmen;
        $scope.sehirler=e.data.sehirler;
        $scope.branslar = e.data.brans;
        $scope.length = e.data.length;
        $scope.satirSayisi = 10;
    });
  });

    $scope.resetForm = function () {
    $scope.errors = [];
       $scope.veli = {
        AdiSoyadi: '',
        TelefonUlkeKodu: '',
        TelefonNo: '',
        password: ''
    };
        $scope.frmVeliKontrol.$setPristine();
        $scope.frmVeliKontrol.$setUntouched();              
    };

    //İptal Et
    $scope.iptal=function(){
         //$scope.resetForm();
        $("#frmVeli").hide();
        $("#frmVeliList").show();
        $("#paginate").show();
        $("#btnEkle").show(); 
    }

    $scope.errors = [];

    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/api/v1/veliler";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }
        $http({
            method: method,
            url: url,
            data: $.param($scope.veli),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
            $scope.messageSuccess(response.data.message);
            $scope.loadUsers();
        },function (error) {
            $scope.messageError(error.data.message);
            $scope.recordErrors(error);
        });
    };

    // Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Veli Düzenle';
         $scope.buttonDurum = 'Güncelle';
        $scope.id = id;
        $("#frmVeli").show();
        $("#frmVeliList").hide();
        $("#paginate").hide();
        $("#btnEkle").hide();
        $http.get('/api/v1/veliler/'+id)
        .then(function success(e) {
            console.log(e.data)
            $scope.veli = e.data.veli;
            $scope.ogrenciler = e.data.ogrenci;
        });
    };

     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/veliler/' + id
            }).
            then(function (response) {
             $scope.messageSuccess(response.data.message);
             $scope.loadUsers();

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
            $("#frmVeli").hide();
            $("#frmVeliList").show();
            $("#paginate").show();
            $("#btnEkle").show();
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

