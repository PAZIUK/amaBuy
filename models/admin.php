<?php
	class ADMIN
	{
		public static function checkPanelItems($array,$checkValue)
		{	
			if(isset($array)&&
				count($array)==1&&
				$array['action']==$checkValue){ 
					return true; 
			} else if(isset($array['action'])&&
				$array['action']=='me'&&
				isset($array['shOwmE'])&&
				$array['shOwmE']==$checkValue){ 
					return true; 
			} else if(isset($array['action'])&&
				$array['action']=='me'&&
				isset($array['shOwmE'])&&
				$array['shOwmE']==$checkValue){ 
					return true; 
			} else if(isset($array['action'])&&
				$array['action']=='me'&&
				isset($array['shOwmE'])&&
				$array['shOwmE']==$checkValue){ 
					return true; 
			} 
		}
		public static function echoShopItems($sql)
		{	
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			for ($i=0; $i < count($myResult); $i++) { 
			?>
			<tr>
				<td><?php echo $myResult[$i]["Item_ID"]?></td>
				<td><?php echo $myResult[$i]["Name"]?></td>
				<td><?php echo $myResult[$i]["Username"]?></td>
				<td><?php echo $myResult[$i]["Category_Name"]?></td>
				<td><?php echo $myResult[$i]["Producer_Name"]?></td>
				<td><?php echo $myResult[$i]["Price"]?></td>
				<td><?php echo $myResult[$i]["HowMuch"]?></td>
				<td class="btns">
					<button itemAction="hide"><i class='bx bx-hide'></i></button>
					<button itemAction="change"><i class='bx bx-pencil'></i></button>
					<button itemAction="delete"><i class='bx bx-trash'></i></button>
				</td>
			</tr>
			<?php
			}
		}
		public static function echoShopItemsCategoties($sql)
		{	
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			for ($i=0; $i < count($myResult); $i++) { 
				if (intval($myResult[$i]["Category_ID"])>1) {
				?>
				<tr>
					<td><?php echo $myResult[$i]["Category_ID"]?></td>
					<td><?php echo $myResult[$i]["Category_Name"]?></td>
					<td class="btns">
						<button itemAction="change"><i class='bx bx-pencil'></i></button>
						<button itemAction="delete"><i class='bx bx-trash'></i></button>
					</td>
				</tr>
				<?php
				}
			}
		}
		public static function echoShopItemsProducers($sql)
		{	
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			for ($i=0; $i < count($myResult); $i++) { 
				if (intval($myResult[$i]["Producer_ID"])>1) {
				?>
				<tr>
					<td><?php echo $myResult[$i]["Producer_ID"]?></td>
					<td><?php echo $myResult[$i]["Producer_Name"]?></td>
					<td class="btns">
						<button itemAction="change"><i class='bx bx-pencil'></i></button>
						<button itemAction="delete"><i class='bx bx-trash'></i></button>
					</td>
				</tr>
				<?php
				}
			}
		}
		public static function echoShopItemsWaiting($sql)
		{	
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			for ($i=0; $i < count($myResult); $i++) { 
			?>
			<tr>
				<td><?php echo $myResult[$i]["Item_ID"]?></td>
				<td><?php echo $myResult[$i]["Name"]?></td>
				<td><?php echo $myResult[$i]["Username"]?></td>
				<td><?php echo $myResult[$i]["Category_Name"]?></td>
				<td><?php echo $myResult[$i]["Producer_Name"]?></td>
				<td><?php echo $myResult[$i]["Price"]?></td>
				<td><?php echo $myResult[$i]["HowMuch"]?></td>
				<td class="btns addItem">
					<button itemAction="add"><i class='bx bx-plus'></i></button></form>
					<button itemAction="change"><i class='bx bx-pencil'></i></button>
					<button itemAction="delete"><i class='bx bx-trash'></i></button>
				</td>
			</tr>
			<?php
			}
		}
		public static function echoUsers($sql)
		{	
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			for ($i=0; $i < count($myResult); $i++) { 
			?>
			<tr>
				<td><?php echo $myResult[$i]["User_ID"]?></td>
				<td><?php echo $myResult[$i]["Username"]?></td>
				<td><?php echo $myResult[$i]["User_Name"]?></td>
				<td><?php echo $myResult[$i]["Phone"]?></td>
				<td><?php echo $myResult[$i]["Mail"]?></td>
				<td><?php echo $myResult[$i]["RegTime"]?></td>
				<td class="btns">
					<button itemAction="change"><i class='bx bx-pencil'></i></button>
				<?php 	
					if (intval($myResult[$i]["ADMIN"])==0) {
				?>
					<button itemAction="delete"><i class='bx bx-trash'></i></button>
				<?php 
					}
				?>
				</td>
			</tr>
			<?php
			}
		}
		public static function echoShopItemsChange($sql,$ID)
		{
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("i",$ID);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			?>
				<div class="addItemContainer">
					<h1 class="addItemName">РЕДАГУВАННЯ ТОВАРУ</h1>
					<div class="photo">
						<!-- <img src="img/shop/unknown.png" alt=""> -->
						<img src="../img/shop/cat<?php echo $myResult[0]['Category_id']?>.png" alt="" style="width: 15rem;">
					</div>
					<form action="" method="POST">
					    <ul>
					    	<li class="addItemBlock">
							    <h2 class="addItemBlockName category">Категорія</h2>
							    <select name="category">
							    	<?php 
							    	    $sql = "SELECT * FROM `shopcategories`";
										$stmt = $mysqli->prepare($sql);
										$stmt->execute();
										$result = $stmt->get_result();
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
											?>
												<option <?php if($row['Category_ID']==$myResult[0]['Category_id']){ echo "selected='selected'";} if(intval($row['Category_ID'])==1){ echo "disabled='disabled'";} ?>value="<?php echo $row['Category_ID'] ?>"><?php echo $row['Category_Name'] ?></option>
											<?php	
											}
										}
							    	?>
							    </select>
							    <i class='bx bx-chevron-down'></i>
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Назва товару</h2>
							    <input type="text" name="itemName" value="<?php echo $myResult[0]['Name'] ?>">
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Виробник товару</h2>
							    <select name="producer">
							    	<?php 
							    	   	$sql = "SELECT * FROM `producers`";
										$stmt = $mysqli->prepare($sql);
										$stmt->execute();
										$res = $stmt->get_result();
										if ($res->num_rows > 0) {
											while ($row = $res->fetch_assoc()) {
											?>
												<option <?php if($row['Producer_ID']==$myResult[0]['Producer_id']){ echo "selected='selected'";} if(intval($row['Producer_ID'])==1){ echo "disabled='disabled'";} ?>value="<?php echo $row['Producer_ID'] ?>"><?php echo $row['Producer_Name'] ?></option>
											<?php	
											}
										}
							    	?>
							    </select>
							    <i class='bx bx-chevron-down'></i>
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Короткий опис товару</h2>
							    <input type="text" name="shortDescription" maxlength="255" value="<?php echo $myResult[0]['ShortDescription'] ?>">
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Повний опис товару</h2>
							    <textarea type="text" name="fullDescription"><?php echo $myResult[0]['FullDescription'] ?></textarea> 
						    </li>
						    <!-- <li class="addItemBlock">
							    <h2 class="addItemBlockName">Стара ціна</h2>
							    <input type="text">
						    </li> -->
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Ціна</h2>
							    <input type="number" name="price" value="<?php echo $myResult[0]['Price'] ?>"> 
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Кількість нявного товару</h2>
							    <input type="number" name="itemsNumber" value="<?php echo $myResult[0]['HowMuch'] ?>">
						    </li> 
						    <li class="addItemBlock">
							    <input type="submit" value="ДОДАТИ ЗМІНИ">
						    </li>
					    </ul>
					</form>
				</div>
			<?php
		}
		public static function echoUsersChange($sql,$ID)
		{
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("i",$ID);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			?>
				<div class="addItemContainer" style="display:flex; flex-direction: column;">
					<h1 class="addItemName">РЕДАГУВАННЯ ІНФОРМАЦІЇ ПРО КОРИСТУВАЧА</h1>
					<form action="" method="POST">
					    <ul style="display: grid;grid-template-columns: repeat(3, 1fr); grid-gap: 1.5rem;">
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Логін</h2>
							    <input type="text" name="username" value="<?php echo $myResult[0]['Username'] ?>">
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Ім'я користувача</h2>
							    <input type="text" name="name" maxlength="255" value="<?php echo $myResult[0]['User_Name'] ?>">
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Чи модератор</h2>
							    <input type="number" <?php if(isset($_SESSION['isAdmin'])&&$_SESSION['isAdmin'] == true){ echo "readonly='readonly'";}?> id="isAdmin" name="isAdmin" maxlength="255" value="<?php echo $myResult[0]['ADMIN'] ?>">
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Пошта</h2>
							    <input type="text" name="mail" value="<?php echo $myResult[0]['Mail'] ?>"> 
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Телефон</h2>
							    <input type="text" name="phone" value="<?php echo $myResult[0]['Phone'] ?>"> 
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Кількість спроб авторизації</h2>
							    <input type="number" name="loginAttempts" value="<?php echo $myResult[0]['LoginAttempts'] ?>"> 
						    </li>
						    <li class="addItemBlock" style="grid-column-start: 2;grid-column-end: 3;">
							    <input type="submit" value="ДОДАТИ ЗМІНИ">
						    </li>
					    </ul>
					    <script>
					    	let numberInputs = document.querySelectorAll("li.addItemBlock input[type='number']");

					    	numberInputs.forEach(item=>{
					    		item.addEventListener('input',function(){
					    			if (this.id=="isAdmin"){
					    				if(+this.value < 0||+this.value > 1){
					    					this.value = 0;
					    				}
					    			} else {
					    				if(+this.value < 0||+this.value > 5){
					    					this.value = 0;
					    				}
					    			}
					    		})
					    	})
					    </script>
					</form>
				</div>
			<?php
		}
		public static function echoShopCategoriesChange($sql,$ID)
		{
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("i",$ID);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			?>
				<div class="addItemContainer" style="display:flex; flex-direction: column;">
					<h1 class="addItemName">РЕДАГУВАННЯ ІНФОРМАЦІЇ ПРО КАТЕГОРІЮ ТОВАРІВ</h1>
					<form action="" method="POST">
					    <ul style="display: flex;flex-direction: column;">
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Назва категорії</h2>
							    <input type="text" name="name" value="<?php echo $myResult[0]['Category_Name'] ?>">
						    </li>
						    
						    <li class="addItemBlock">
							    <input type="submit" value="ДОДАТИ ЗМІНИ">
						    </li>
					    </ul>
					</form>
				</div>
			<?php
		}
		public static function echoShopProducersChange($sql,$ID)
		{
			$mysqli = DATABASE::Connect();
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("i",$ID);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			?>
				<div class="addItemContainer" style="display:flex; flex-direction: column;">
					<h1 class="addItemName">РЕДАГУВАННЯ ІНФОРМАЦІЇ ПРО ВИРОБНИКА ТОВАРІВ</h1>
					<form action="" method="POST">
					    <ul style="display: flex;flex-direction: column;">
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Назва категорії</h2>
							    <input type="text" name="name" value="<?php echo $myResult[0]['Producer_Name'] ?>">
						    </li>
						    
						    <li class="addItemBlock">
							    <input type="submit" value="ДОДАТИ ЗМІНИ">
						    </li>
					    </ul>
					</form>
				</div>
			<?php
		}
		public static function adminRAC($post,$do)
		{	
			if ($do=="Delete") {

				$ID = "";
				for ($i=0; $i < strlen($post); $i++) { 
					$isTrue = true;
					if ($i>0) {
						if(is_numeric(substr($post,$i,1))==true){
							$ID = $ID.substr($post,$i,1);
						} else {
							$i = strlen($post);
						}
					}
				}

				$whatBlock = implode(array_reverse(explode($ID, $post)));

				if ($whatBlock=="UsErs") {
					ADMIN::removeUserByID($ID);
				} else if ($whatBlock=="shOpItEms"||$whatBlock=="shOpItEmswAItIng") {
					ADMIN::removeShopItemByID($ID);
				} else if ($whatBlock=="shOpcAtEgOrIEs") {
					ADMIN::removeShopItemCategoryByID($ID);
				} else if ($whatBlock=="shOpprOdUcErs") {
					ADMIN::removeShopItemProducerByID($ID);
				}

			} else if ($do=="Add") {

				$whatBlock = explode(":", $post)[1];

				if ($whatBlock=="shOpcAtEgOrIEs") {
					ADMIN::addShopItemCategory(explode(":", $post)[0]);
				} else if ($whatBlock=="shOpItEmswAItIng"){
					ADMIN::addShopItemByIDWaiting(explode(":", $post)[0]);
				} else if ($whatBlock=="shOpprOdUcErs"){
					ADMIN::addShopItemProducer(explode(":", $post)[0]);
				}

			} else if ($do=="Hide") {
				
				$whatBlock = explode(":", $post)[1];

				if ($whatBlock=="shOpItEms") {
					ADMIN::hideShopItemByIDWaiting(explode(":", $post)[0]);
				}

			}
		}
		public static function removeShopItemByID($ID)
		{	
			$mysqli = DATABASE::Connect();
			$sql = "DELETE FROM `shopitems` WHERE shopitems.Item_ID = ?"; // SQL with parameters
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("i",intval($ID));
			$stmt->execute();
		}
		public static function removeShopItemCategoryByID($ID)
		{	
			$mysqli = DATABASE::Connect();
			$sql = "DELETE FROM `shopcategories` WHERE `Category_ID` = ?"; // SQL with parameters
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("i",intval($ID));
			$stmt->execute();
		}
		public static function removeShopItemProducerByID($ID)
		{	
			$mysqli = DATABASE::Connect();
			$sql = "DELETE FROM `producers` WHERE `Producer_ID` = ?"; // SQL with parameters
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("i",intval($ID));
			$stmt->execute();
		}
		public static function removeUserByID($ID)
		{	
			$mysqli = DATABASE::Connect();
			$sql = "DELETE FROM `users` WHERE users.User_ID = ?";
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("i",intval($ID));
			$stmt->execute();

			$sql = "DELETE FROM `shopitems` WHERE shopitems.User_id = ?";
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("i",intval($ID));
			$stmt->execute();
		}
		public static function addShopItemByIDWaiting($ID)
		{
			$num = 1;
			$mysqli = DATABASE::Connect();
			$sql = "UPDATE `shopitems` SET `isVisible` = ? WHERE `Item_ID` = ?";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("ii",$num,$ID);
			$stmt->execute();
		}
		public static function hideShopItemByIDWaiting($ID)
		{
			$num = 0;
			$mysqli = DATABASE::Connect();
			$sql = "UPDATE `shopitems` SET `isVisible` = ? WHERE `Item_ID` = ?";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("ii",$num,$ID);
			$stmt->execute();
		}
		public static function addShopItemCategory($value)
		{
			$mysqli = DATABASE::Connect();
			$sql = "INSERT INTO `shopcategories` (Category_Name) VALUES(?)";
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("s",$value);
			$stmt->execute();
		}
		public static function addShopItemProducer($value)
		{
			$mysqli = DATABASE::Connect();
			$sql = "INSERT INTO `producers` (Producer_Name) VALUES(?)";
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("s",$value);
			$stmt->execute();
		}
	}
?>