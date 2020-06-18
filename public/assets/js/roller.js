
var app = angular.module('rolesRecords', ['angularUtils.directives.dirPagination','datatables']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);
/*
*Roles - Changed
*/
app.controller('rolesListController',['$scope', '$http','$timeout', function($scope, $http,$timeout) {

    angular.element(document).ready(function () {
        $timeout(function() { $scope.loaded = true; }, 1000);


        $scope.ekle = function () {
         //$scope.role="";
         $scope.modalstate = 'ekle';
         $("#frmRoleList").hide();
         $("#frmRole").show();
         $scope.page_title='Kullanıcı Rol Ekle';
         $("#paginate").hide();
     }


     $scope.roleList=function(){
       $http.get('/api/v1/roles')
       .then(function success(e) {
        $scope.roles = e.data;
        $scope.length = e.data.roles;
        $scope.satirSayisi = 5;
    });
   };

   $scope.roleList();

   $scope.duzenle = function (id) {
    $scope.modalstate = 'edit';
    $scope.page_title='Kullanıcı Rol Düzenle';
    $("#frmRoleList").hide();
    $("#frmRole").show();
    $("#paginate").hide();
    $scope.id = id;
    $http.get('/api/v1/roles/'+id)
    .then(function success(e) {
        $scope.role = e.data[0];
    });
};

/*$scope.resetForm = function () {
    $scope.frmRole = {};
    $scope.frmRole.$setPristine();
    $scope.frmRole.$setUntouched();              
};*/


    //İptal Et
    $scope.iptal=function(){
     $("#frmRoleList").show();
     $("#frmRole").hide();
     $("#paginate").show();
 }

 

    // Kullanıcı Ekle
    $scope.save = function (modalstate,id) {
        var url =  "/api/v1/roles";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }
        $http({
            method: method,
            url: url,
            data: $.param($scope.role),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
            $scope.messageSuccess(response.data.message);
            $scope.roleList();
        },function (error) {
            $scope.messageError(error.data);
        });
    };

    //delete record
    $scope.confirmDelete = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/roles/' + id
            }).
            success(function(data) {
             $scope.messageSuccess(data);
             $scope.roleList();
         }).error(function(response) {
            $scope.messageError('Kayit Silinirken Hata Oluştu');
        });
     } else {
        return false;
    }
}

$scope.errors = [];

  //Başarılı Mesalar
  $scope.messageSuccess=function(msg){
    $('.alert-success > p').html(msg);
    $('.alert-success').show();
    $(".alert-success").removeAttr("style");
    $('.alert-success').delay(2000).slideUp(function(){
        $('.alert-success > p').html('');
        $("#frmRole").hide();
        $("#frmRoleList").show();
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

    $scope.recordErrors = function (error) {

        $scope.errors = [];
        if (error.data.errors.rolename) {
            $scope.errors.push(error.data.errors.rolename[0]);
        }

        if (error.data.errors.role_display_name) {
            $scope.errors.push(error.data.errors.role_display_name[0]);
        }

        if (error.data.errors.role_description) {
            $scope.errors.push(error.data.errors.role_description[0]);
        }

    };
});

}]);

