var app = angular.module('App', [], ['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
}]);

app.controller('FileUploadController',function ($scope, $http,$timeout) {

$timeout(function() { $scope.loaded = true; }, 1000);

    $scope.errors = [];

    $scope.files = [];

    $scope.listFiles = function () {
        var request = {
            method: 'GET',
            url: '/list/file',
            headers: {
                'Content-Type': undefined
            }
        };

        $http(request)
        .then(function success(e) {

            $scope.files = e.data;
            //console.log(e.data);
        }, function error(e) {


        });
    };

    $scope.listFiles();

    var formData = new FormData();


    $scope.uploadFile = function () {

console.log(formData);

        var request = {
            method: 'POST',
            url: '/upload/file',
            data: formData,
            headers: {
                'Content-Type': undefined
            }
        };

        $http(request)
        .then(function success(e) {
            console.log(e.data.files);

            $scope.files = e.data.files;

            if(e.data.files==0)
                $(".alert-danger").removeAttr("style");
                //console.log(e.data.src);
                $('#temp_image')
                .attr('src', '');
                //$scope.uploadedImgSrc = e.data.src;
                $scope.errors = [];
                // clear uploaded file
                var fileElement = angular.element('#image_file');
                fileElement.value = '';
                $(".alert-success").removeAttr("style");
                $('.alert-success > p').html("Resim Yükleme Başarılı");
                $('#myModal').modal('hide');

                $('.alert-success').delay(5000).slideUp(function(){
                    $('.alert-success > p').html('');
                });
            }, function error(e) {
                console.log(e.data.errors);
                if(e.data.errors!=null){
                    $scope.errors = e.data.errors;
                    $(".alert-danger").removeAttr("style");
                    $('.alert-danger').delay(5000).slideUp(function(){
                        $('.alert-danger > p').html('');
                    });
                }
                
            });
    };
    
    $scope.close = function ($files) {
        var control = $("#image_file"),
        clearBn = $("#close");
        clearBn.on("click", function(){
            control.replaceWith( control.val('').clone( true ) );
        });
    }

    $scope.showImage=function(id){


       var request = {
        method: 'GET',
        url: '/list/file/'+id,
        headers: {
            'Content-Type': undefined
        }
    };

    $http(request)
    .then(function success(e) {

            //$scope.files = e.data;

            $('#myModal').modal('show');
            $('#temp_image')
            .attr('src', "/image_uploads/"+e.data.src);
            $("#buton").css({"display":"none"});
            //console.log(e.data);
        }, function error(e) {

        });


}


$scope.downloadImage=function(id){


   var request = {
    method: 'GET',
    url: '/list/file/'+id,
    headers: {
        'Content-Type': undefined
    }
};

$http(request)
.then(function success(e) {

    $scope.files = e.data;

    $('#myModal').modal('show');
    $('#temp_image')
    .attr('src', "/image_uploads/"+e.data.src);
    $("#buton").css({"display":"none"});
            //console.log(e.data);
        }, function error(e) {

        });


}



$scope.setTheFiles = function ($files) {

   angular.forEach($files, function (value, key) {
    formData.append('image_file[]', value);
            //$scope.uploadFile();
            $scope.srcFile=value.name;
            console.log(formData);
            //console.log(value.name+'.'+value.type);
            //$scope.name=value.name;
            //$scope.size=value.size;
            //$scope.type=value.type;
            //$scope.src=value.target;

            //$scope.previewData.push({'name':value.name,'size':size,'type':value.type,
              //          'src':src,'data':obj});






          });
    //console.log("setTheFiles");
   /* $("#buton").removeAttr("style");
    var imagefile = document.querySelector('#image_file');
    if (imagefile.files && imagefile.files[0]) {
        var reader = new FileReader();
        console.log(formData);
        angular.forEach($scope.files, function(file){
            console.log(file);
            form_data.append('image[]', file);
        });
        reader.onload = function (e) {
         $("#myModalLabel").text("Ön İzleme");
         $('#myModal').modal('show');
         $('#temp_image')
         .attr('src', e.target.result);
                            //console.log(e.target.name);
                            $(".alert-danger").css({"display":"none"});
                            $scope.errors ='';
                        };
                        reader.readAsDataURL(imagefile.files[0]);
                        this.imagefile = imagefile.files[0];
                    }else{
                        $('#image_file').text("");
                    }*/

                };

                $scope.deleteFile = function (index) {
                    var conf = confirm("Resmi Silmek İster Misiniz?");

                    if (conf == true) {
                        var request = {
                            method: 'POST',
                            url: '/delete/file',
                            data: $scope.files[index]
                        };

                        $http(request)
                        .then(function success(e) {
                            $scope.errors = [];

                            $scope.files.splice(index, 1);

                        }, function error(e) {
                            $scope.errors = e.data.errors;
                        });
                    }
                };

            });

app.directive('ngFiles', ['$parse', function ($parse) {

    function file_links(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function (event) {
            //console.log(event.target.files);
            onChange(scope, {$files: event.target.files});

            //console.log(event);

        });
    }

    return {
        link: file_links
    }
}]);