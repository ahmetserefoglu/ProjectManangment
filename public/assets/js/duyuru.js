
var app = angular.module('duyuruRecords', ['angularUtils.directives.dirPagination']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('duyuruController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

    angular.element(document).ready(function () {

        $timeout(function() { $scope.loaded = true; }, 1000);

     

        $scope.ekle = function () {
         $scope.resetForm();
         $scope.buttonDurum='Kaydet';
         $scope.modalstate = 'ekle';
         $scope.page_title='Duyuru Ekle';
         $("#frmDuyuru").show();
         $("#frmDuyuruList").hide();
         $("#paginate").hide();
         $("#btnEkle").hide();
     }

    //Duyuruları Listele
    $scope.loadDuyuru = function () {
        $http.get('/api/v1/duyuru')
        .then(function success(e) {
            $scope.duyurular = e.data;
            $scope.length = e.data.length;
            $scope.satirSayisi = 10;
        });

    };
    
    $scope.loadDuyuru();

    $scope.resetForm = function () {
    $scope.errors = [];
       $scope.duyuru = {
        duyuruadi: '',
        duyuruicerik: '',
        duyurutipi: '',
        duyurupaylasan: '',
        duyurutarihi: ''
    };
        $scope.frmDuyuruKonrol.$setPristine();
        $scope.frmDuyuruKonrol.$setUntouched();              
    };

    //İptal Et
    $scope.iptal=function(){
        $("#frmDuyuru").hide();
        $("#frmDuyuruList").show();
        $("#paginate").show();
        $("#btnEkle").show(); 
    }

    $scope.errors = [];


    // Kullanıcı Ekle
    $scope.addDuyuru = function (modalstate,id) {
        var url =  "/api/v1/duyuru";
        var method='POST';
        if (modalstate === 'edit'){
            url += "/" + id ;
            method='PUT';
        }
        //console.log($scope.ogretmen);
        $http({
            method: method,
            url: url,
            data: $.param($scope.duyuru),
            headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
        }).then(function (response) {
            //$scope.uploadFile(response.data.ogretmenid);
            $scope.messageSuccess(response.data.message);
            $scope.loadDuyuru();
        },function (error) {
            $scope.messageError(error.data.message);
            $scope.recordErrors(error);
        });
    };

    // Kullanıcı Düzenle
    $scope.duzenle = function (id) {
        $scope.modalstate = 'edit';
        $scope.page_title='Duyuru Düzenle';
        $scope.buttonDurum='Güncelle';
        $scope.id = id;
        $("#frmDuyuru").show();
        $("#frmDuyuruList").hide();
        $("#paginate").hide();
        $("#btnEkle").hide();
        $http.get('/api/v1/duyuru/'+id)
        .then(function success(e) {
            $scope.duyuru = e.data.duyurular;
        });
    };


     //delete record
     $scope.sil = function(id) {
        //console.log(id);
        var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: '/api/v1/duyuru/' + id
            }).
            then(function (response) {
             $scope.messageSuccess(response.data.message);
             $scope.loadOgretmen();

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
        if (error.data.errors.duyuruadi) {
            $scope.errors.push(error.data.errors.duyuruadi[0]);
        }

        if (error.data.errors.duyuruicerik) {
            $scope.errors.push(error.data.errors.duyuruicerik[0]);
        }

        if (error.data.errors.duyurutipi) {
            $scope.errors.push(error.data.errors.duyurutipi[0]);
        }

        if (error.data.errors.duyurupaylasan) {
            $scope.errors.push(error.data.errors.duyurupaylasan[0]);
        }

        if (error.data.errors.duyurutarihi) {
            $scope.errors.push(error.data.errors.duyurutarihi[0]);
        }
    };

    //Başarılı Mesalar
    $scope.messageSuccess=function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $(".alert-success").removeAttr("style");
        $('.alert-success').delay(2000).slideUp(function(){
            $('.alert-success > p').html('');
            $("#frmDuyuru").hide();
            $("#frmDuyuruList").show();
            $("#btnEkle").show();
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

