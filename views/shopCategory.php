<div id="content">
	<div class="wrapper">
		<?php 
			if(!empty($_GET)){
				if (isset($_GET["cAtEgOrY"])){
					$mysqli = DATABASE::Connect();
					$sql = "SELECT * FROM `shopitems` INNER JOIN `shopcategories` ON shopitems.Category_id = shopcategories.Category_ID WHERE shopcategories.Category_ID = ? AND `isVisible` = 1 ORDER BY `shopitems`.`AddTime` DESC"; // SQL with parameters
					$stmt = $mysqli->prepare($sql); 
					$stmt->bind_param("i",intval($_GET["cAtEgOrY"]));
					$stmt->execute();
					$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
					ITEM::echoShopItems($myResult,true);
				} else {
					header( 'Location: index.php?action=404' );
				}
			} else {
				header( 'Location: index.php?action=404' );
			}
		?>
	</div>
</div>