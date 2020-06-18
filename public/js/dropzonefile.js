
Dropzone.options.file={
	reateImageThumbnails: false,
      addRemoveLinks: true,
      url: "/projeler/upload",
      headers: {
        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
      },
      success:function(file,response){
		if(file.status=='success'){

			handleDropZoneFileUpload.handleSuccess(response);
			//
			setTimeout(function(){ location.reload();}, 1000);
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
		$('.alert-success > p').html(response.message);
        $('.alert-success').show();
        $(".alert-success").removeAttr("style");
		var imageList = $('#gallery ul');
		var imageSrc =  'http://127.0.0.1:8000/gallery/images/thumbs/' + response.file_name;
		$(imageList).append('<li><a href="'+imageSrc+'"><img src="'+imageSrc+'"></a></li>')
	}
};