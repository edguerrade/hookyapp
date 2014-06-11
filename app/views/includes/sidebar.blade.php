<!-- sidebar nav -->
<nav id="sidebar-nav">
	<p class="lead">Datos</p>
	<ul class="nav nav-pills nav-stacked">
		<li {{ (Request::is('attendance') ? 'class="active"' : '') }}><a href="{{ URL::to('attendance') }}">Asistencia</a></li>
		<li {{ (Request::is('users') ? 'class="active"' : '') }}><a href="{{ URL::to('users') }}">Usuarios</a></li>
		<li {{ (Request::is('tutorials') ? 'class="active"' : '') }}><a href="{{ URL::to('tutorials') }}">Tutorías</a></li>
		<li {{ (Request::is('classes') ? 'class="active"' : '') }}><a href="{{ URL::to('classes') }}">Clases</a></li>
		<li {{ (Request::is('lessons') ? 'class="active"' : '') }}><a href="{{ URL::to('lessons') }}">Lecciones</a></li>
		<li {{ (Request::is('groups') ? 'class="active"' : '') }}><a href="{{ URL::to('groups') }}">Grupos y permisos</a></li>
	</ul>
</nav>