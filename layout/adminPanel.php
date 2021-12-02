<aside class="adminPanel">
	<!-- <div class="panelItem <?php //if(ADMIN::checkPanelItems($_GET,"me")==true){ echo "active"; } ?>" link="index.php?action=me">
		<i class='bx bx-user-pin'></i>
		<div class="tip"><div class="text">Мій кабінет</div></div>
	</div>
	<div class="panelItem <?php //if(ADMIN::checkPanelItems($_GET,"AnAlYtIcs")==true){ echo "active"; } ?>" link="index.php?action=me&shOwmE=AnAlYtIcs">
		<i class='bx bx-bar-chart'></i>
		<div class="tip"><div class="text">Аналітика</div></div>
	</div> -->
	<div class="panelItem <?php if(ADMIN::checkPanelItems($_GET,"UsErs")==true){ echo "active"; } ?>" link="index.php?action=me&shOwmE=UsErs">
		<i class='bx bx-user-voice'></i>
		<div class="tip"><div class="text">Користувачі</div></div>
	</div>	
	<div class="panelItem <?php if(ADMIN::checkPanelItems($_GET,"shOpItEms")==true){ echo "active"; } ?>" link="index.php?action=me&shOwmE=shOpItEms">
		<i class='bx bx-basket'></i>
		<div class="tip"><div class="text">Товари</div></div>
	</div>
	<div class="panelItem <?php if(ADMIN::checkPanelItems($_GET,"shOpItEmswAItIng")==true){ echo "active"; } ?>" link="index.php?action=me&shOwmE=shOpItEmswAItIng">
		<i class='bx bx-clipboard' ></i>
		<div class="tip"><div class="text">Черга додавання товарів</div></div>
	</div>
	<div class="panelItem <?php if(ADMIN::checkPanelItems($_GET,"shOpcAtEgOrIEs")==true){ echo "active"; } ?>" link="index.php?action=me&shOwmE=shOpcAtEgOrIEs">
		<i class='bx bx-align-left'></i>
		<div class="tip"><div class="text">Категорії товарів</div></div>
	</div>
	<div class="panelItem <?php if(ADMIN::checkPanelItems($_GET,"shOpcAtEgOrIEs")==true){ echo "active"; } ?>" link="index.php?action=me&shOwmE=shOpprOdUcErs">
		<i class='bx bx-store-alt'></i>
		<div class="tip"><div class="text">Виробники товарів</div></div>
	</div>	
</aside>