<?php 
	session_start();

	if (isset($_SESSION["isAdmin"])&&$_SESSION["isAdmin"]==true) {
		require_once("../models/database.php");
		require_once("../models/shopItem.php");
		require_once("../models/shopProducers.php");
		require_once("../models/admin.php");
		require_once("../models/user.php");
		require_once("layout/head.php");
		require_once("layout/header.php");

		if(isset($_GET["action"])){
			$a = $_GET["action"];
			if (file_exists("views/".$a.".php")) {
				require_once("views/".$a.".php");
			}	else {
				require_once("views/404.php");
			}
		} else {
			require_once("../views/main.php");
		}

		require_once("layout/footer.php");
	} else {
		header( 'Location: ../index.php' );
		exit();
	}
?>