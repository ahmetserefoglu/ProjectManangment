
        var app = angular.module('mesajlarRecords', ['angularUtils.directives.dirPagination','datatables']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);
        /*
        *MesajlarController - Changed
        */
        app.controller('mesajlarController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {
            $scope.deger='';
                //retrieve mesajlar listing from API
                $scope.loadMesaj=function(){
                    $http.get("/admin/mesaj")
                    .then(function success(e) {
                        console.log(e.data.gelenmesaj);
                        $scope.gelenmesajlar=e.data.gelenmesaj;
                        $scope.gidenmesajlar=e.data.gidenmesaj;
                        $scope.kullanicilar=e.data.kullanicilar;
                    });
                };


                $scope.loadMesaj();

                $( "#seviyead" ).change(function() {
                  var data={
                    'seviyead':this.value
                };
                $scope.deger=data;

                $http({
                    method: "POST",
                    url: "/malzemekart/maliyetakisioperayon",
                    data: data
                }).success(function(response) {
                    $scope.operationlar=response.operation;
                    $scope.loadOperation();
                }).error(function(error) {
                    $scope.recordErrors(error);

                });

            });

                 $scope.mesajOku=function(id){
                    $('#mesajoku').removeAttr('style');
                    $("#sendbox").hide();
                    $("#mesajlar").css({"display":"none"});
                    
                    $("#cevapladurum").css({"display":"none"});
                    console.log("asdas");
                    $http.get("/admin/mesaj/"+id)
                    .then(function success(e) {
                        $scope.mesaj=e.data;
                        console.log(e.data);
                    });
                };



                $scope.mesajYaz=function(){
                    $('#mesajyaz').removeAttr('style');
                    $scope.resetForm();
                    $("#sendbox").hide();
                     $('#sendbox').css({"display":"none"});
                    $('#mesajoku').css({"display":"none"});
                    $("#mesajlar").css({"display":"none"});
                }

                $scope.cevapla=function(id){
                    $('#cevapla').removeAttr('style');
                     $('#sendbox').css({"display":"none"});
                    $('#mesajoku').css({"display":"none"});
                    $("#mesajlar").css({"display":"none"});
                    $http.get("/admin/mesaj/"+id)
                    .then(function success(e) {
                        $scope.mesajs=e.data;
                        console.log(e.data);
                    });
                }

                $scope.mesajGeriDon=function(){
                    $('#mesajlar').removeAttr('style');
                    $('#mesajoku').css({"display":"none"});
                    $("#mesajyaz").css({"display":"none"});
                    $("#cevapla").css({"display":"none"});
                }


                 $scope.inbox=function(){
                    $('#mesajlar').removeAttr('style');
                    $('#mesajoku').css({"display":"none"});
                    $('#mesajyaz').css({"display":"none"});
                    $("#sendbox").css({"display":"none"});
                    $("#cevapla").css({"display":"none"});
                }

                $scope.sendbox=function(){
                    console.log("asdas");
                    $("#cevapla").css({"display":"none"});
                    $('#sendbox').removeAttr('style');
                    $('#mesajyaz').css({"display":"none"});
                    $('#mesajoku').css({"display":"none"});
                    $("#mesajlar").css({"display":"none"});
                }

                $scope.reload = function()
                {
                   
                   location.reload(); 
               }


               $scope.loadOperationPOST=function(url,data,deger){
                 $http({
                    method: "POST",
                    url: url,
                    data: data
                }).success(function(response) {
                    $scope.poylar=response.poy;
                    $scope.cekimler=response.cekim;
                    $scope.aktarmalar=response.aktarma;
                    $scope.bondedlar=response.bonded;
                    $scope.sarimlar=response.sarim;
                    $scope.paketlemeler=response.paketleme;
                    $scope.schringcroplar=response.schringcrop;
                    $scope.operasyondetaylar=response.operasyondetay;
                    $scope.seviyeanadetaylar=response.seviyeanadetay;

                }).error(function(error) {
                    $scope.messageError(error);

                });
            }



            $scope.employeese = {
                name: '',
                email: '',
                contact_number:'',
                position:''
            };
            $scope.success = false;

            $scope.error = false;
                //show modal form
                $scope.toggle = function(modalstate, id) {
                    $scope.modalstate = modalstate;

                    switch (modalstate) {
                        case 'add':
                        $scope.form_title = "Reçete Ekle";
                        $("#kodVeri").removeAttr("style");
                        break;
                        case 'edit':
                        $scope.form_title = "Reçete Düzenle";
                        $("#operation").removeAttr("style");
                        $scope.id = id;
                        $http.get(API_URL + 'kodveri/' + id)
                        .success(function(response) {
                            $scope.kodveri = response[0];
                        });
                        break;
                        case 'iptal':

                        $("#kodVeri").css({"display":"none"});
                        break;
                        case 'send': 
                        $scope.id = id;
                        $scope.send();
                        break;
                        case 'copy':  
                        $scope.id = id;
                        $scope.copy(id);
                        break;
                        default:
                        break;
                    }
                }

                //save new record / update existing record
                $scope.save = function() {
                    var url = "/admin/mesaj";
                    var method='POST';
                    console.log($scope.mesajs);
                    var data=$.param($scope.mesajs);
                    $http({
                        method: method,
                        url: url,
                        data: $.param($scope.mesajs),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded','Accept': 'application/json'}
                    }).then(function (response) {
                        //$scope.uploadFile(response.data.ogretmenid);
                        $scope.loadMesaj();
                        $scope.messageSuccess(response.data.message);
                    },function (error) {
                        $scope.messageError(error.data.message);
                        $scope.recordErrors(error);
                    });


                }

                $scope.resetForm = function () {


                    $scope.mesajs = '';
                    $scope.mesajYazGonder.$setPristine();
                    $scope.mesajYazGonder.$setUntouched();          
                };


                //delete record
                $scope.sil = function(id) {
                    //console.log(id);
                    var isConfirmDelete = confirm('Bu Kaydi Silmek İstediğinize Eminmisiniz?');
                    if (isConfirmDelete) {
                        $http({
                            method: 'DELETE',
                            url: '/admin/mesaj/' + id
                        }).
                        success(function(data) {

                            $scope.loadMesaj();
                            //location.reload();
                        }).
                        error(function(data) {
                            //console.log(data);
                            //alert('Unable to delete');
                            $scope.error = true;
                            $scope.messageError(data.errors);
                        });
                    } else {
                        return false;
                    }
                }


                $scope.recordErrors = function (error) {
                    $scope.errors = [];
                    //console.log(error.data);
                    /*if (error.email){
                        $scope.errors.push(error.email[0]);                        
                    }

                    if (error.revizyonno){
                        $scope.errors.push(error.revizyonno[0]);                        
                    }*/

                    $scope.errors.push(error.data); 
                };

                 // function to display success message
                 $scope.messageSuccess = function(msg){
                    $('.alert-success > p').html(msg);
                    $('.alert-success').show();
                    $(".alert-success").removeAttr("style");
                    $('.alert-success').delay(2000).slideUp(function(){
                        $('.alert-success > p').html('');

                    });

                    $('#mesajlar').removeAttr('style');
                    $("#mesajyaz").css({"display":"none"});
                    $("#cevapla").css({"display":"none"});

                };
                
                // function to display error message
                $scope.messageError = function(msg){
                    $('.alert-danger > p').html(msg);
                    $('.alert-danger').show();
                    $(".alert-danger").removeAttr("style");
                    $('.alert-danger').delay(2000).slideUp(function(){
                        $('.alert-danger > p').html('');
                    });
                };
            }]);
