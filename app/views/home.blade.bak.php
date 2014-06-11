@extends('layouts.default')
@section('headtitle')
	CRUD
@stop
@section('content')

	<h1>All the Data</h1>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>Data</td>
				<td>Description</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Tutorials</td>
				<td>Tutorials of the course</td>
				
				<!-- we will also add show and create buttons -->
				<td>

					<!-- show the tutorials (uses the show method found at GET /tutorials/ -->
					<a class="btn btn-small btn-success" href="{{ URL::to('tutorials') }}">View All Tutorials</a>

					<!-- create tutorial (uses the edit method found at GET /tutorials/create -->
					<a class="btn btn-small btn-info" href="{{ URL::to('tutorials/create') }}">Create a Tutorial</a>

				</td>
			</tr>
			<tr>
				<td>Classes</td>
				<td>Classes of the course</td>
				
				<!-- we will also add show and create buttons -->
				<td>

					<!-- show the classes (uses the show method found at GET /classes/ -->
					<a class="btn btn-small btn-success" href="{{ URL::to('classes') }}">View All Classes</a>

					<!-- create class (uses the edit method found at GET /classes/create -->
					<a class="btn btn-small btn-info" href="{{ URL::to('classes/create') }}">Create a Class</a>

				</td>
			</tr>
			<tr>
				<td>Users</td>
				<td>Users of the course</td>
				
				<!-- we will also add show and create buttons -->
				<td>

					<!-- show the users (uses the show method found at GET /users/ -->
					<a class="btn btn-small btn-success" href="{{ URL::to('users') }}">View All Users</a>

					<!-- create user (uses the edit method found at GET /users/create -->
					<a class="btn btn-small btn-info" href="{{ URL::to('users/create') }}">Create a User</a>

				</td>
			</tr>
		</tbody>
	</table>
<script type="text/javascript">
	$(document).ready(function() {
	
	
		/* initialize the external events
		-----------------------------------------------------------------*/
	
		$('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});
	
	
		/* initialize the calendar
		-----------------------------------------------------------------*/
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped
			
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
				
			}
		});
		
		
	});

</script>
<div id='wrap'>

<div id='external-events'>
	<h4>Draggable Events</h4>
	<div class='external-event'>My Event 1</div>
	<div class='external-event'>My Event 2</div>
	<div class='external-event'>My Event 3</div>
	<div class='external-event'>My Event 4</div>
	<div class='external-event'>My Event 5</div>
	<p>
	<input type='checkbox' id='drop-remove' /> <label for='drop-remove'>remove after drop</label>
	</p>
</div>

<div id='calendar'></div>

<div style='clear:both'></div>

<!-- Overview -->
    <div class="container docs-overview">
        <h1 class="page-header" id="overview">Overview</h1>
        <div class="row">
            <div class="col-md-9">
                <h3>Image:</h3>
                <div class="img-container"><img src="avatar/n29ubXeyyaav.jpg"></div>
            </div>
            <div class="col-md-3">
                <h3>Preview:</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="img-preview img-preview-sm"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-preview img-preview-xs"></div>
                    </div>
                </div>
                <hr>
                <h3>Data:</h3>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="data-x1" class="col-sm-3 control-label">X1:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="data-x1" placeholder="x1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data-y1" class="col-sm-3 control-label">Y1:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="data-y1" placeholder="y1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data-x2" class="col-sm-3 control-label">X2:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="data-x2" placeholder="x2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data-y2" class="col-sm-3 control-label">Y2:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="data-y2" placeholder="y2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data-width" class="col-sm-3 control-label">Width:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="data-width" placeholder="width">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data-height" class="col-sm-3 control-label">Height:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="data-height" placeholder="height">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="docs-btn-group">
                    <h3>Methods:</h3>
                    <div class="button-group">
                        <button class="btn btn-success" id="enable" type="button">Enable</button>
                        <button class="btn btn-danger" id="disable" type="button">Disable</button>
                        <button class="btn btn-info" id="free-ratio" type="button">Free Ratio</button>
                        <button class="btn btn-primary" id="set-data" type="button" title="Set with the following data">Set Data</button>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">X1</span>
                                <input class="form-control" id="set-data-x1" type="number" value="480">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Y1</span>
                                <input class="form-control" id="set-data-y1" type="number" value="60">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Width</span>
                                <input class="form-control" id="set-data-width" type="number" value="640">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Height</span>
                                <input class="form-control" id="set-data-height" type="number" value="360">
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <input class="form-control" id="get-data-input" type="text" placeholder="The data object will be showed here">
                        <span class="input-group-btn">
                            <button class="btn btn-info" id="get-data" type="button">Get Data</button>
                        </span>
                    </div>
                    <div class="input-group">
                        <input id="get-img-info-input" type="text" class="form-control" placeholder="The image information will be showed here">
                        <span class="input-group-btn">
                            <button class="btn btn-info" id="get-img-info" type="button">Get Image Info</button>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input id="set-aspect-ratio-input" type="number" class="form-control" placeholder="Input the new aspect ratio here">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="set-aspect-ratio" type="button">Set Aspect Ratio</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input id="set-img-src-input" type="text" class="form-control" placeholder="Input the new image src here" value="img/picture-2.jpg">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="set-img-src" type="button">Set Image Src</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <h3>Events:</h3>
                <p>Current active event:</p>
                <div class="btn-group btn-group-justified">
                    <a class="btn btn-default" id="drag-start" role="button" disabled>dragstart</a>
                    <a class="btn btn-default" id="drag-move" role="button" disabled>dragmove</a>
                    <a class="btn btn-default" id="drag-end" role="button" disabled>dragend</a>
                </div>
            </div>
    </div>
<script>
	
	$(function() {

    // Overview
    // -------------------------------------------------------------------------

	    (function() {
	        var $image = $(".img-container img"),
	            $dataX1 = $("#data-x1"),
	            $dataY1 = $("#data-y1"),
	            $dataX2 = $("#data-x2"),
	            $dataY2 = $("#data-y2"),
	            $dataHeight = $("#data-height"),
	            $dataWidth = $("#data-width"),
	            $dragStart = $("#drag-start"),
	            $dragMove = $("#drag-move"),
	            $dragEnd = $("#drag-end");

	        $image.cropper({
	            aspectRatio: 16 / 9,
	            preview: ".img-preview",
	            done: function(data) {
	                $dataX1.val(data.x1);
	                $dataY1.val(data.y1);
	                $dataX2.val(data.x2);
	                $dataY2.val(data.y2);
	                $dataHeight.val(data.height);
	                $dataWidth.val(data.width);
	            }
	        }).on({
	            dragstart: function() {
	                $dragStart.addClass("btn-info").siblings().removeClass("btn-info");
	            },
	            dragmove: function() {
	                $dragMove.addClass("btn-info").siblings().removeClass("btn-info");
	            },
	            dragend: function() {
	                $dragEnd.addClass("btn-info").siblings().removeClass("btn-info");
	            }
	        });

	        $("#enable").click(function() {
	            $image.cropper("enable");
	        });

	        $("#disable").click(function() {
	            $image.cropper("disable");
	        });

	        $("#free-ratio").click(function() {
	            $image.cropper("setAspectRatio", "auto");
	        });

	        $("#get-data").click(function() {
	            var data = $image.cropper("getData"),
	                val = "";

	            try {
	                val = JSON.stringify(data);
	            } catch (e) {
	                console.log(data);
	            }

	            $("#get-data-input").val(val);
	        });

	        var $setDataX1 = $("#set-data-x1"),
	            $setDataY1 = $("#set-data-y1"),
	            $setDataWidth = $("#set-data-width"),
	            $setDataHeight = $("#set-data-height");

	        $("#set-data").click(function() {
	            var data = {
	                x1: $setDataX1.val(),
	                y1: $setDataY1.val(),
	                width: $setDataWidth.val(),
	                height: $setDataHeight.val()
	            }

	            $image.cropper("setData", data);
	        });

	        $("#set-aspect-ratio").click(function() {
	            var aspectRatio = $("#set-aspect-ratio-input").val();

	            $image.cropper("setAspectRatio", aspectRatio);
	        });

	        $("#set-img-src").click(function() {
	            var cropper = $image.data("cropper"),
	                val = $("#set-img-src-input").val();

	            if (val === "img/picture-2.jpg") {
	                cropper.defaults.data = {
	                    y1: 30
	                };
	            } else {
	                cropper.defaults.data = {};
	            }

	            $image.cropper("setImgSrc", val);
	        });

	        $("#get-img-info").click(function() {
	            var data = $image.cropper("getImgInfo"),
	                val = "";

	            try {
	                val = JSON.stringify(data);
	            } catch (e) {
	                console.log(data);
	            }

	            $("#get-img-info-input").val(val);
	        });
	    }());

});
</script>
<script>
	$(".cropper").cropper({
	    aspectRatio: 1.618,
	    done: function(data) {
	        console.log(data);
	    }
	});
</script>

<div style='clear:both'></div>

@stop