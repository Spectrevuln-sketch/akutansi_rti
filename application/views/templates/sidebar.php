	<!-- Sidebar -->
	<div class="sidebar sidebar-style-2">
		<div class="sidebar-wrapper scrollbar scrollbar-inner">
			<div class="sidebar-content">
				<!-- <div class="user">
					<div class="avatar-sm float-left mr-2">
						<img src="<?= base_url('assets/'); ?>img/profile.jpg" alt="..." class="avatar-img rounded-circle">
					</div>
					<div class="info">
						<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span>
								Hizrian
								<span class="user-level">Administrator</span>
								<span class="caret"></span>
							</span>
						</a>
						<div class="clearfix"></div>

						<div class="collapse in" id="collapseExample">
							<ul class="nav">
								<li>
									<a href="#profile">
										<span class="link-collapse">My Profile</span>
									</a>
								</li>
								<li>
									<a href="#edit">
										<span class="link-collapse">Edit Profile</span>
									</a>
								</li>
								<li>
									<a href="#settings">
										<span class="link-collapse">Settings</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div> -->
				<ul class="nav nav-primary">
					<li class="nav-item active">
						<a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
							<i class="fas fa-home"></i>
							<p>Dashboard</p>
							<span class="caret"></span>
						</a>
						<div class="collapse" id="dashboard">
							<ul class="nav nav-collapse">
								<li>
									<a href="#">
										<span class="sub-item">Analystics</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-section">
						<span class="sidebar-mini-icon">
							<i class="fa fa-ellipsis-h"></i>
						</span>
						<h4 class="text-section">Components</h4>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('user/invoice'); ?>">
							<i class="fas fa-layer-group"></i>
							<p>Input invoice</p>
						</a>
					</li>
					<li class="nav-item">
						<a data-toggle="collapse" href="#sidebarLayouts">
							<i class="fas fa-th-list"></i>
							<p>Filter Search</p>
							<span class="caret"></span>
						</a>
						<div class="collapse" id="sidebarLayouts">
							<ul class="nav nav-collapse">
								<li>
									<a href="<?= base_url('customer'); ?>">
										<span class="sub-item">Filter By Customer</span>
									</a>
								</li>
								<li>
									<a href="<?= base_url('agen'); ?>">
										<span class="sub-item">Filter By Agen</span>
									</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- End Sidebar -->