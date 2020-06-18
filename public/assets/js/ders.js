
var app = angular.module('dersRecords', ['angularUtils.directives.dirPagination']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('dersController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true; }, 1000);

        $scope.ekle = function () {
           $scope.resetForm();
            $scope.modalstate = 'ekle';
            $scope.page_title='Ders Ekle';
            $("#frmDers").show();
            $("#frmDersList").hide();
            $("#paginate").hide();
        }

    //Kullanıcıları Listele
    $scope.loadDersler = function () {
        $http.get('/api/v1/ders')
        .then(function success(e) {
            console.log(e.data);
            $scope.dersler = e.data;
            $scope.length = e.data.length;
            $scope.satirSayisi = 5;
        });



    };
    
    $scope.loadDersler();

    $scope.resetForm = function () {
    $scope.errors = [];
       $scope.ders = {
        DersKodu: '',
        DersAdi: '',
        OkutulduguSinif: '',
        OkutulduguDonem: '',
        Dil: '',
        Aktif: ''
    };
        $scope.frmDersKontrol.$setPristine();
        $scope.frmDersKontrol.$setUntouched();              
    };

    //İptal Et
    $scope.iptal=function(){
        $("#frmDers").hide();
        $("#frmDersList").show();
        $("#paginate").show();
    }

    $scope.errors = [];

// Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Öğrenci Düzenle';
        $scope.id = id;
        $("#frmDers").show();
        $("#frmDersList").hide();
        $("#paginate").hide();
        $http.get('/api/v1/ders/'+id)
        .then(function success(e) {
            console.log(e.data);
            $scope.ders = e.data[0];
        });
    };

    
    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/api/v1/ders";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }

        console.log($scope.ders);
        $http({
            method: method,
            url: url,
            data: $.param($scope.ders),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            $scope.messageSuccess(response.data.message);
            $scope.loadDersler();
        },function (error) {
            $scope.messageError(error.data.message);
            $scope.recordErrors(error);
        });
    };

    

     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Pasif Hale Getirmek İstiyormusunuz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/ders/' + id
            }).
            then(function (response) {
               $scope.messageSuccess(response.data.message);
               $scope.loadDersler();

           },function (error) {
            $scope.messageError('Kayit Silinirken Hata Oluştu');
        });
       } else {
        return false;
    }
}

$scope.aktif = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Tekrar Aktif Hale Getirmek İstiyormusunuz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/ders/' + id
            }).
            then(function (response) {
               $scope.messageSuccess(response.data.message);
               $scope.loadDersler();

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
        

        if (error.data.errors.DersKodu) {
            $scope.errors.push(error.data.errors.DersKodu[0]);
        }

        if (error.data.errors.DersAdi) {
            $scope.errors.push(error.data.errors.DersAdi[0]);
        }

        if (error.data.errors.OkutulduguSinif) {
            $scope.errors.push(error.data.errors.OkutulduguSinif[0]);
        }

        if (error.data.errors.OkutulduguDonem) {
            $scope.errors.push(error.data.errors.OkutulduguDonem[0]);
        }

        if (error.data.errors.Dil) {
            $scope.errors.push(error.data.errors.Dil[0]);
        }

        if (error.data.errors.Aktif) {
            $scope.errors.push(error.data.errors.Aktif[0]);
        }

        
    };

    //Başarılı Mesalar
    $scope.messageSuccess=function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $(".alert-success").removeAttr("style");
        $('.alert-success').delay(2000).slideUp(function(){
            $('.alert-success > p').html('');
            $("#frmDers").hide();
            $("#frmDersList").show();
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
