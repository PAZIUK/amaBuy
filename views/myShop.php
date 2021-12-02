<?php
	if(!isset($_SESSION["auth"])||(isset($_SESSION["auth"])&&$_SESSION["auth"]==false)){
		header( 'Location: index.php' );
	} else {
		$UserID = $_SESSION["ID"];
		$mysqli = DATABASE::Connect();
		$sql = "SELECT * FROM `shopitems` INNER JOIN `shopcategories` ON shopitems.Category_id = shopcategories.Category_ID WHERE User_id = ? AND `isVisible` = 1 ORDER BY `shopitems`.`AddTime` DESC"; // SQL with parameters
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("i",$UserID); 
		$stmt->execute();
		$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		ITEM::echoShopItems($myResult,true);
	}
?>