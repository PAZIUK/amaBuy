<?php 
	class ITEM {
		private $id;
		private $category;
		private $itemName;
		private $producer; 
		private $shortDescription;
		private $fullDescription;
		private $price;
		private $itemsNumber;

		private $errors = array();

		public function __construct($category,$itemName,$producer,$shortDescription,$fullDescription,$price,$itemsNumber){
			$this->category = $category;
			$this->itemName = $itemName;
			$this->producer = $producer; 
			$this->shortDescription = $shortDescription;
			$this->fullDescription = $fullDescription;
			$this->price = $price;
			$this->itemsNumber = $itemsNumber;
		}
		public function Validator(){

			if (intval($this->category) == 1||$this->category==NULL) {
				array_push($this->errors,"Не вказано категорію");
			}
			if ($this->itemName==NULL) {
				array_push($this->errors,"Не введено назву товару");
			}
			if (intval($this->producer) == 1||$this->producer==NULL) {
				array_push($this->errors,"Не вказано виробника");
			}
			if ($this->shortDescription==NULL) {
				array_push($this->errors,"Не введено короткий опис товару");
			}
			if ($this->fullDescription==NULL) {
				array_push($this->errors,"Не введено повний опис товару");
			}
			if ($this->price==NULL) {
				array_push($this->errors,"Не введено ціну");
			}
			if ($this->price==NULL) {
				array_push($this->errors,"Не введено кількість нявного товару");
			}

			if (empty($this->errors)) {
				return true;
			} else {
				return false;
			}
		}
		public function getErrors(){
			return $this->errors;
		}

		public function addShopItemWaiting(){
			$fullItem = [
				"categoryID" => $this->category,
				"itemName" => $this->itemName,
				"producerID" => $this->producer,
				"shortDescription" => $this->shortDescription,
				"fullDescription" => $this->fullDescription,
				"price" => $this->price,
				"itemsNumber" => $this->itemsNumber,
			];
			$categoryID = $fullItem["categoryID"]; 
			$itemName = $fullItem["itemName"];
			$producerID = $fullItem["producerID"];
			$shortDescription = $fullItem["shortDescription"];
			$fullDescription = $fullItem["fullDescription"];
			$price = $fullItem["price"];
			$itemsNumber = $fullItem["itemsNumber"];
			$UserID = $_SESSION["ID"];
			$mysqli = DATABASE::Connect();
			$sql = "INSERT INTO shopitems(User_id,Category_id,Name,Producer_id,ShortDescription,FullDescription,Price,HowMuch) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("iisissii",$UserID,$categoryID,$itemName,$producerID,$shortDescription,$fullDescription,$price,$itemsNumber);
			$stmt->execute();
			header( 'Location: index.php?action=addItemSuccess' );
			exit();
		}
		public function echoErrors(){
			$errors = $this->getErrors();
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
					<script>
						setTimeout(()=>{
							window.location.href = "index.php?action=addShopItem";
						},5000)
					</script>
				</div>
			</div>
			<?php
		}
		public static function validatorShopItemsChange($item,$post){
			$errors = [];
			if (strlen($item->itemName)<=1) {
				array_push($errors,"Не правильно введено назву товару");
			}
			if (strlen($item->shortDescription)<=1) {
				array_push($errors,"Не правильно введено короткий опис товару");
			}
			if (strlen($item->fullDescription)<=1) {
				array_push($errors,"Не правильно введено повний опис товару");
			}
			
			return $errors;
		}
		public static function updateItemInfo($item,$id){
			$mysqli = DATABASE::Connect();
			$sql = "UPDATE `shopitems` SET `Category_id` = ?,`Name` = ?,`Producer_id` = ?,`ShortDescription` = ?,`FullDescription` = ?,`Price` = ?,`HowMuch` = ? WHERE `Item_ID` = ?";
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("isissiii",$item->category,$item->itemName,$item->producer,$item->shortDescription,$item->fullDescription,$item->price,$item->itemsNumber,$id);
			$stmt->execute();
		}
		public static function updateShopItemCategoriesInfo($name,$id){
			$mysqli = DATABASE::Connect();
			$sql = "UPDATE `shopcategories` SET `Category_Name` = ? WHERE `Category_ID` = ?";
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("si",$name,$id);
			$stmt->execute();
		}
		public static function updateShopItemProducersInfo($name,$id){
			$mysqli = DATABASE::Connect();
			$sql = "UPDATE `producers` SET `Producer_Name` = ? WHERE `Producer_ID` = ?";
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("si",$name,$id);
			$stmt->execute();
		}
		public static function echoSelectCategories(){
    	    $mysqli = DATABASE::Connect();
    	    $sql = "SELECT * FROM `shopcategories`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
				?>
					<option value="<?php echo $row['Category_ID'] ?>"><?php echo $row['Category_Name'] ?></option>
				<?php	
				}
			}
		}
		public static function echoSelectProducers(){
    	    $mysqli = DATABASE::Connect();
    	    $sql = "SELECT * FROM `producers`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
				?>
					<option value="<?php echo $row['Producer_ID'] ?>"><?php echo $row['Producer_Name'] ?></option>
				<?php	
				}
			}
		}

		public static function echoShopItems($sql,$isDone){
			if ($isDone==false) {
				$mysqli = DATABASE::Connect();
				$stmt = $mysqli->prepare($sql);
				$stmt->execute();
				$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			} else if($isDone==true){
				$myResult = $sql;
			}
			$allCategories = array();
			for ($i=0; $i < count($myResult); $i++) { 
				if(!in_array($myResult[$i]['Category_ID'], $allCategories)){
					array_push($allCategories,$myResult[$i]['Category_ID']);
				}
			}
			$allCategories = array_reverse($allCategories);
			if (count($allCategories)>0) {
				?>
					<section class="shop">
				<?php
				for ($i=0; $i < count($allCategories); $i++) { 
					?>
							<div class="shop_cat">
								<div class="name" style="margin-top: 2rem;">
									<?php 
										for ($index=0; $index < count($myResult); $index++) { 
											if ($myResult[$index]['Category_ID']==$allCategories[$i]) {
												echo $myResult[$index]['Category_Name'];
												$shopCategoryID = $myResult[$index]['Category_ID'];
												break;
											}
										}
									?>
								</div>
					<?php
					for ($ind=0; $ind < count($myResult); $ind++) {
						if($myResult[$ind]['Category_ID']==$shopCategoryID){
						?>
					<div class="shop_cat-item">
						<div shopItemId="<?php echo $myResult[$ind]['Item_ID'] ?>" class="id"></div>
						<div class="head">
							<div class="miniInfo">
								<?php 
									$timeOver = date_create($myResult[$ind]["AddTime"]);
									date_add($timeOver,date_interval_create_from_date_string("3 days"));
									date_default_timezone_set('Europe/Kiev');
									$nowDate = strtotime(date("Y-m-d H:i:s"));
									$timeOver = strtotime(date_format($timeOver,"Y-m-d H:i:s"));
									$fullDays = round(($timeOver - $nowDate) / 60 / 60 / 24,2);
									if ($fullDays<3) {
										?>
										<div class="new">НОВИНКА</div>
										<?php
									}
									if (isset($myResult[$ind]["Sale"])&&intval($myResult[$ind]["Sale"])!=0) {
										?>
										<div class="minus">-<?php echo $myResult[$ind]["Sale"]?>%</div>
										<?php
									}
								?>
							</div>
							<div class="img">
								<a href="index.php?action=shopItem&ItEm=<?php echo $myResult[$ind]['Item_ID'] ?>"><img src="img/shop/cat<?php echo $allCategories[$i]?>.png" alt=""></a>
							</div>
						   <!--  <div class="btns">
						    	<i class="bx bx-heart"></i>
						    	<i class="bx bx-bar-chart-alt"></i>
						    </div> -->
						</div>
						<div class="body">
							<a href="index.php?action=shopItem&ItEm=<?php echo $myResult[$ind]['Item_ID'] ?>" class="name"><?php echo $myResult[$ind]['Name'] ?></a>
							<!-- <div class="oldPrice">100 000<div class="line"></div></div> -->
							<div class="nowPrice"><?php echo $myResult[$ind]['Price'] ?></div>
							<div class="shopBtn">
								<i class='bx bx-basket'></i>
							</div>
						</div>
					</div>
						<?php
						}
				    }
				    ?>
							</div>
					<?php
				}?>
				</section>
				<?php
			} else {
		    	header( 'Location: index.php?action=404' );
		    }
		}
		public static function echoShopCategories()
		{
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `shopcategories`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows > 0) {
				?>
				<nav class="catalog">
					<ul>
				<?php
					while ($row = $result->fetch_assoc()) {
						if(intval($row["Category_ID"])!=1){
				?>
						<li>
							<a href='index.php?action=shopCategory&cAtEgOrY=<?php echo $row["Category_ID"]?>'>
								<img src="<?php echo 'img/shop/cat'.$row["Category_ID"].'.png'?>" alt="" class="image">
								<div class="category"><?php echo $row["Category_Name"]?></div>
							</a>
						</li>
				<?php
						}
			    	}
			    ?>
			    	</ul>
				</nav>
			    <?php
			}
		}
		public static function echoShopProducerItems($ID)
		{
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `shopitems` INNER JOIN `producers` ON shopitems.Producer_id = producers.Producer_ID WHERE producers.Producer_ID = ? AND `isVisible` = 1 ORDER BY `shopitems`.`AddTime` DESC"; // SQL with parameters
			$stmt = $mysqli->prepare($sql); 
			$stmt->bind_param("i",$ID);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			var_dump($ID);
		}
	}
?>