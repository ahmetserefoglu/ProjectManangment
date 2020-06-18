
var app = angular.module('kullaniciRecords', ['angularUtils.directives.dirPagination','datatables']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('kullaniciController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true; }, 1000);

        $scope.ekle = function () {

            $scope.modalstate = 'ekle';
            $scope.page_title='Kullanıcı Ekle';
            $("#frmUsers").show();
            $("#frmUsersList").hide();
            $("#paginate").hide();
        }

    //Kullanıcıları Listele
    $scope.loadUsers = function () {
        $http.get('/api/v1/users')
        .then(function success(e) {
            $scope.roles = e.data.roles;
            $scope.users = e.data.users;
            $scope.length = e.data.users;
            $scope.satirSayisi = 5;
        });



    };
    
    $scope.loadUsers();

    //İptal Et
    $scope.iptal=function(){
         //$scope.resetForm();
        $("#frmUsers").hide();
        $("#frmUsersList").show();
        $("#paginate").show();
        
    }

    $scope.errors = [];

    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/api/v1/users";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }
        $http({
            method: method,
            url: url,
            data: $.param($scope.user),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
            $scope.messageSuccess(response.data.message);
            $scope.loadUsers();
        },function (error) {
            $scope.messageError(error.data);
        });
    };

    $scope.resetForm = function () {
        $scope.frmUsers={};
        $scope.frmUsers.$setPristine();
        $scope.frmUsers.$setUntouched();              
    };
    // Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Kullanıcı Düzenle';
        $scope.id = id;
        $("#frmUsers").show();
        $("#frmUsersList").hide();
        $("#paginate").hide();
        $http.get('/api/v1/users/'+id)
        .then(function success(e) {
            $scope.user = e.data.users[0];
        });
    };

     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/users/' + id
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
