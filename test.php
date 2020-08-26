<input type='hidden' name="test" value="<?php echo $_SESSION['host_domain'];?>">
<input type='hidden' name="test" value="<?php echo $_SESSION['user_type'];?>">
<div id="left_nav">
	<?php 
	if($top_menu_active=="overview")
	{
	?>
	<div class="nav_div non-group" id="nav_dashboard">
		<div class="nav_content" style="<?php echo @$ln_active_dashboard;?>;">
			<a href="<?php echo BASE_PATH;?>/dashboard">
				<div class="left_nav">Admin Dashboard</div>
			</a>
		</div>
	</div>
			
	<div class="nav_div non-group" id="nav_resources">
		<div class="nav_content" style="<?php echo @$ln_resources;?>;">
			<a href="<?php echo BASE_PATH;?>/resources">
				<div class="left_nav">Resources</div>
			</a>
		</div>
	</div>
	
	<div class="nav_div non-group" id="nav_pushnotification">
		<div class="nav_content" style=""> 
			<a href="<?php echo BASE_PATH;?>/pushnotification">
				<div class="left_nav">Push Notification</div>
			</a>
		</div>
		<div class="nav_div_submenu<?php if($leftpanel=="push_notification") echo "_active";?>">
			<a href="<?php echo BASE_PATH;?>/pushnotification">
				<div class="nav_div_submenu_item<?php echo @$ln_active_send_push;?>">
					Send Push Notification
				</div>
			</a>
	
			<a href="<?php echo BASE_PATH;?>/pushnotification/push_history">
				<div class="nav_div_submenu_item<?php echo @$ln_active_push_history;?>">
					Push Notification History
				</div>
			</a>
		</div>
	</div>

	<div class="nav_div non-group" id="nav_cmsuser">
		<div class="nav_content" style="<?php echo @$ln_active_cmsuser;?>;">
			<a href="<?php echo BASE_PATH;?>/users">
				<div class="left_nav">Manage Users</div>
			</a>
		</div>
	</div>	
	
	<div class="nav_div non-group" id="nav_profile">
		<div class="nav_content" style="<?php echo @$ln_active_profile;?>;">
			<a href="<?php echo BASE_PATH;?>/profile">
				<div class="left_nav">Profile</div>
			</a>
		</div>
		<div class="nav_div_submenu<?php if($leftpanel=="profile") echo "_active";?>" id="sub_menu_profile">
			<a href="<?php echo BASE_PATH;?>/profile"><div class="nav_div_submenu_item<?php echo @$submenu_profile_info;?>">Info</div></a>
			<a href="<?php echo BASE_PATH;?>/menu/manage_menu"><div class="nav_div_submenu_item<?php echo @$submenu_profile_menu;?>">Menu</div></a>
			<a href="<?php echo BASE_PATH;?>/profile/appearance"><div class="nav_div_submenu_item<?php echo @$submenu_profile_appearance;?>">Appearance</div></a>
			<a href="<?php echo BASE_PATH;?>/profile/important_phones"><div class="nav_div_submenu_item<?php echo @$submenu_profile_impt_phones;?>">City Contact</div></a>
		</div>
	</div>
	
	
	
	<?php
	$dyn_menu_id_title = $html_controller = array();
	$default_menu_id_title = array();
	foreach($html_menus as $dyn_menus)
	{
		if($dyn_menus['type']=="html" || $dyn_menus['type']=="html_tabbed")
		{
			$dyn_menu_id_title[$dyn_menus['id']] = $dyn_menus['title'];
			$html_controller[$dyn_menus['id']] = ($dyn_menus['type']=="html")?"html":"html_tabbed";
		}
		else
		{
			//if($dyn_menus['type']!="calendar" && $dyn_menus['type']!="my_report")
			if($dyn_menus['type']!="my_report")
			{
				$default_menu_id_title[$dyn_menus['type']][$dyn_menus['id']] = $dyn_menus['title'];
			}
		}
	}
	//echo "<pre>";
	//print_r($default_menu_id_title);
	$biz_menu_ids = "";
	$rai_menu_ids = "";
	$opinions_menu_ids = "";


	$civic_engagement_list = array("businesses","calendar","city_hall","html","html_tabbed","news","notice_bulletin","opinion","people_object","places");
	$report_issues_list = array("report_issue","my_report");
	$waste_management_list = array("myrecycle");
	$public_safety_list = array("alarm","civic_eye","onp","patrol","eagle_eye");  

	$civic_engagement = array();
	$report_issues = array();
	$waste_management = array();
	$public_safety = array();   

	foreach($civic_engagement_list as $item) {
		if(array_key_exists($item, $default_menu_id_title)) {				
			array_push($civic_engagement, $default_menu_id_title[$item]);
		}
	}

	foreach($report_issues_list as $item) {
		if(array_key_exists($item, $default_menu_id_title)) {				
			array_push($report_issues, $default_menu_id_title[$item]);
		}
	}

	foreach($waste_management_list as $item) {
		if(array_key_exists($item, $default_menu_id_title)) {				
			array_push($waste_management, $default_menu_id_title[$item]);
		}
	}

	foreach($public_safety_list as $item) {
		if(array_key_exists($item, $default_menu_id_title)) {				
			array_push($public_safety, $default_menu_id_title[$item]);
		}
	}

	$has_civic_engagement = count($civic_engagement) > 0;
    $has_report_issues = count($report_issues) > 0;
    $has_waste_management = count($waste_management) > 0;
    $has_public_safety = count($public_safety) > 0;

	$not_common_menutype = array("businesses","report_issue","5","booking","alarm","patrol","eagle_eye","civic_eye","onp","myrecycle");
	
	if($has_civic_engagement) {
		echo '<div class="tt-collapse-panel tt-collapsed" id="civic_engagement"><span class="tt-menu-group">Civic Engagement<span class="tt-icon click-through"></span></span>';
		foreach($civic_engagement as $mk => $mv)
		{
			echo '<div id="menu_type_container_'.$mk.'" style="float:left;width:100%;">';
			foreach($mv as $mkey => $mitem)
			{				
				$sub_menu_manage_category = true;
				$sub_menu_settings = false;
				switch($mk)
				{
					case 0:
						$controller_name = "business";
						$nav_icon = "ln_news.png";
						break;
					case 1:
						$controller_name = "calendar";
						$nav_icon = "ln_calendar.png";
						break;							
					case 2:
						$controller_name = "city_hall";
						$nav_icon = "ln_cityhall.png";
						$sub_menu_settings = true;
						break;					
					case 3:
						$controller_name = "news";
						$nav_icon = "ln_news.png";
						break;
					case 4:
						$controller_name = "notice_bulletin";
						$nav_icon = "ln_cityhall.png";
						break;
					case 5:
						$controller_name = "cms_opinion";
						$nav_icon = "ln_calendar.png";
						break;						
					case 6:
						$controller_name = "people_object";
						$nav_icon = "ln_cityhall.png";
						$sub_menu_manage_category = false;
						$sub_menu_settings = true;
						break;
					case 7:
						$controller_name = "places";
						$nav_icon = "ln_places.png";
						$sub_menu_settings = true;
						break;					
					
				}				
								
				if(!in_array($mk, $not_common_menutype))
				{					
				?>
				<div class="nav_div" style="float:left;" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkey;?>"><?php echo $mitem;?></div>
						</a>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_add_<?php echo $mkey;?>">Add/Edit</div></a>
						<?php if($sub_menu_manage_category){ ?>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_category/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_<?php echo $mkey;?>">Manage Category</div></a>
						<?php } ?>
						<?php if($sub_menu_settings){ ?>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/settings/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_setting_<?php echo $mkey;?>">Settings</div></a>
						<?php } ?>
					</div>
				</div>
				<?php
				}				
				elseif($mk == "businesses")
				{
				$biz_menu_ids .= ($biz_menu_ids=="")?$mkey:",".$mkey;
				?>
				<div class="nav_div" style="float:left;" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkey;?>"><?php echo $mitem;?></div>
						</a>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_add_<?php echo $mkey;?>">Add/Edit</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_category/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_<?php echo $mkey;?>">Manage Category</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/claim_businesses/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_moderator_<?php echo $mkey;?>">Moderator</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/web_settings/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_web_<?php echo $mkey;?>">Settings</div></a>
					</div>
				</div>
				<input type='hidden' id='biz_menu_ids' name='biz_menu_ids' value='"<?php echo $biz_menu_ids;?>"'>
				<?php
				}				
				elseif($mk == "opinion" || $mk == 5)
				{
				$opinions_menu_ids .= ($opinions_menu_ids=="")?$mkey:",".$mkey;
				?>
				<div class="nav_div" style="float:left;" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/list_topics/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkey;?>"><?php echo $mitem;?></div>
						</a>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/list_topics/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_list_<?php echo $mkey;?>">List of Topics</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/new_topic/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_new_<?php echo $mkey;?>">Submit New Topic</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/submitted_topics/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_submitted_<?php echo $mkey;?>">Submitted Topics</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/disapproved_hold_topics/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_disapproved_<?php echo $mkey;?>">Disapprove Topics</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/settings/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_setting_<?php echo $mkey;?>">Settings</div></a>
					</div>
				</div>
				<input type='hidden' id='opinions_menu_ids' name='opinions_menu_ids' value='"<?php echo $opinions_menu_ids;?>"'>
				<?php
				}					
			}
			echo "</div>";
		}	
		?>
		<div id="menu_items">
		<?php if(count($dyn_menu_id_title) != 0)
		{
			foreach($dyn_menu_id_title as $dyn_menu_id => $dyn_menu_title)
			{
			?>
			<div class="nav_div" id="dyn_menu_div_<?php echo $dyn_menu_id;?>">
				<div style="float:left;width:97%;" id="dyn_menu_item_<?php echo $dyn_menu_id;?>">
				<a href="<?php echo BASE_PATH;?>/menu/<?php echo $html_controller[$dyn_menu_id];?>/<?php echo $dyn_menu_id;?>">
					<div class="left_nav tt-menu-group-item" id="dyn_menu_title_<?php echo $dyn_menu_id;?>"><?php echo $dyn_menu_title;?></div>			
				</a>
				</div>			
			</div>
			<?php
			}
		}
		?>			
		</div>
		<?php
		echo '</div>';
	}

	if($has_report_issues) {
		if(array_key_exists("report_issue", $default_menu_id_title))
		{
			$controller_ce = "report_an_issue";
			$controller_name = "rai_v3";
			$nav_icon = "ln_news.png";
			
			echo '<div class="tt-collapse-panel tt-collapsed" id="report_issue" style="margin-top: -6px;"><span class="tt-menu-group">Report Issues<span class="tt-icon click-through"></span></span>';
			echo '<div id="menu_type_container_report_issue" style="float:left;width:100%;">';
			$flag = 0;
			foreach($default_menu_id_title['report_issue'] as $mkeyRai => $mitemRai)
			{
				$rai_menu_ids .= ($rai_menu_ids=="")?$mkeyRai:",".$mkeyRai;
				?>
				<div class="nav_div" style="float:left;" id="dyn_menu_div_<?php echo $mkeyRai;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkeyRai;?>">
<!--						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkeyRai;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>"><?php echo $mitemRai;?></div>
						</a>-->
                                            
                                            <?php if($flag == 0){ ?>
                                            <div class="tt-collapse-panel" id="report_issue" style="margin-top: -6px;"><span class="tt-menu-group">Report an issue<span class="tt-icon click-through"></span></span>
                                                <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkeyRai;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>">Manage Report</div>
						</a>
                                                <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/submit_report/<?php echo $mkeyRai;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>">Submit</div>
						</a>
                                                <div class="tt-collapse-panel" id="report_issue_manage" style="margin-top: -6px;"><span class="tt-menu-group">Manage<span class="tt-icon click-through"></span></span>
                                                    <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_department/<?php echo $mkeyRai;?>">
                                                            <div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>">Department</div>
                                                    </a>
                                                    <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_issue_type/<?php echo $mkeyRai;?>">
                                                            <div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>">Issue type</div>
                                                    </a>
                                                    <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_issue_subtype/<?php echo $mkeyRai;?>">
                                                            <div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>">Issue Subtype</div>
                                                    </a>
                                                    <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_staff/<?php echo $mkeyRai;?>">
                                                            <div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>">Staff</div>
                                                    </a>
                                                </div>
                                                <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/analytics/<?php echo $mkeyRai;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>">Analytics</div>
						</a>
                                                <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/settings/<?php echo $mkeyRai;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkeyRai;?>">Settings</div>
						</a>
                                            </div>
                                            <?php $flag = 1; } ?>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkeyRai;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_reported_<?php echo $mkeyRai;?>">Reported Issue</div></a>
						<?php if($_SESSION['city_id']=="46c51ac393629ccd9a654031bdbaad9e" || $_SESSION['city_id']=="a248988373588bd873393dc6a7546ba4" || preg_match('/cmslivetest/i',strtolower($_SERVER['HTTP_HOST']))) {

						$public_safety_label = ($_SESSION['city_id']=="a248988373588bd873393dc6a7546ba4")?"Code Enforcement":"Public Safety";
						?>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_ce;?>/code_enforcement/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_parking_<?php echo $mkeyRai;?>"><?php echo $public_safety_label;?></div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_ce;?>/print_que/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_printque_<?php echo $mkeyRai;?>">Print Queue</div></a>
						<?php
						}
						if($ask_a_q_tab=="yesno")
						{

						?>
						<a href="<?php echo BASE_PATH;?>/aaq/index/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_analytics_<?php echo $mkeyRai;?>">Ask A Question</div></a>
						<?php

						}
                                               
/*						?>
                                                
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/analytics/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_analytics_<?php echo $mkeyRai;?>">Analytics</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_department/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_dept_<?php echo $mkeyRai;?>">Manage Department</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_issue_type/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_issue_<?php echo $mkeyRai;?>">Manage Issue Type</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_issue_subtype/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_issue_sub_<?php echo $mkeyRai;?>">Manage Issue SubType</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_staff_new/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_staff_<?php echo $mkeyRai;?>">Manage Staff</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/submit_report/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_submit_report_<?php echo $mkeyRai;?>">Submit A Report</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/settings/<?php echo $mkeyRai;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_setting_<?php echo $mkeyRai;?>">Settings</div></a>
                                                <?php
						*/
						?>
                                        </div>
				</div>
				<input type='hidden' id='rai_menu_ids' name='rai_menu_ids' value='"<?php echo $rai_menu_ids;?>"'>
				<?php
				
			}
			echo "</div></div>";
			unset($default_menu_id_title['report_issue']);
		}
	}

	if($has_waste_management) {
		echo '<div class="tt-collapse-panel tt-collapsed" id="waste_management"><span class="tt-menu-group">Waste Management<span class="tt-icon click-through"></span></span>';
		foreach($waste_management as $mk => $mv)
		{
			echo '<div id="menu_type_container_'.$mk.'" style="float:left;width:100%;">';
			foreach($mv as $mkey => $mitem)
			{
				$sub_menu_manage_category = true;
				$sub_menu_settings = false;
				switch($mk)
				{					
					case 0:
						$controller_name = "myrecycle";
						$nav_icon = "ln_calendar.png";
						break;
				}				
								
				if(!in_array($mk,$not_common_menutype))
				{
				?>
				<div class="nav_div" style="float:left;" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkey;?>"><?php echo $mitem;?></div>
						</a>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_add_<?php echo $mkey;?>">Add/Edit</div></a>
						<?php if($sub_menu_manage_category){ ?>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_category/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_<?php echo $mkey;?>">Manage Category</div></a>
						<?php } ?>
						<?php if($sub_menu_settings){ ?>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/settings/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_setting_<?php echo $mkey;?>">Settings</div></a>
						<?php } ?>
					</div>
				</div>
				<?php
				}				
				elseif($mk == "myrecycle")
				{
                                    $controller_name = "waste_wiki";
						
				?>
				<div class="nav_div" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<!--<a href="javascript:void(0);" onclick="authenticate_recycle(<?php echo $mkey;?>);"> -->
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item"><?php echo $mitem;?></div>
						</a>
					</div>
                                    <div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
                                        <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>"><div style="text-transform:capitalize;" class="nav_div_submenu_item" id="nav_div_submenu_suggested_<?php echo $mkey;?>">Suggested Meterials</div></a>
                                        <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/materials/<?php echo $mkey;?>"><div style="text-transform:capitalize;" class="nav_div_submenu_item" id="nav_div_submenu_materials_<?php echo $mkey;?>">Materials</div></a>
                                        <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/streams/<?php echo $mkey;?>"><div style="text-transform:capitalize;" class="nav_div_submenu_item" id="nav_div_submenu_streams_<?php echo $mkey;?>">Streams</div></a>
                                        <a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/depots/<?php echo $mkey;?>"><div style="text-transform:capitalize;" class="nav_div_submenu_item" id="nav_div_submenu_depots_<?php echo $mkey;?>">Depots</div></a>
                                    </div>
				</div>
				<?php
				}		
			}
			echo "</div>";
		}	
		echo '</div>';
	}

	if($has_public_safety) {
		echo '<div class="tt-collapse-panel tt-collapsed" id="public_safety"><span class="tt-menu-group">Public Safety<span class="tt-icon click-through"></span></span>';
		foreach($public_safety as $mk => $mv)
		{
			echo '<div id="menu_type_container_'.$mk.'" style="float:left;width:100%;">';
			foreach($mv as $mkey => $mitem)
			{
				$sub_menu_manage_category = true;
				$sub_menu_settings = false;
				switch($mk)
				{					
					case 0:
						$controller_name = "alarm";
						$nav_icon = "ln_calendar.png";
						break;
					case 3:
						$controller_name = "patrol";
						$nav_icon = "ln_calendar.png";
						break;
					case 4:
					case 1:
						$controller_name = "eagle_eye";
						$nav_icon = "ln_calendar.png";
						break;
					case 2:
						$controller_name = "onp";
						$nav_icon = "ln_calendar.png";
						break;
				}				
						
				if(!in_array($controller_name,$not_common_menutype))
				{
				?>
				<div class="nav_div" style="float:left;" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkey;?>"><?php echo $mitem;?></div>
						</a>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_add_<?php echo $mkey;?>">Add/Edit</div></a>
						<?php if($sub_menu_manage_category){ ?>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_category/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_<?php echo $mkey;?>">Manage Category</div></a>
						<?php } ?>
						<?php if($sub_menu_settings){ ?>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/settings/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_setting_<?php echo $mkey;?>">Settings</div></a>
						<?php } ?>
					</div>
				</div>
				<?php
				}
				elseif($controller_name == "alarm" || $controller_name == "patrol" || $controller_name == "eagle_eye" || $controller_name == "civic_eye")
				{
				?>
				<div class="nav_div" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item"><?php echo $mitem;?></div>
						</a>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>"><div style="text-transform:capitalize;" class="nav_div_submenu_item" id="nav_div_submenu_list_<?php echo $mkey;?>">List <?php echo ucwords(str_replace("_"," ",$controller_name));?></div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/manage_staff/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_manage_staff_<?php echo $mkey;?>">Manage Staff</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/settings/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_setting_<?php echo $mkey;?>">Settings</div></a>
					</div>
				</div>
				<?php
				}
				elseif($controller_name == "onp")
				{
				?>
				<div class="nav_div" style="float:left;" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkey;?>"><?php echo $mitem;?></div>
						</a>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/index/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_exemption_log_<?php echo $mkey;?>">Exemption Log</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/new_ext_request/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_request_<?php echo $mkey;?>">New/Ext. Request</div></a>
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/holiday/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_holiday_<?php echo $mkey;?>">Holiday List</div></a>
						<!--<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/rules/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_moderator_<?php echo $mkey;?>">Rules</div></a>-->
						<a href="<?php echo BASE_PATH;?>/<?php echo $controller_name;?>/settings/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_settings_<?php echo $mkey;?>">Settings</div></a>
					</div>
				</div>
				<?php
				}
				elseif($controller_name == "booking")
				{					
				?>
				<div class="nav_div" style="float:left;" id="dyn_menu_div_<?php echo $mkey;?>">
					<div class="nav_content" style="" id="nav_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/managerequest/index/<?php echo $mkey;?>">
							<div class="left_nav tt-menu-group-item" id="menu_type_<?php echo $mkey;?>"><?php echo $mitem;?></div>
						</a>
					</div>
					<div class="" style="display:none;" id="sub_menu_<?php echo $mkey;?>">
						<a href="<?php echo BASE_PATH;?>/managerequest/index/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_booking_<?php echo $mkey;?>">Manage Booking</div></a>
						<a href="<?php echo BASE_PATH;?>/resources/index/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_resources_<?php echo $mkey;?>">Manage Resources</div></a>
						<a href="<?php echo BASE_PATH;?>/events/index/<?php echo $mkey;?>"><div class="nav_div_submenu_item" id="nav_div_submenu_events_<?php echo $mkey;?>">Booking Calendar</div></a>
					</div>
				</div>
				<?php
				}
			}
			echo "</div>";
		}	
		echo '</div>';
	}
	?>
	
	<?php if(preg_match('/bgc/i',strtolower($_SESSION['host_domain']))  || preg_match('/cmslivetest/i',strtolower($_SERVER['HTTP_HOST']))) { ?>
	<div class="nav_div" id="nav_staff_report">
		<div class="nav_content" style="<?php echo @$ln_active_staff_report;?>;">
			<a href="<?php echo BASE_PATH;?>/staff_report/incident">
				<div class="left_nav">Staff Reported Issues</div>
			</a>
		</div>
		<div class="nav_div_submenu<?php if($leftpanel=="staff_report") echo "_active";?>" id="sub_menu_staff_report">
			<a href="<?php echo BASE_PATH;?>/staff_report/incident"><div class="nav_div_submenu_item<?php echo @$submenu_incident;?>">Incident Reported</div></a>
			<a href="<?php echo BASE_PATH;?>/staff_report/analytics"><div class="nav_div_submenu_item<?php echo @$submenu_analytics;?>">Analytics</div></a>
			<a href="<?php echo BASE_PATH;?>/staff_report/manage_location"><div class="nav_div_submenu_item<?php echo @$submenu_manage_location;?>">Manage Club Location</div></a>
			<a href="<?php echo BASE_PATH;?>/staff_report/archive"><div class="nav_div_submenu_item<?php echo @$submenu_archive;?>">Archived Reports</div></a>
			<a href="<?php echo BASE_PATH;?>/staff_report/manage_staff"><div class="nav_div_submenu_item<?php echo @$submenu_manage_staff;?>">Manage Staff</div></a>
			<a href="<?php echo BASE_PATH;?>/staff_report/settings"><div class="nav_div_submenu_item<?php echo @$submenu_settings;?>">Settings</div></a>
		</div>
	</div>
	<?php } ?>
	
	<?php if(preg_match('/myresident/i',strtolower($_SESSION['host_domain']))) { ?>
	<div class="nav_div" id="nav_staff_report">
		<div class="nav_content" style="<?php echo @$ln_active_staff_report;?>;">
			<a href="<?php echo BASE_PATH;?>/referal">
				<div class="left_nav">Myresident Referal</div>
			</a>
		</div>
		<div class="nav_div_submenu<?php if($leftpanel=="myresident_referal") echo "_active";?>" id="sub_menu_staff_report">
			<a href="<?php echo BASE_PATH;?>/referal"><div class="nav_div_submenu_item<?php echo @$submenu_referal_list;?>">Referal List</div></a>
			<a href="<?php echo BASE_PATH;?>/referal/manage_staff"><div class="nav_div_submenu_item<?php echo @$submenu_manage_staff;?>">Manage Staff</div></a>
			<a href="<?php echo BASE_PATH;?>/referal/settings"><div class="nav_div_submenu_item<?php echo @$submenu_referal_settings;?>">Settings</div></a>
		</div>
	</div>
	<?php } ?>
		
	<?php if(preg_match('/sneakers/i',strtolower($_SESSION['host_domain'])) || ($_SESSION['city_id']=="a248988373588bd873393dc6a7546ba4" && preg_match('/cmslivetest/i',strtolower($_SERVER['HTTP_HOST'])))) { ?>
	<div class="nav_div" id="nav_raffle">
		<div class="nav_content" style="<?php echo @$ln_active_raffle;?>;">
			<a href="<?php echo BASE_PATH;?>/raffle/view_raffles">
				<div class="left_nav">Manage Raffles</div>
			</a>
		</div>
		<div class="nav_div_submenu<?php if($leftpanel=="raffle") echo "_active";?>" id="sub_menu_raffle">
			<a href="<?php echo BASE_PATH;?>/raffle"><div class="nav_div_submenu_item<?php echo @$submenu_raffle_add;?>">Add Raffles</div></a>
			<a href="<?php echo BASE_PATH;?>/raffle/view_raffles"><div class="nav_div_submenu_item<?php echo @$submenu_raffle_list;?>">Raffles List</div></a>
			<a href="<?php echo BASE_PATH;?>/raffle/settings"><div class="nav_div_submenu_item<?php echo @$submenu_raffle_settings;?>">Settings</div></a>
		</div>
	</div>
	<?php } ?>
	
	<?php if(preg_match('/420/i',strtolower($_SESSION['host_domain'])) || preg_match('/cmslivetest/i',strtolower($_SERVER['HTTP_HOST']))) { ?>
	<div class="nav_div" id="nav_staff_report">
		<div class="nav_content" style="<?php echo @$ln_active_420delivery;?>;">
			<a href="<?php echo BASE_PATH;?>/four20delivery/orders">
				<div class="left_nav">Delivery</div>
			</a>
		</div>
		<div class="nav_div_submenu<?php if($leftpanel=="four20delivery") echo "_active";?>" id="sub_menu_420delivery">
			<a href="<?php echo BASE_PATH;?>/four20delivery/orders"><div class="nav_div_submenu_item<?php echo @$submenu_orders;?>">View Orders</div></a>
			<a href="<?php echo BASE_PATH;?>/four20delivery/archive"><div class="nav_div_submenu_item<?php echo @$submenu_archive;?>">Archive Orders</div></a>
			<a href="<?php echo BASE_PATH;?>/four20delivery/products"><div class="nav_div_submenu_item<?php echo @$submenu_products;?>">Products</div></a>
			<a href="<?php echo BASE_PATH;?>/four20delivery/manage_staff"><div class="nav_div_submenu_item<?php echo @$submenu_staff;?>">Staff</div></a>
			<a href="<?php echo BASE_PATH;?>/four20delivery/patients"><div class="nav_div_submenu_item<?php echo @$submenu_patients;?>">View Patients</div></a>
			<a href="<?php echo BASE_PATH;?>/four20delivery/settings"><div class="nav_div_submenu_item<?php echo @$submenu_four20_settings;?>">Settings</div></a>
		</div>
	</div>
	<?php } ?>
	
	<?php
	}
	else if($top_menu_active=="push_notification")
	{
	?>	
	<div class="nav_div" id="nav_send_push">
		<div style="float:left;height:70px;line-height:70px;width:214px;<?php echo @$ln_active_send_push;?>;">
			<a href="<?php echo BASE_PATH;?>/pushnotification">
				<div style="float:left;">
					<div class="left_nav_icon"><img src="<?php echo S3_IMAGE_URL;?>/cms_1280/top_nav_icon_push_notification.png" border="0"/></div>Send Push Notification
				</div>
			</a>
		</div>
	</div>
	
	<div class="nav_div" id="nav_push_history">
		<div style="float:left;height:70px;line-height:70px;width:214px;<?php echo @$ln_active_push_history;?>;">
			<a href="<?php echo BASE_PATH;?>/pushnotification/push_history">
				<div style="float:left;">
					<div class="left_nav_icon"><img src="<?php echo S3_IMAGE_URL;?>/cms_1280/top_nav_icon_push_notification.png" border="0"/></div>Push Notification History
				</div>
			</a>
		</div>
	</div>
	
	<?php
	}
	else if($top_menu_active=="forms")
	{
	?>
	<div class="nav_div" id="nav_forms">
		<div style="float:left;height:70px;line-height:70px;width:214px;<?php echo @$ln_active_forms;?>;">
			<a href="<?php echo BASE_PATH;?>/user"><div style="float:left;width:70px;">&nbsp;</div><div style="float:left;width:142px;">Forms Menus </div></a>
		</div>
	</div>
	
	<?php
	}
	else if($top_menu_active=="user")
	{
	?>	
	<div class="nav_div" id="nav_cmsuser">
		<div style="float:left;height:70px;line-height:70px;width:214px;<?php echo @$ln_active_cmsuser;?>;">
			<a href="<?php echo BASE_PATH;?>/users">
				<div style="float:left;">
					<div class="left_nav_icon"><img src="<?php echo S3_IMAGE_URL;?>/cms_1280/rai_left_icon3.png" border="0"/></div>CMS User
				</div>
			</a>
		</div>
	</div>
	<?php
	}
	else if($top_menu_active=="app_user")
	{
	?>	
	<div class="nav_div" id="nav_appuser">
		<div style="float:left;height:70px;line-height:70px;width:214px;<?php echo @$ln_active_appuser;?>;">
			<a href="<?php echo BASE_PATH;?>/app_users">
				<div style="float:left;">
					&nbsp;
				</div>
			</a>
		</div>
	</div>
	<?php
	}	
	?>
