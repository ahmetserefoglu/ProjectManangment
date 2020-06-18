
var app = angular.module('TaskCrud', ['angularUtils.directives.dirPagination','datatables']
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);


app.controller('TaskController', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {

	$scope.tasks = [];


    // List tasks
    $scope.loadTasks = function () {
    	$http.get('/task')
    	.then(function success(e) {
            console.log(e.data.tasks);
    		$scope.tasks = e.data.tasks;
            $scope.satirSayisi = 10;
    	});
    };
    $scope.loadTasks();

    $scope.errors = [];

    $scope.success = false;

    $scope.error = false;

    $scope.task = {
    	name: '',
    	description: '',
        start_date: ''
    };

    $scope.initTask = function () {
    	$scope.resetForm();
    	$("#add_new_task").modal('show');
    };

    // Add new Task
    $scope.addTask = function () {
    	$http.post('/task', {
    		name: $scope.task.name,
    		description: $scope.task.description,
            start_date: $scope.task.start_date
    	}).then(function success(e) {
           // console.log(e.data.task)
    		$scope.resetForm();
    		$scope.success=true;
            $scope.successMessage = e.data.message;
            $scope.messageSuccess(e.data.message);
            $scope.tasks.push(e.data.task);
            $timeout(function () {
                       $scope.success=false;
            }, 2000);
           
    		$("#add_new_task").modal('hide');

    	}, function error(error) {
            console.log(error);
            $scope.error=true;
    		$scope.recordErrors(error);
            $scope.messageError(error);
    	});
    };

    $scope.recordErrors = function (error) {
    	$scope.errors = [];
    	if (error.data.errors.name) {
    		$scope.errors.push(error.data.errors.name[0]);
    	}

    	if (error.data.errors.description) {
    		$scope.errors.push(error.data.errors.description[0]);
    	}

        if (error.data.errors.start_date) {
            $scope.errors.push(error.data.errors.start_date[0]);
        }
    };

    $scope.resetForm = function () {
    	$scope.task.name = '';
    	$scope.task.description = '';
        $scope.task.start_date = '';
    	$scope.errors = [];
    };

    $scope.edit_task = {};
    // initialize update action
    $scope.initEdit = function (index) {
    	$scope.errors = [];
    	$scope.edit_task = $scope.tasks[index];
    	$("#edit_task").modal('show');
    };

    // update the given task
    $scope.updateTask = function () {
    	$http.patch('/task/' + $scope.edit_task.id, {
    		name: $scope.edit_task.name,
    		description: $scope.edit_task.description,
            start_date: $scope.edit_task.start_date
    	}).then(function success(e) {
    		$scope.errors = [];
    		$("#edit_task").modal('hide');
    	}, function error(error) {
    		$scope.recordErrors(error);
            $scope.error=true;
            $scope.messageError(error);
    	});
    };

    $scope.deleteTask = function (index) {
 
        var conf = confirm("Do you really want to delete this task?");
 
        if (conf === true) {
            $http.delete('/task/' + $scope.tasks[index].id)
                .then(function success(e) {
                    $scope.tasks.splice(index, 1);
                });
        }
    };

    $scope.resetForm = function () {
    	$scope.task.name = '';
    	$scope.task.description = '';
        $scope.task.start_date = '';
    	$scope.errors = [];
    };

     // function to display success message
    $scope.messageSuccess = function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $(".alert-success").removeAttr("style");
        $('.alert-success').delay(2000).slideUp(function(){
            $('.alert-success > p').html('');
        });
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