  $(document).ready(function () {
    $('.sidebar-menu').tree()

    $('.sidebar-toggle').on('click',function(){

      var cls =  $('body').hasClass('skin-blue sidebar-mini pace-done sidebar-open sidebar-collapse');

      var cls2 =  $('body').hasClass('skin-blue sidebar-mini pace-done');

      var cls3 =  $('body').hasClass('skin-blue sidebar-mini pace-done sidebar-open');


      if(cls2){
        $('body').addClass('sidebar-collapse');
        $('body').attr('id','so');
      }

      if (cls) {
        $('body').removeClass('sidebar-collapse');
        $('body').attr('id','xx');
      }



      if ($('#so').val()=='so' || $('#so').val()=='') {
        if (cls3) {
          $('body').removeClass('sidebar-open');
          $('body').addClass('sidebar-collapse');
        } else{
          $('body').addClass('sidebar-open');
        }
      }else{
        $('body').removeClass('sidebar-open');
      }



    });

  })
      // To make Pace works on Ajax calls
      $(document).ajaxStart(function () {
        Pace.restart()
      })

      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      });




      lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
      })

      $("#example1,#example2,#example3,#example4").DataTable();