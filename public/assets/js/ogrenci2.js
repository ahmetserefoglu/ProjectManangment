
function sayiKontrol(event)
{
    if(event.keyCode != 8 && event.keyCode != 0 && (event.keyCode < 48 || event.keyCode > 57))
        return false;
    return true;
}


var app = angular.module('ogrenciRecords',['angularUtils.directives.dirPagination']).
constant('API_URL', '/api/v1/ogrenci/');


        /*
        *projeListController - Changed
        */
        app.controller('ogrenciController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {


                    //Kullanıcıları Listele
    $scope.loadOgrenci = function () {
        $http.get('/api/v1/ogrenci')
        .then(function success(e) {
            console.log(e.data);
        });



    };
    
    $scope.loadOgrenci();

                //show modal form
                $scope.toggle = function(modalstate, id) {
                    $scope.modalstate = modalstate;

                    switch (modalstate) {
                        case 'add':
                        $scope.ogrenci="";
                        $scope.page_title='Öğrenci Ekle';
                        $("#frmOgrenci").show();
                        $("#frmOgrenciList").hide();
                        $("#paginate").hide();
                        break;
                        case 'detay':
                        $scope.form_title = "Öğrenci Düzenle";          
                        $("#frmOgrenci").show();
                        $("#frmOgrenciList").hide();
                        $("#paginate").hide();
                        $scope.id = id;
                        console.log($scope.id);
                        $http.get(API_URL + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.ogrenci = response;
                            //$scope.intValue = parseInt(response[0].projesuresi);

                        });
                        break;
                        default:
                        break;
                    }
                    //console.log($scope);
                    
                }

                 //İptal Et
                 $scope.iptal=function(){
                    $("#frmOgrenci").hide();
                    $("#frmOgrenciList").show();
                    $("#paginate").show();
                }

                $scope.errors = [];

                //save new record / update existing record
                $scope.save = function(modalstate, id) {
                    var url = API_URL;
                    
                    //append employee id to the URL if the form is in edit mode
                    if (modalstate === 'detay'){
                        url += "/" + id ;
                    }
                    //x=$scope.selectedRole;
                    //y=$.param($scope.user);

                    //data={"x":$scope.selectedRole,"y":y};
                    console.log(url);
                    console.log($.param($scope.ogrenci));
                   //console.log($scope.selectedRole);
                    //console.log(data);
                    $http({
                        method: 'POST',
                        url: url,
                        data: $.param($scope.ogrenci),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).success(function(response) {
                        //
                        $scope.messageSuccess(response.message);
                        $scope.loadOgrenci();
                    }).error(function(response) {
                        
                        $scope.messageError(error.data);
                        //console.log(response);
                        //console.log(response);
                    });
                }

                //delete record
                $scope.confirmDelete = function(id) {
                    //console.log(id);
                    var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
                    if (isConfirmDelete) {
                        $http({
                            method: 'DELETE',
                            url: API_URL+ id
                        }).
                        success(function(data) {
                            console.log(data);
                            $scope.messageSuccess(data.message);
                            $scope.loadOgrenci();
                        }).
                        error(function(data) {
                           $scope.messageError('Kayit Silinirken Hata Oluştu');
                            //console.log(data);
                            console.log(data);
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



}]);