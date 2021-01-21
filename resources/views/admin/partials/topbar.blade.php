<div class="header navbar">
	<div class="header-container">
		<ul class="nav-left">
			<li>
				<a href="javascript:void(0);" id="sidebar-toggle" class="sidebar-toggle">
					<i class="ti-menu"></i>
				</a>
			</li>
		</ul>
		<ul class="nav-right">
			<li class="dropdown">
				<a href="{{ route('logout') }}" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1"
				onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<div class="peer">
						<span class="icon-holder mR-10">
							<i class="c-blue-500 ti-share"></i>
						</span>
						<span class="fsz-sm c-grey-900">Logout</span>
					</div>
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</li>
		</ul>
	</div>
</div>