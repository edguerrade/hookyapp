@extends('layouts.default')
@section('headtitle')
CRUD
@stop
@section('requirejs')
home
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

        <div id="createEventModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel1">Create Appointment</h3>
            </div>
            <div class="modal-body">
            <form id="createAppointmentForm" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" for="inputPatient">Patient:</label>
                    <div class="controls">
                        <input type="text" name="patientName" id="patientName" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="['Value 1','Value 2','Value 3&quot;]">
                          <input type="hidden" id="apptStartTime"/>
                          <input type="hidden" id="apptEndTime"/>
                          <input type="hidden" id="apptAllDay" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="when">When:</label>
                    <div class="controls controls-row" id="when" style="margin-top:5px;">
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
            </div>
        </div>
    </div>
    <div style='clear:both'></div>

@stop