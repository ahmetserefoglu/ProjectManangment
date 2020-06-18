@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')


<div class="row">
  <div class="col-md-3">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h4 class="box-title">Görevler</h4>
      </div>
      <div class="box-body">
        <!-- the events -->
        <div id="external-events">
          @foreach($tasks as $task)
          <div class="external-event ">{{$task->name}}</div>

          @endforeach
          <div class="checkbox">
            <label for="drop-remove">
              <input type="checkbox" id="drop-remove">
              remove after drop
            </label>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /. box -->
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Create Event</h3>
      </div>
      <div class="box-body">
        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
          <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
          <ul class="fc-color-picker" id="color-chooser">
            <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
            <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
          </ul>
        </div>
        <!-- /btn-group -->
        <div class="input-group">
          <input id="new-event" type="text" class="form-control" placeholder="Event Title">

          <div class="input-group-btn">
            <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
          </div>
          <!-- /btn-group -->
        </div>
        <!-- /input-group -->
      </div>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-body no-padding">
        <!-- THE CALENDAR -->
        <div id="calendar"></div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /. box -->
  </div>
  <!-- /.col -->

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">

          <input type="hidden" name="event_id" id="event_id" value="" />
          <input type="hidden" name="task_id" id="task_id" value="" />
          <h4>Edit Task</h4>

          Görev:
          <br />
          <input type="text" class="form-control" name="task_name" id="task_name">

          Başlama Tarihi:
          <br />
          <input type="date" class="form-control" name="start_date" id="start_date">

          Bitiş Tarihi:
          <br />
          <input type="date" class="form-control" name="end_date" id="end_date">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="button" class="btn btn-primary" id="task_update" value="Save">
        </div>
      </div>
    </div>
  </div>

</div>




@section('js')
<script>
 $(document).ready(function() {

            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({

              header    : {
                left  : 'prev,next today',
                center: 'title',
                right : 'month,agendaWeek,agendaDay'
              },
              buttonText: {
                today: 'today',
                month: 'month',
                week : 'week',
                day  : 'day'
              },
              dragOpacity: .60,
              eventTextColor: '#000000',
              editable  : true,
            droppable : true, // this allows things to be dropped onto the calendar !!!

            drop      : function (date, allDay) { // this function is called when something is dropped

              // retrieve the dropped element's stored Event Object
              var originalEventObject = $(this).data('eventObject')

              console.log(originalEventObject);
              // we need to copy it, so that multiple events don't have a reference to the same object
              var copiedEventObject = $.extend({}, originalEventObject)

              // assign it the date that was reported
              copiedEventObject.start           = date
              copiedEventObject.allDay          = allDay
              copiedEventObject.backgroundColor = $(this).css('background-color')
              copiedEventObject.borderColor     = $(this).css('border-color')

              console.log(copiedEventObject.borderColor);
              var rgb = copiedEventObject.borderColor;

                rgb = rgb.substring(4, rgb.length-1)
                         .replace(/ /g, '')
                         .split(',');


              function componentToHex(c) {
                  var hex = c.toString(16);
                  return hex.length == 1 ? "0" + hex : hex;
                }

                function rgbToHex(r, g, b) {
                  return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
                }

                alert(copiedEventObject.borderColor);
              // render the event on the calendar
              // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
              $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

              // is the "remove after drop" checkbox checked?
              if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove()
              }

            },
            events : [

            @foreach($tasks as $task)
            {
              id : '{{ $task->id }}',
              title : "{!! $task->name !!}",
              start : "{!! $task->start_date !!}",
              end : '{{ $task->end_date }}',
              backgroundColor : '{{  $task->backgroundColor }}',
            },
            @endforeach

            ],
                //Show the event entry form when a day is clicked
                dayClick: function(date, jsEvent, view) {
                    //Change background color of day when it is clicked
                    $(this).css('background-color', '#bed7f3');
                    console.log(date);
                    //Get the date that was clicked
                    var date_clicked =  date.format();
                    //Redirect to the new event entry form
                   // window.location.href = "{{URL::to('events')}}" + "/" + date_clicked;
                 },
                 eventClick: function(event, jsEvent, view) {
                  console.log(event);
                  $('#task_id').val(event.id);
                  $('#task_name').val(event.title);
                  $('#start_date').val(moment(event.start).format('YYYY-MM-DD'));
                  $('#end_date').val(moment(event.end).format('YYYY-MM-DD'));
                  $('#editModal').modal();
                    //$(this).css('background-color', '#ff0000');
                  },
                  eventDragStart: function(event, jsEvent, view) {
                    $(this).css('background-color', '#00ff00');
                  },
                // drop on a new date and submit to database
                eventDrop: function(event, delta, revertFunc, jsEvent, view) {

                  console.log(event);
                  var originalEventObject = $(this).data('eventObject')
                  console.log(originalEventObject);
                  swal({
                    title: "You moved the event. Save it?",
                    text: "You can move it as mush as you want.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then(function(willDelete){
                    if (willDelete) {
                      swal("Moved. Your event has been rescheduled.", {
                        icon: "success",
                      });

                      $.ajax({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type:'POST',
                        url: '{{ route('appointments.ajax_update') }}',
                        data:{
                          id:event.id,
                          start:moment(event.start).format('YYYY-MM-DD'),
                          end:moment(event.end).format('YYYY-MM-DD'),
                        },
                        success: function(data){
                        },
                      });
                    } else {
                      swal("Your event has not been rescheduled.");
                      revertFunc();
                    }
                  });
                },
                eventResize: function(event, delta, revertFunc){
                var originalEventObject = $(this).data('eventObject')
                  console.log(originalEventObject);
                  console.log(moment(event.end).format('YYYY-MM-DD'));

                  swal({
                    title: "Changed Timeline. Save it?",
                    text: "You can expand it as far as you need to.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then(function(willDelete){
                    if (willDelete) {
                      swal("Moved! Your event has been rescheduled!", {
                        icon: "success",
                      });

                      $.ajax({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type:'POST',
                        url: '{{ route('appointments.ajax_update') }}',
                        data:{
                          id:event.id,
                          start:event.start.format(),
                          end:event.end.format()
                        },
                        success: function(data){
                        },
                      });

                    } else {
                      swal("Your event has not been rescheduled.");
                      revertFunc();
                    }
                  });
                },
              })


        $('#task_update').click(function(e) {
          e.preventDefault();
          var data = {
            _token: '{{ csrf_token() }}',
            id: $('#task_id').val(),
            name: $('#task_name').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
          };

          console.log(data);

          $.post('{{ route('appointments.ajax_update') }}', data, function( result ) {
            $('#calendar').fullCalendar('removeEvents', $('#task_id').val());

            console.log(result);

            $('#calendar').fullCalendar('renderEvent', {
              title: result.task.name,
              start: result.task.start_date,
              end: result.task.end_date
            }, true);

            $('#editModal').modal('hide');
          });
        });
});

</script>
@endsection

@stop