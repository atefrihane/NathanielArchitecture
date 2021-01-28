{{-- <div id="mobile-side-menu" class="mobile-side-menu">
	<div class="logo-main" data-menuanchor="home">
		<a href="/"><img src="{{ url('images/icons/logo.svg') }}"></a>
	</div>
	<nav id="mobile-main-nav" class="mobile-main-nav">
		<ul class="list-unstyled menu-list">
			<li id="mobile-portfolio-menu" class="mobile-portfolio-menu">
				<a href="/portfolio"><img src="{{ url('images/icons/portfolio.svg') }}"></a>
			</li>
			<li id="mobile-projects-menu" class="mobile-projects-menu" data-menuanchor="projects">
				<a href="/#mobile-projects-section"><img src="{{ url('images/icons/projects.svg') }}"></a>
			</li>
			<li id="mobile-about-menu" class="mobile-about-menu" data-menuanchor="about">
				<a href="/#mobile-about-section"><img src="{{ url('images/icons/about.svg') }}"></a>
			</li>
			<li id="mobile-admin-menu">
				<a href="/admin"><img src="{{ url('images/icons/client.svg') }}"></a>
			</li>
		</ul>
	</nav>
</div> --}}

@if (request()->is('/'))
	<div id="side-menu" class="side-menu">
		<div class="logo-main" data-menuanchor="home">
			<img src="{{ url('images/icons/logo.svg') }}">
		</div>
		<nav id="main-nav" class="main-nav">
			<ul class="list-unstyled menu-list">
				<li id="portfolio-menu" class="portfolio-menu" onclick="location.href='/portfolio'">
					<img src="{{ url('images/icons/portfolio.svg') }}">
					<span class="c-grey-900">Portfolio</span>
				</li>
				<li id="projects-menu" class="projects-menu" data-menuanchor="projects">
					<img src="{{ url('images/icons/projects.svg') }}">
					<span class="c-grey-900">Projects</span>
				</li>
				<li id="about-menu" class="about-menu" data-menuanchor="about">
					<img src="{{ url('images/icons/about.svg') }}">
					<span class="c-grey-900">About</span>
				</li>
				<li id="admin-menu" onclick="location.href='/admin'">
					<img src="{{ url('images/icons/client.svg') }}">
					<span class="c-grey-900">Admin</span>
				</li>
			</ul>
		</nav>
		<div id="project-tags" class="project-tags">
			<ul class="list-unstyled menu-list">
				<li onclick="showByType(99)">
					<span>All</span>
				</li>
				@foreach ($tags as $tag)
					<li onclick="showByType({{ $tag->id }})">
						<span>{{ $tag->name }}</span>
					</li>
				@endforeach
			</ul>
		</div>
		<div id="page-controls" class="page-controls">
			<ul class="list-unstyled menu-list">
				<li id="forward-menu" class="control-menu">
					<div>
						<img src="{{ url('images/icons/next.svg') }}" onclick="after()">
					</div>
				</li>
				<li id="backward-menu" class="control-menu">
					<div>
						<img src="{{ url('images/icons/previous.svg') }}" onclick="after()">
					</div>
				</li>
				<li id="fullscreen-menu" class="control-menu">
				<div>
					<img src="{{ url('images/icons/fullscreen.svg') }}" onclick="fullscreen()">
				</div>
				</li>
			</ul>
		</div>
	</div>
@endif

