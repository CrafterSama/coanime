		<nav id="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
	            <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle">
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	            </button>
          	</div>
          	<div class="navbar-inverse side-collapse in">
	            <nav role="navigation" class="navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="/"><i class="fa fa-home"></i>&nbsp;&nbsp;Inicio</a></li>
						<!-- li><a href="/enciclopedia"><i class="fa fa-book"></i>&nbsp;&nbsp;Enciclopedia</a></li>
						<li><a href="/eventos"><i class="fa fa-group"></i>&nbsp;&nbsp;Eventos</a></li -->
						@if (Auth::check())
							<li id="adminweb" class="navbar-right"><a href="/dashboard"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Administrar</a></li>
						@endif
					</ul>
	            </nav>
          	</div>
		</nav>
