requirejs.config({
    enforceDefine: true,
    paths: {
        jquery: [
            '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min',
            'libs/jquery.min'
        ],
        jqueryui: [
            '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min',
            'libs/jquery-ui.custom.min'
        ],
        bootstrap: [
            '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min',
            'libs/bootstrap.min'
        ],
        fullcalendar: [
            '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.0/fullcalendar.min',
            'libs/fullcalendar.min'
        ],
        moment: [
            '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min',
            'libs/moment.min'
        ]
    },
    shim: {
      	jqueryui: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
      	bootstrap: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
      	fullcalendar: ['jquery', 'jqueryui'],
      	lazyload: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
      	cropper: ['jquery']
    }
});

require([
			'jquery', 
			'jqueryui',
			'bootstrap', 
			'fullcalendar', 
			'moment'
		], function ($) {
	
	console.log("Loaded :)");    
    
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
			defaultView: 'agendaWeek',
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
				
			},
			selectable: true,
			select: function(start, end, allDay) {
	          // endtime = $.fullCalendar.formatDate(end,'h:mm tt');
	          // starttime = $.fullCalendar.formatDate(start,'ddd, MMM d, h:mm tt');
	          // var mywhen = starttime + ' - ' + endtime;
	          $('#createEventModal #apptStartTime').val(start);
	          $('#createEventModal #apptEndTime').val(end);
	          $('#createEventModal #apptAllDay').val(allDay);
	          // $('#createEventModal #when').text(mywhen);
	          $('#createEventModal').modal('show');
	       }
		});

		$('#submitButton').on('click', function(e){
		    // We don't want this to act as a link so cancel the link action
		    e.preventDefault();

		    doSubmit();
		  });

		function doSubmit(){
			$("#createEventModal").modal('hide');
			console.log($('#apptStartTime').val());
			console.log($('#apptEndTime').val());
			console.log($('#apptAllDay').val());
			alert("form submitted");

			$("#calendar").fullCalendar('renderEvent',
				{
					title: $('#patientName').val(),
					start: new Date($('#apptStartTime').val()),
					end: new Date($('#apptEndTime').val()),
					allDay: ($('#apptAllDay').val() == "true"),
				},
			true);
		}
		
	});
    
    return {};
});