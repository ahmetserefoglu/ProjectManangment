
var app = angular.module('projeRecords', ['angularUtils.directives.dirPagination','datatables']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('projeListController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true; }, 1000);

        $scope.ekle = function () {

            $scope.modalstate = 'ekle';
            $scope.page_title='Proje Ekle';
            $("#frmUsers").show();
            $("#frmUsersList").hide();
        }

    //Kullanıcıları Listele
    $scope.loadUsers = function () {
        $http.get('/admin/projetakibi')
        .then(function success(e) {
            $scope.projes = e.data.proje;
            $scope.kullanicilar = e.data.kullanici;
            $scope.firmalar = e.data.firma;
            $scope.dosyalar = e.data.dosyalar;
            console.log(e.data.dosyalar);
            $scope.satirSayisi = 5;
        });



    };
    
    $scope.loadUsers();

    

    //İptal Et
    $scope.iptal=function(){
         //$scope.resetForm();
        $("#frmUsers").hide();
        $("#frmUsersList").show();
        
    }

    $scope.errors = [];

    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/admin/projetakibi";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }
        $http({
            method: method,
            url: url,
            data: $.param($scope.proje),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
          console.log(response.data);
            $scope.messageSuccess(response.data.message);
            $scope.loadUsers();
        },function (error) {
            $scope.messageError(error.data);
        });
    };


    $scope.resetForm = function () {
        $scope.frmProje={};
        $scope.frmProje.$setPristine();
        $scope.frmProje.$setUntouched();              
    };
    // Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Proje Düzenle';
        $scope.id = id;
        console.log("dasda");
        $("#frmUsers").show();
        $("#frmUsersList").hide();
        $http.get('/admin/projetakibi/'+id)
        .then(function success(e) {
            $scope.proje = e.data;
        });
    };

    $scope.dosyalarxxx = function (id) {
         $http.get('/admin/dosyalar/'+id)
        .then(function success(e) {

            console.log(e.data.dosya2);
            $scope.satirSayisi = 5;
        });

    };
     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/admin/projetakibi/' + id
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
        if (error.data.errors.password) {
            $scope.errors.push(error.data.errors.password[0]);
        }

        if (error.data.errors.name) {
            $scope.errors.push(error.data.errors.name[0]);
        }

        if (error.data.errors.email) {
            $scope.errors.push(error.data.errors.email[0]);
        }

        if (error.data.errors.rolename) {
            $scope.errors.push(error.data.errors.rolename[0]);
        }
    };

    //Başarılı Mesalar
    $scope.messageSuccess=function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $(".alert-success").removeAttr("style");
        $('.alert-success').delay(2000).slideUp(function(){
            $('.alert-success > p').html('');
            $("#frmUsers").hide();
            $("#frmUsersList").show();
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
