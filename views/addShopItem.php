<?php 
	if(!empty($_POST)){
		$category = $_POST["category"]; 
		$itemName = $_POST["itemName"];
		$producer = $_POST["producer"];
		$shortDescription = $_POST["shortDescription"];
		$fullDescription = $_POST["fullDescription"];
		$price = $_POST["price"];
		$itemsNumber = $_POST["itemsNumber"];

		$MYITEM = new ITEM($category,$itemName,$producer,$shortDescription,$fullDescription,$price,$itemsNumber);

		$shopItemValidator = $MYITEM->Validator();

		if($shopItemValidator==true){

			$MYITEM->addShopItemWaiting();

		} else if($shopItemValidator==false){
			$MYITEM->echoErrors();
		}
	} else {
		?>
		<div id="content">
			<div class="wrapper">
				<div class="addItemContainer">
					<h1 class="addItemName">ДОДАВАННЯ ТОВАРУ</h1>
					<div class="photo">
						<img src="img/shop/unknown.png" alt="">
					</div>
					<form action="" method="POST">
					    <ul>
					    	<li class="addItemBlock">
							    <h2 class="addItemBlockName category">Категорія</h2>
							    <select name="category">
							    	<?php 
							    	   	ITEM::echoSelectCategories();
							    	?>
							    </select>
							    <i class='bx bx-chevron-down'></i>
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Назва товару</h2>
							    <input type="text" name="itemName">
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Виробник товару</h2>
							    <select name="producer">
							    	<?php 
							    	   	ITEM::echoSelectProducers();
							    	?>
							    </select>
							    <i class='bx bx-chevron-down'></i>
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Короткий опис товару</h2>
							    <input type="text" name="shortDescription" maxlength="255">
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Повний опис товару</h2>
							    <textarea type="text" name="fullDescription"></textarea> 
						    </li>
						    <!-- <li class="addItemBlock">
							    <h2 class="addItemBlockName">Стара ціна</h2>
							    <input type="text">
						    </li> -->
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Ціна</h2>
							    <input type="number" name="price"> 
						    </li>
						    <li class="addItemBlock">
							    <h2 class="addItemBlockName">Кількість нявного товару</h2>
							    <input type="number" name="itemsNumber">
						    </li> 
						    <li class="addItemBlock">
							    <input type="submit" value="ДОДАТИ ТОВАР">
						    </li>
					    </ul>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
?>