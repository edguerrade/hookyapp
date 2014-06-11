<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Edgar F. Guerra">

<title>[@yield('headtitle', 'WebApp')] HookyApp : Attendance control</title>

{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}
{{-- HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css"> --}}
{{ HTML::style('//netdna.bootstrapcdn.com/bootswatch/3.1.1/yeti/bootstrap.min.css') }}
{{-- HTML::style('//netdna.bootstrapcdn.com/bootswatch/3.0.3/yeti/bootstrap.min.css') --}}

{{-- HTML::style('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css') --}}

{{ HTML::style('assets/css/selectize.bootstrap3.css') }}

{{ HTML::style('//cdn.datatables.net/1.10.0/css/jquery.dataTables.css') }}
{{ HTML::style('//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.css') }}

{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.0/fullcalendar.css') }}
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.0/fullcalendar.print.css') }}

{{ HTML::style('assets/css/cropper.min.css') }}

{{-- HTML::style('//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/skins/flat/blue.css') --}}
{{ HTML::style('assets/css/square/blue.css') }}
{{ HTML::style('assets/css/square/green.css') }}
{{ HTML::style('assets/css/square/grey.css') }}
{{ HTML::style('assets/css/square/red.css') }}

<style>
	#wrap {
		width: 1100px;
		margin: 0 auto;
		}
		
	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
		}
		
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}
		
	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}

	#calendar {
		float: right;
		width: 900px;
		}

	.tree li {
	    list-style-type:none;
	    margin:0;
	    padding:10px 5px 0 5px;
	    position:relative
	}
	.tree li::before, .tree li::after {
	    content:'';
	    left:-20px;
	    position:absolute;
	    right:auto
	}
	.tree li::before {
	    border-left:1px solid #999;
	    bottom:50px;
	    height:100%;
	    top:0;
	    width:1px
	}
	.tree li::after {
	    border-top:1px solid #999;
	    height:20px;
	    top:25px;
	    width:25px
	}
	.tree li span {
	    border:1px solid #999;
	    display:inline-block;
	    padding:6px 8px;
	    text-decoration:none
	}
	.tree li.parent_li>span {
	    cursor:pointer
	}
	.tree>ul>li::before, .tree>ul>li::after {
	    border:0
	}
	.tree li:last-child::before {
	    height:25px
	}
	.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
	    background:#008cba;
	    border:1px solid #94a0b4;
	    color:#ffffff
	}
</style>