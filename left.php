
	<div class="left-side-bar" style="background-color: #3d56d8">
		<div>
			<img src="images/logo5.png" alt="">

			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<?php
					   $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
					?>
					<li>
						<a href="dashboard.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/dashboard.png"></span><span class="mtext"> Dashboard </span> </a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="sidebar-small-cap">Activity</div>
					</li>
					<!-- <li>
						<a href="#" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/authentication.png"></span><span class="mtext"> Authorization </span> </a>
					</li>
					<li>
						<a href="#" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/reservation.png"></span><span class="mtext"> Reservation </span> </a>
					</li> -->
					<li>
						<a href="charging_session_statistics.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/sessions.png"></span><span class="mtext">Live Charging Sessions </span> </a>
					</li>
					<li>
						<a href="chargepoints.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/chargingpoints.png"></span><span class="mtext"> Charge Points </span> </a>
					</li>
					<li>
						<a href="transaction.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/transactions.png"></span><span class="mtext">Transactions </span> </a>
					</li>
					<li>
						<a href="users.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/authentication.png"></span><span class="mtext"> Users </span> </a>
					</li>
					<li>
						<a href="addusers.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/sessions.png"></span><span class="mtext"> RFID </span> </a>
					</li>

					<li>
						<div class="dropdown-divider"></div>
					</li>

					<li>
						<div class="sidebar-small-cap">Assets</div>
					</li>

					<li>
						<a href="cms.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/sessions.png"></span><span class="mtext"> CMS </span> </a>
					</li>
					<li>
						<a href="cpo.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/chargingnetworks.png"></span><span class="mtext"> CPO </span> </a>
					</li>

					<li>
						<a href="stations.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/chargingpoints.png"></span><span class="mtext"> Stations </span> </a>
					</li>
					<li>
						<a href="chargers.php" class="dropdown-toggle no-arrow"><span class="micon"><img src="images/icons/chargingzones.png"></span><span class="mtext"> Chargers </span> </a>
					</li>
					<!-- <li>
						<a href="#" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/chargingzones.png"></span><span class="mtext"> Charging Zones </span> </a>
					</li> -->


					<li>
						<div class="dropdown-divider"></div>
					</li>

					<li>
						<div class="sidebar-small-cap"> Reports </div>
					</li>

					<li>
						<a href="history.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/charginghistory.png"></span><span class="mtext"> History </span>	</a>
					</li>

					<li>
						<a href="earnings.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/earnings.png"></span><span class="mtext"> Earnings </span> </a>
					</li>
					<li>
						<a href="faults.php" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/faults.png"></span><span class="mtext"> Fault </span> </a>
					</li>

					<!-- <li>
						<div class="sidebar-small-cap">CRM</div>
					</li>


					<li><a href="#" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/users.png"></span><span class="mtext"> Users </span> </a></li>

					<li><a href="#" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/rfid.png"></span><span class="mtext"> RFID Tags </span> </a></li>

					<li><a href="#" class="dropdown-toggle no-arrow"> <span class="micon"><img src="images/icons/receipts.png"></span><span class="mtext"> Receipts </span> </a></li> -->

					<!-- <li class="dropdown">
						<a class="dropdown-toggle">
							<span class="micon"><img src="images/icons/sld.png"></span><span class="mtext"> Station Management </span>
						</a>
						<ul class="submenu">
							<li><a href="bylocation.php"> By Location </a></li>
							<li><a href="bynetwork.php"> By Network </a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle">
							<span class="micon"><img src="images/icons/reports.png"></span><span class="mtext"> Reports </span>
						</a>
						<ul class="submenu">
							<li><a href="graphical_overview.php"> Chart </a></li>
							<li>
							<?php
								if($curPageName=='charging_points.php')
								{
									?><a> Charging Points </a><?php
								}
								else
								{
									?><a href="charging_points.php"> Charging Points </a><?php
								}
							?>
							</li>
							<li><a href="charging_session_statistics.php"> Charging Session Statistics </a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle">
							<span class="micon"><img src="images/icons/reports.png"></span><span class="mtext"> CRM </span>
						</a>
						<ul class="submenu">
							<li><a href="#"> Users </a></li>
							<li><a href="#"> RFID Tags </a></li>
							<li><a href="#"> Receipts </a></li>
						</ul>
					</li> -->
					
				</ul>
			</div>

		</div>
	</div>
	<div class="mobile-menu-overlay"></div>