<div id="content">
	<div class="wrapper">
		<?php
			if (isset($_SESSION['isAdmin'])&&$_SESSION['isAdmin'] == true) {
				require_once("../layout/adminPanel.php");
			}
			ITEM::echoShopCategories();
			ITEM::echoShopItems("SELECT * FROM `shopitems` INNER JOIN `shopcategories` ON shopitems.Category_id = shopcategories.Category_ID WHERE `isVisible` = 1 ORDER BY `shopitems`.`AddTime` DESC",false);
			PRODUCERS::echoProducers();
		?>
	</div>
</div>