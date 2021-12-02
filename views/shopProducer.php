
<div id="content">
	<div class="wrapper">
		<?php 
			if(!empty($_GET)){
				if (isset($_GET["prOdUcEr"])){
					$mysqli = DATABASE::Connect();
					$sql = "SELECT * FROM `shopitems` INNER JOIN `producers` ON shopitems.Producer_id = producers.Producer_ID WHERE producers.Producer_ID = ? ORDER BY `shopitems`.`AddTime` DESC"; // SQL with parameters
					$stmt = $mysqli->prepare($sql); 
					$stmt->bind_param("i",intval($_GET["prOdUcEr"]));
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