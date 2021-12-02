<div id="content">
	<div class="wrapper">
		<?php 
			if(!empty($_GET)){
				if (isset($_GET["action"])&&$_GET["action"]=="change"){

					if ($_SESSION['isAdmin'] == true) {
						require_once("../layout/adminPanel.php");
					}
					$whatAction = array();
					$ID = array();
					foreach ($_GET as $key => $value) {
						array_push($whatAction,$key);
						array_push($ID,$value);
					}
					$whatAction = $whatAction[1];
					$ID = intval($ID[1]);

					if (!empty($_POST)) {
						if($whatAction=="shOpItEms"||$whatAction=="shOpItEmswAItIng"){
							$category = $_POST["category"]; 
							$itemName = $_POST["itemName"];
							$producer = $_POST["producer"];
							$shortDescription = $_POST["shortDescription"];
							$fullDescription = $_POST["fullDescription"];
							$price = $_POST["price"];
							$itemsNumber = $_POST["itemsNumber"];
						 	$ITEM = new ITEM($category,$itemName,$producer,$shortDescription,$fullDescription,$price,$itemsNumber);
							$errors = ITEM::validatorShopItemsChange($ITEM,$_POST);
							if(empty($errors)){
								ITEM::updateItemInfo($ITEM,$ID);
								?>
									<script>
										window.location.href = "index.php";
									</script>
								<?php
							} else {
								?>
								<div id="content" class="errors">
									<div class="errors">
										<?php
											for ($i=0; $i < count($errors); $i++) { 
												echo "<div class='errorItem'>
														<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>$errors[$i]
													</div>"; 
											}
										?>
									</div>
								</div>
								<script>
									setTimeout(()=>{
										document.location = location;
									},3000)
								</script>
								<?php
							}
						} else if($whatAction=="UsErs"){
							$errors = USER::validatorUsersChange($_POST);
							if(empty($errors)){
								USER::updateUserInfo($_POST,$ID);
								?>
									<script>
										window.location.href = "index.php";
									</script>
								<?php
							} else {
								?>
								<div id="content" class="errors">
									<div class="errors">
										<?php
											for ($i=0; $i < count($errors); $i++) { 
												echo "<div class='errorItem'>
														<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>$errors[$i]
													</div>"; 
											}
										?>
									</div>
								</div>
								<script>
									setTimeout(()=>{
										document.location = location;
									},3000)
								</script>
								<?php
							}
						} else if($whatAction=="shOpcAtEgOrIEs"){
							$errors = [];
							if (strlen($_POST["name"])<=1) {
								array_push($errors,"Не правильно введено назву категорії");
							}
							if(empty($errors)){
								ITEM::updateShopItemCategoriesInfo($_POST["name"],$ID);
								?>
									<script>
										window.location.href = "index.php";
									</script>
								<?php
							} else {
								?>
								<div id="content" class="errors">
									<div class="errors">
										<?php
											for ($i=0; $i < count($errors); $i++) { 
												echo "<div class='errorItem'>
														<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>$errors[$i]
													</div>"; 
											}
										?>
									</div>
								</div>
								<script>
									setTimeout(()=>{
										document.location = location;
									},3000)
								</script>
								<?php
							}
						} else if($whatAction=="shOpprOdUcErs"){
							$errors = [];
							if (strlen($_POST["name"])<=1) {
								array_push($errors,"Не правильно введено назву виробника");
							}
							if(empty($errors)){
								ITEM::updateShopItemProducersInfo($_POST["name"],$ID);
								?>
									<script>
										window.location.href = "index.php";
									</script>
								<?php
							} else {
								?>
								<div id="content" class="errors">
									<div class="errors">
										<?php
											for ($i=0; $i < count($errors); $i++) { 
												echo "<div class='errorItem'>
														<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>$errors[$i]
													</div>"; 
											}
										?>
									</div>
								</div>
								<script>
									setTimeout(()=>{
										document.location = location;
									},3000)
								</script>
								<?php
							}
						}
					} else {

						if($whatAction=="shOpItEms"||$whatAction=="shOpItEmswAItIng"){
							ADMIN::echoShopItemsChange("SELECT * FROM `shopitems` WHERE `Item_ID` = ?",$ID);
						} else if($whatAction=="UsErs"){
							ADMIN::echoUsersChange("SELECT * FROM `users` WHERE `User_ID` = ?",$ID);
						} else if($whatAction=="shOpcAtEgOrIEs"){
							ADMIN::echoShopCategoriesChange("SELECT * FROM `shopcategories` WHERE `Category_ID` = ?",$ID);
						} else if($whatAction=="shOpprOdUcErs"){
							ADMIN::echoShopProducersChange("SELECT * FROM `producers` WHERE `Producer_ID` = ?",$ID);
						}

					}

				} else {
					header( 'Location: index.php?action=404' );
				}
			} else {
				header( 'Location: index.php?action=404' );
			}
		?>
	</div>
</div>