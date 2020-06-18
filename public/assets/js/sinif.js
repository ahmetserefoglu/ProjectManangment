
var app = angular.module('sinifRecords', ['angularUtils.directives.dirPagination']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('sinifController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true; }, 1000);

        $scope.ekle = function () {
            console.log("burada");
           $scope.resetForm();
            $scope.modalstate = 'ekle';
            $scope.page_title='Sınıf Ekle';
            $("#frmSinif").show();
            $("#frmSinifList").hide();
            $("#paginate").hide();
        }

    //Kullanıcıları Listele
    $scope.loadSinif = function () {
        $http.get('/api/v1/sinif')
        .then(function success(e) {
            console.log(e.data);
            $scope.siniflar = e.data.sinif;
            $scope.okullarx = e.data.okul;
            $scope.length = e.data.length;
            $scope.satirSayisi = 5;
        });



    };
    
    $scope.loadSinif();

     $scope.resetForm = function () {
        $scope.errors = [];
       $scope.sinif = {
        Sinif: '',
        Sube: '',
        Mevcut: ''
    };
        $scope.frmSinifKontrol.$setPristine();
        $scope.frmSinifKontrol.$setUntouched();              
    };

    //İptal Et
    $scope.iptal=function(){
        $("#frmSinif").hide();
        $("#frmSinifList").show();
        $("#paginate").show();
    }

    $scope.errors = [];

    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/api/v1/sinif";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }
        $http({
            method: method,
            url: url,
            data: $.param($scope.sinif),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
            $scope.messageSuccess(response.data.message);
            $scope.loadSinif();
        },function (error) {
            console.log(error);
            $scope.messageError(error.data.message);
            $scope.recordErrors(error);
        });
    };

    // Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Sınıf Düzenle';
        $scope.id = id;
        $("#frmSinif").show();
        $("#frmOgrenci").show();
        $("#frmSinifList").hide();
        $("#paginate").hide();
        $http.get('/api/v1/sinif/'+id)
        .then(function success(e) {
            console.log(e.data);
            $scope.sinif = e.data.sinif;
            $scope.okullarx = e.data.okul;
        });
    };

     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/sinif/' + id
            }).
            then(function (response) {
               $scope.messageSuccess(response.data.message);
               $scope.loadSinif();

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
        if (error.data.errors.Sinif) {
            $scope.errors.push(error.data.errors.Sinif[0]);
        }

        if (error.data.errors.Sube) {
            $scope.errors.push(error.data.errors.Sube[0]);
        }

        if (error.data.errors.Mevcut) {
            $scope.errors.push(error.data.errors.Mevcut[0]);
        }

    };

    //Başarılı Mesalar
    $scope.messageSuccess=function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $(".alert-success").removeAttr("style");
        $('.alert-success').delay(2000).slideUp(function(){
            $('.alert-success > p').html('');
            $("#frmSinif").hide();
            $("#frmSinifList").show();
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