</div>
<?php 
if($top_menu_active=="overview")
{
	$add_menu_access = "yes";
	if($_SESSION['user_type']!="super_admin" && $_SESSION['user_type']!="city_admin" && $_SESSION['user_type']!="admin")
	{
		//$access_arr = explode(",",$_SESSION['access_tab']);
		$access_arr = explode(",",$_SESSION['access_menu']);
		if(!in_array("menu_item",$access_arr))
		{
			$add_menu_access = "no";
		}
	}
	
	if($add_menu_access=="yes")
	{
?>
<div class="nav_div non-group" id="nav_menu">
	<div class="nav_content" style="<?php echo @$ln_active_menus_add;?>;">
		<a href="<?php echo BASE_PATH;?>/menu">
			<div class="left_nav">Add Menu Item</div>
		</a>
	</div>
</div>
<?php 
	}
}
?>

<script>
	jQuery(document).ready(function() {
		var cur_group = localStorage["current_group"];
		var groups = ["civic_engagement","report_issue","waste_management","public_safety"];

		for(var i = 0, l = groups.length; i < l; i++) {
			if(groups[i] === cur_group)
				jQuery('#' + groups[i])[0].classList.remove('tt-collapsed');		
		}
	});

	jQuery('.tt-collapse-panel, .tt-collapse-panel .tt-icon').on('click', function(e) {
		var group = e.target;
		if(group) {
			if(group.parentElement.classList.contains('tt-collapsed')) {
				group.parentElement.classList.remove('tt-collapsed');				
				localStorage["current_group"] = group.parentElement.id;
			}
			else {
				group.parentElement.classList.add('tt-collapsed');
				localStorage["current_group"] ="";
			}
		}
	}).on('click', 'div', function(e){
		e.stopPropagation();
	});

	jQuery('.non-group').on('click', function(e) {
		localStorage["current_group"] = "";
	});
</script>
