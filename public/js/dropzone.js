Dropzone.options.addImages={
	maxFilesize:2,
	success:function(file,response){
		if(file.status=='success'){
			handleDropZoneFileUpload.handleSuccess(response);
			//
			setTimeout(function(){ location.reload();}, 3000);
		}else{
			handleDropZoneFileUpload.handleError(response);
		}
	}
};

var handleDropZoneFileUpload={
	handleError:function(response){
		console.log(response);
	},
	handleSuccess:function(response){
		console.log(response);
		var imageList = $('#gallery-images ul');
		var imageSrc =  'http://127.0.0.1:8000/gallery/images/thumbs/' + response.file_name;
		$(imageList).append('<li><a href="'+imageSrc+'"><img src="'+imageSrc+'"></a></li>')
	}
};

$(document).ready(function(){

	console.log('document is ready');
});

