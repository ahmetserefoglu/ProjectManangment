
var app = angular.module('iletisimRecords', ['angularUtils.directives.dirPagination']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('iletisimController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true; }, 1000);

        $scope.ekle = function () {
           $scope.resetForm();
            $scope.modalstate = 'ekle';
            $scope.page_title='İletisim Bilgisi Ekle';
            $("#frmIletisim").show();
            $("#frmIletisimList").hide();
            $("#paginate").hide();
        }

    //Kullanıcıları Listele
    $scope.loadIletisim = function () {
        $http.get('/api/v1/iletisim')
        .then(function success(e) {
            console.log(e.data);
            $scope.iletisimbilgisi = e.data.iletisimbilgisi;
            $scope.iletisimtipleri = e.data.iletisimtipleri;
            $scope.length = e.data.length;
            $scope.satirSayisi = 5;
        });



    };
    
    $scope.loadIletisim();

     $scope.resetForm = function () {
        $scope.errors = [];
       $scope.iletisim = {
        OwnerType: '',
        OwnerId: '',
        IletisimTipId: '',
        Value: '',
         Ext: '',
        Default: '',
        Aktif: ''
    };
        $scope.frmIletisimKontrol.$setPristine();
        $scope.frmIletisimKontrol.$setUntouched();              
    };

    //İptal Et
    $scope.iptal=function(){
        $("#frmIletisim").hide();
        $("#frmIletisimList").show();
        $("#paginate").show();
    }

    $scope.errors = [];

    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/api/v1/iletisim";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }
        $http({
            method: method,
            url: url,
            data: $.param($scope.iletisim),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
            $scope.messageSuccess(response.data.message);
            $scope.loadIletisim();
        },function (error) {
            console.log(error);
            $scope.messageError(error.data.message);
            $scope.recordErrors(error);
        });
    };

    // Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Öğretmen Düzenle';
        $scope.id = id;
        $("#frmIletisim").show();
        $("#frmIletisimList").hide();
        $("#paginate").hide();
        $http.get('/api/v1/iletisim/'+id)
        .then(function success(e) {
            console.log(e.data);
            $scope.iletisim = e.data.iletisimbilgisi[0];
            $scope.iletisimtipleri = e.data.iletisimtipleri;
        });
    };

     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Pasif Hale Getirmek İstiyormusunuz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/iletisim/' + id
            }).
            then(function (response) {
                console.log(response.data.message);
               $scope.messageSuccess(response.data.message);
               $scope.loadIletisim();

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
                url: '/api/v1/iletisim/' + id
            }).
            then(function (response) {
               console.log(response.data.message);
               $scope.messageSuccess(response.data.message);
               $scope.loadIletisim();

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
        if (error.data.errors.OwnerId) {
            $scope.errors.push(error.data.errors.OwnerId[0]);
        }

        if (error.data.errors.OwnerType) {
            $scope.errors.push(error.data.errors.OwnerType[0]);
        }

        if (error.data.errors.IletisimTipId) {
            $scope.errors.push(error.data.errors.IletisimTipId[0]);
        }

        if (error.data.errors.Value) {
            $scope.errors.push(error.data.errors.Value[0]);
        }
        
        if (error.data.errors.Default) {
            $scope.errors.push(error.data.errors.Default[0]);
        }

        if (error.data.errors.Ext) {
            $scope.errors.push(error.data.errors.Ext[0]);
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
            $("#frmIletisim").hide();
            $("#frmIletisimList").show();
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
