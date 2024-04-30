<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- User profile -->
		<!-- End User profile text-->

		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">



				<li>

					<a class="has-arrow " href="#" aria-expanded="false">
						<i class="mdi mdi-file-document-box"></i>
						<span class="hide-menu"> ລາພັກ </span>
					</a>
					<?php

					if ($user_ids == 0) {
					?>
						<ul aria-expanded="false" class="collapse">
							<li><a href="approval_request.php"><i class="fa fa-check-circle-o"></i> ອານຸຍາດ ລາພັກ </a></li>
							<li><a href="check_request.php"><i class="fa fa-list-alt"></i> ກວດສອບລາຍການລາພັກ </a></li>
							<li><a href="RPT_Total_Leave.php"><i class="fa fa-list-alt"></i> ລາຍງານ ລາພັກ </a></li>

						</ul>

					<?php
					} else {



					?>

						<ul aria-expanded="false" class="collapse">
							<li><a href="index.php"><i class="fa fa-external-link"></i> ສະແດງຍອດເຫລືອ </a></li>
							<li><a href="leave_request.php"><i class="fa fa-external-link"></i> ຂໍລາພັກ </a></li>
							<li><a href="tag_time_line.php"><i class="fa fa-map-marker"></i> ຕິດຕາມການເຄື່ອນໄຫວ </a></li>
							<?php

							if (($staff_depart == 12) ) {
							?>
								<li><a href="set_approval.php"><i class="fa fa-check-circle-o"></i> ຕັ້ງຄ່າຜູ້ອານຸຍາດ </a></li>


							<?php
							}

							?>



							<?php
							if ($role_level > 2) {
							?>
								<li><a href="list_tag_timeline.php"><i class="fa fa-map-pin "></i> ສະແດງຂໍ້ມູນການເຄື່ອນໄຫວ </a></li>

							<?php

							}

							if ($staff_depart == 12) {


							?>

								<li><a href="add_timeline_person.php"><i class="fa fa-map-marker "></i> ເພິ່ມ timeline ພະນັກງານ </a></li>
								<!-- <li><a href="find_Staff.php"><i class="mdi mdi-file-document-box"></i> ຂໍລາພັກ ແບບເອກະສານ </a></li> !-->
								<?php
							}
							if ($role_level > 1) {

								if ($staff_depart == 11) {


								?>
									<li><a href="check_leave_depart.php"><i class="fa fa-list-alt"></i> ສະແດງລາພັກຂອງພະແນກ </a></li>
								<?php
								}

								?>

								<li><a href="approval_request.php"><i class="fa fa-check-circle-o"></i> ອານຸຍາດ ລາພັກ </a></li>
							<?php
							}

							?>

							<li><a href="leave_history.php"><i class="fa fa-bar-chart fa-fw"></i> ປະຫວັດລາພັກ </a></li>

							<!-- <li><a href="set_approval.php"><i class="fa fa-check-circle-o"></i> ຈັດການອານຸຍາດ </a></li> !-->

						</ul>
				</li>

				<?php



				?>
				<li>
					<a class="has-arrow " href="#" aria-expanded="false">
						<i class="fa fa-cog"></i>
						<span class="hide-menu"> ຈັດການຂໍ້ມູນລະບົບ </span>
					</a>
					<ul aria-expanded="false" class="collapse">
						<?php
						if ($staff_depart == 12) {
						?>
							<li><a href="depart.php"><i class="fa fa-university"></i> ພະແນກ/ໜ່ວຍງານ </a></li>
							<li><a href="unit.php"><i class="fa fa-th-large"></i> ຝ່າຍ </a></li>
							<li><a href="position.php"><i class="fa fa-address-card"></i> ຕຳແນ່ງ </a></li>
							<li><a href="staff.php"><i class="fa fa-users"></i> ພະນັກງານ </a></li>
							<li><a href="leave_total.php"><i class="fa fa-users"></i> ຈັດການຊົ່ວໂມງລາ </a></li>

						<?php
						}

						if ($staff_depart == 11) {
						?>
							<li><a href="users.php"><i class="fa fa-user-plus"></i> ຜູ້ໃຊ້ລະບົບ </a></li>
							<li><a href="roles_level.php"><i class="fa fa-align-justify"></i> ລະດັບ </a></li>
							<li><a href="depart_email.php"><i class="fa fa-cc"></i> Email ພະແນກ </a></li>

					</ul>
				</li>
		<?php
						}
					}
		?>






		<!--
	<li> 
	<a class="has-arrow " href="#" aria-expanded="false">
	<i class="fa fa-users"></i>
	<span class="hide-menu"> ຈັດການທີມ </span>
	</a> 
	<ul aria-expanded="false" class="collapse"> 
	<li><a href="add_depend.php"><i class="fa fa-users"></i> ຜູກຂໍ້ມູນທີມງານ </a></li> 
	</ul>
	</li>
	!-->


			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
	<!-- Bottom points-->
	<div class="sidebar-footer">
		<!-- item-->
		<a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
		<!-- item-->
		<a href="Logout.php" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
	</div>
	<!-- End Bottom points-->
</aside>