@if (request()->is('portfolio'))
	<div id="side-menu" class="side-menu">
		<div class="logo-main" data-menuanchor="home">
			<img src="{{ url('images/icons/logo.svg') }}" onclick="location.href='/'">
		</div>
		<nav id="main-nav" class="main-nav">
			<ul class="list-unstyled menu-list">
				<li id="portfolio-menu" class="portfolio-menu" onclick="location.href='/portfolio'">
					<img src="{{ url('images/icons/portfolio-hover.svg') }}" style="visibility:visible;">
					<span class="c-grey-900" style="visibility:visible;">Portfolio</span>
				</li>
				<li id="projects-menu" class="projects-menu" data-menuanchor="projects" onclick="location.href='/?section=projects'">
					<img src="{{ url('images/icons/projects.svg') }}">
					<span class="c-grey-900">Projects</span>
				</li>
				<li id="about-menu" class="about-menu" data-menuanchor="about" onclick="location.href='/?section=about'">
					<img src="{{ url('images/icons/about.svg') }}">
					<span class="c-grey-900">About</span>
				</li>
				<li id="admin-menu" onclick="location.href='/admin'">
					<img src="{{ url('images/icons/client.svg') }}">
					<span class="c-grey-900">Admin</span>
				</li>
			</ul>
		</nav>
		<div id="project-info" class="project-info">
			<ul class="list-unstyled">
				<li class="mB-20"><strong>Project</strong><br><span id="project-info-name"></span></li>
				<li class="mB-20"><strong>Architect</strong><br><a href="" id="farchitect" style="color: #72777a;"><span id="project-info-architect"></span></a></li>
				<li><strong>Location</strong><br><a href="" id="flocation" style="color: #72777a;"><span id="project-info-location"></span></a></li>
			</ul>
		</div>
		<div id="page-controls" class="page-controls controls-portfolio">
			<ul class="list-unstyled menu-list">
				<li class="turnback">
					<img src="{{ url('images/icons/back.svg') }}" onclick="location.href='/'">
				</li>
				<li class="project-count">
					<span class="count"></span>
				</li>
				<li id="forward-menu" class="control-menu">
					<div>
						<img src="{{ url('images/icons/next.svg') }}" onclick="after()">
					</div>
				</li>
				<li id="backward-menu" class="control-menu">
					<div>
						<img src="{{ url('images/icons/previous.svg') }}" onclick="before()">
					</div>
				</li>
				<li id="select-photo">
					<img src="{{ url('images/icons/select.svg') }}" onclick="selectPhoto()">
				</li>
				<li id="make-pdf">
					<img src="{{ url('images/icons/pdf.svg') }}" onclick="makePDF()">
					<span class="badge" id="badge">0</span>
				</li>
				<li id="fullscreen-menu" class="control-menu">
					<div>
						<img src="{{ url('images/icons/fullscreen.svg') }}" onclick="fullscreen()">
					</div>
				</li>
			</ul>
		</div>
	</div>
@endif

@if (request()->is('projects/*'))
	<div id="side-menu" class="side-menu">
		<div class="logo-main" data-menuanchor="home">
			<img src="{{ url('images/icons/logo.svg') }}" onclick="location.href='/'">
		</div>
		<nav id="main-nav" class="main-nav">
			<ul class="list-unstyled menu-list">
				<li id="portfolio-menu" class="portfolio-menu" onclick="location.href='/portfolio'">
					<img src="{{ url('images/icons/portfolio.svg') }}">
					<span class="c-grey-900">Portfolio</span>
				</li>
				<li id="projects-menu" class="projects-menu" data-menuanchor="projects" onclick="location.href='/?section=projects'">
					<img src="{{ url('images/icons/projects.svg') }}">
					<span class="c-grey-900">Projects</span>
				</li>
				<li id="about-menu" class="about-menu" data-menuanchor="about" onclick="location.href='/?section=about'">
					<img src="{{ url('images/icons/about.svg') }}">
					<span class="c-grey-900">About</span>
				</li>
				<li id="admin-menu" onclick="location.href='/admin'">
					<img src="{{ url('images/icons/client.svg') }}">
					<span class="c-grey-900">Admin</span>
				</li>
			</ul>
		</nav>
		<div id="project-info" class="project-info">
			<ul class="list-unstyled">
				<li class="mB-20"><strong>Project</strong><br>{{ $project->name }}</li>
				<li class="mB-20"><strong>Architect</strong><br><a href="/?section=projects&sarchitect={{ str_slug($project->architect) }}" style="color: #72777a;">{{ $project->architect }}</a></li>
				<li><strong>Location</strong><br><a href="/?section=projects&slocation={{ str_slug($project->location) }}" style="color: #72777a;">{{ $project->location }}</a></li>
			</ul>
		</div>
		<div id="page-controls" class="page-controls controls-portfolio">
			<ul class="list-unstyled menu-list">
				<li class="turnback">
					<img src="{{ url('images/icons/back.svg') }}" onclick="location.href='/'">
				</li>
				<li class="project-count">
					<span class="count"></span>
				</li>
				<li id="forward-menu" class="control-menu">
					<div>
						<img src="{{ url('images/icons/next.svg') }}" onclick="after()">
					</div>
				</li>
				<li id="backward-menu" class="control-menu">
					<div>
						<img src="{{ url('images/icons/previous.svg') }}" onclick="before()">
					</div>
				</li>
				<li id="select-photo">
					<img src="{{ url('images/icons/select.svg') }}" onclick="selectPhoto()">
				</li>
				<li id="make-pdf">
					<img src="{{ url('images/icons/pdf.svg') }}" onclick="makePDF()">
					<span class="badge" id="badge">0</span>
				</li>
				<li id="fullscreen-menu" class="control-menu">
					<div>
						<img src="{{ url('images/icons/fullscreen.svg') }}" onclick="fullscreen()">
					</div>
				</li>
			</ul>
		</div>
	</div>
@endif
