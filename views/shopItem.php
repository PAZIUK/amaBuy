<div id="content">
	<div class="wrapper">
		<?php 
			if(!empty($_GET)){
				if (isset($_GET["ItEm"])){
					$mysqli = DATABASE::Connect();
					$sql = "SELECT * FROM `shopitems` INNER JOIN `shopcategories` ON shopitems.Category_id = shopcategories.Category_ID INNER JOIN `producers` ON shopitems.Producer_id = producers.Producer_ID INNER JOIN `users` ON shopitems.User_id = users.User_ID WHERE `Item_ID` = ?"; // SQL with parameters
					$stmt = $mysqli->prepare($sql); 
					$stmt->bind_param("i",intval($_GET["ItEm"]));
					$stmt->execute();
					$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
					var_dump($myResult);
				} else {
					header( 'Location: index.php?action=404' );
				}
			} else {
				header( 'Location: index.php?action=404' );
			}
		?>
	</div>
</div>