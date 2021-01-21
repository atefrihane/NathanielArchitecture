<div class="sidebar">
	<div class="sidebar-inner">
		<div class="sidebar-logo">
			<div class="peers ai-c fxw-nw">
				<div class="peer peer-greed">
					<a href="{{ route('admin.index') }}" class="sidebar-link td-n">
						<div class="peers ai-c fxw-nw">
							<div class="peer">
								<div class="logo">
									<img src="/images/logo.png" alt="Nathaniel McMahon">
								</div>
							</div>
							<div class="peer peer-greed">
								<h5 class="lh-1 mB-0 logo-text">Nathaniel McMahon</h5>
							</div>
						</div>
					</a>
				</div>
				<div class="peer">
					<div class="mobile-toggle sidebar-toggle">
						<a href="#" class="td-n">
							<i class="ti-arrow-circle-left"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<ul class="sidebar-menu scrollable pos-r">
			@include('admin.partials.menu')
		</ul>
	</div>
</div>