
var app = angular.module('okulRecords', ['angularUtils.directives.dirPagination']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('okulController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true; }, 1000);

        $scope.ekle = function () {
           $scope.resetForm();
            $scope.modalstate = 'ekle';
            $scope.page_title='Okul Ekle';
            $scope.page_ogretmen_title='Okul Öğretmenleri';
            $scope.butonDurum='Kaydet';
            $("#frmOkul").show();
            $("#frmOkulList").hide();
            $("#paginate").hide();
            $("#btnEkle").hide();
        }

    //Kullanıcıları Listele
    $scope.loadOkul = function () {
        $scope.errors = [];
        $http.get('/api/v1/okul')
        .then(function success(e) {
            $scope.okullar = e.data.okul;
            $scope.okultipleri = e.data.okultipleri;
            $scope.sehirler = e.data.sehirler;
            $scope.length = e.data.length;
            $scope.satirSayisi = 5;
        });

    };

    
    $scope.loadOkul();

    $scope.ogretmenler = function (id) {
        $scope.errors = [];
        console.log(id);
        $http.get('/api/v1/okulogretmen/'+id)
        .then(function success(e) {
            console.log(e.data[0]);
            $("#frmOkul").hide();
            $("#frmOkulList").hide();
            $("#paginate").hide();
            $("#btnEkle").hide();
            $("#btnEkle").hide();
            $("#frmOgretmenList").show();
            
            $scope.okulogretmenler = e.data[0];
            $scope.length = e.data.length;
        });

    };

     $scope.resetForm = function () {
       $scope.okul = {
        MEBNo: '',
        OkulTipiID: '',
        OkulAdi: '',
        UyelikTarihi: '',
        Aktif: ''
    };
        $scope.frmOkulKontrol.$setPristine();
        $scope.frmOkulKontrol.$setUntouched();              
    };
    //İptal Et
    $scope.iptal=function(){
        $("#frmOkul").hide();
        $("#frmOkulList").show();
        $("#paginate").show();
        $("#btnEkle").show();
    }

    $scope.errors = [];

// Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Okul Düzenle';
        $scope.butonDurum='Güncelle';
        $scope.id = id;
        $("#frmOkul").show();
        $("#frmOkulList").hide();
        $("#paginate").hide();
        $http.get('/api/v1/okul/'+id)
        .then(function success(e) {
            $scope.okul = e.data.okul[0];
            $scope.okultipleri = e.data.okultipleri;
            $scope.sehirler = e.data.sehirler;
        },function (error) {
            $scope.messageError(error.data.message);
            $scope.recordErrors(error);
        });
    };

    
    // Kullanıcı Ekle
    $scope.addUser = function (modalstate,id) {
        var url =  "/api/v1/okul";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }

        $http({
            method: method,
            url: url,
            data: $.param($scope.okul),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            $scope.messageSuccess(response.data.message);
            $scope.loadOkul();
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
                url: '/api/v1/okul/' + id
            }).
            then(function (response) {
               $scope.messageSuccess(response.data.message);
               $scope.loadOkul();

           },function (error) {
            $scope.messageError('Kayit Silinirken Hata Oluştu');
        });
       } else {
        return false;
    }
}

$scope.aktif = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Tekrar Aktif Hale Getirmek İstiyormusunuz');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/okul/' + id
            }).
            then(function (response) {
               $scope.messageSuccess(response.data.message);
               $scope.loadOkul();

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
        console.log(error.data.errors);
        $(".alert-warning").removeAttr("style");
        if (error.data.errors.MEBNo) {
            $scope.errors.push(error.data.errors.MEBNo[0]);
        }

        if (error.data.errors.OkulTipiID) {
            $scope.errors.push(error.data.errors.OkulTipiID[0]);
        }

        if (error.data.errors.OkulAdi) {
            $scope.errors.push(error.data.errors.OkulAdi[0]);
        }

        if (error.data.errors.UyelikTarihi) {
            $scope.errors.push(error.data.errors.UyelikTarihi[0]);
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
            $("#frmOkul").hide();
            $("#frmOkulList").show();
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
