<div id="content">
	<div class="wrapper" style="justify-content: unset;">	
		<?php
			require_once("../layout/adminPanel.php");	
			$mysqli = DATABASE::Connect();

			if (!empty($_POST)&&isset($_POST['delete'])) {
				ADMIN::adminRAC($_POST['delete'],'Delete');
			}
			if (!empty($_POST)&&isset($_POST['add'])) {
				ADMIN::adminRAC($_POST['add'],'Add');
			}
			if (!empty($_POST)&&isset($_POST['hide'])) {
				ADMIN::adminRAC($_POST['hide'],'Hide');
			}

			if (ADMIN::checkPanelItems($_GET,"AnAlYtIcs")) {
				?>
					<div class="meItem AnAlYtIcs"></div>
				<?php
			} else if (ADMIN::checkPanelItems($_GET,"UsErs")) {
				?>
					<div class="meItem UsErs">
						<h1>Всі користувачі <figure><img src="../img/design/logo.png" alt="LOGO" class="logo"></figure> amaBuy</h1>
						<table>
							<tr class="names">
								<th>ID</th>
								<th>Логін</th>
								<th>Ім'я</th>
								<th>Телефон</th>
								<th>Пошта</th>
								<th>Дата реєстрації</th>
								<th>Дії</th>
							</tr>
							<?php
								ADMIN::echoUsers("SELECT * FROM `users` ORDER BY `users`.`RegTime` DESC");
							?>
						</table>
					</div>
				<?php
			} else if (ADMIN::checkPanelItems($_GET,"shOpItEms")) {
				?>
					<div class="meItem shOpItEms">
						<h1>Всі товари на <figure><img src="../img/design/logo.png" alt="LOGO" class="logo"></figure> amaBuy</h1>
						<table>
							<tr class="names">
								<th>ID</th>
								<th>Назва</th>
								<th>Автор</th>
								<th>Категорія</th>
								<th>Виробник</th>
								<th>Ціна</th>
								<th>Кількість</th>
								<th>Дії</th>
							</tr>
							<?php 
								ADMIN::echoShopItems("SELECT * FROM `shopitems` INNER JOIN `shopcategories` ON shopitems.Category_id = shopcategories.Category_ID INNER JOIN `producers` ON shopitems.Producer_id = producers.Producer_ID INNER JOIN `users` ON shopitems.User_id = users.User_ID WHERE`isVisible` = 1 ORDER BY `shopitems`.`AddTime` DESC");
							?>
						</table>
					</div>
				<?php
			} else if (ADMIN::checkPanelItems($_GET,"shOpItEmswAItIng")) {
				?>
					<div class="meItem shOpItEmswAItIng">
						<h1>Всі товари на <figure><img src="../img/design/logo.png" alt="LOGO" class="logo"></figure> amaBuy</h1>
						<table>
							<tr class="names">
								<th>ID</th>
								<th>Назва</th>
								<th>Автор</th>
								<th>Категорія</th>
								<th>Виробник</th>
								<th>Ціна</th>
								<th>Кількість</th>
								<th>Дії</th>
							</tr>
							<?php 
								ADMIN::echoShopItemsWaiting("SELECT * FROM `shopitems` INNER JOIN `shopcategories` ON shopitems.Category_id = shopcategories.Category_ID INNER JOIN `producers` ON shopitems.Producer_id = producers.Producer_ID INNER JOIN `users` ON shopitems.User_id = users.User_ID WHERE `isVisible` = 0 ORDER BY `shopitems`.`AddTime` DESC");
							?>
						</table>
					</div>
				<?php
			} else if (ADMIN::checkPanelItems($_GET,"shOpcAtEgOrIEs")) {
				?>
					<div class="meItem shOpcAtEgOrIEs">
						<h1>Всі категорії товарів на <figure><img src="../img/design/logo.png" alt="LOGO" class="logo"></figure> amaBuy</h1>
						<table>
							<tr class="names">
								<th>ID</th>
								<th>Назва</th>
								<th>Дії</th>
							</tr>
							<tr>
								<td>?</td>
								<td>?</td>
								<td class="btns"><button itemAction="add" class="full"><i class='bx bx-plus'></i></button></td>
							</tr>
							<?php 
								ADMIN::echoShopItemsCategoties("SELECT * FROM `shopcategories` ORDER BY `shopcategories`.`Category_ID` DESC");
							?>
						</table>
					</div>
				<?php
			} else if (ADMIN::checkPanelItems($_GET,"shOpprOdUcErs")) {
				?>
					<div class="meItem shOpprOdUcErs">
						<h1>Всі виробники товарів на <figure><img src="../img/design/logo.png" alt="LOGO" class="logo"></figure> amaBuy</h1>
						<table>
							<tr class="names">
								<th>ID</th>
								<th>Назва</th>
								<th>Дії</th>
							</tr>
							<tr>
								<td>?</td>
								<td>?</td>
								<td class="btns"><button itemAction="add" class="full"><i class='bx bx-plus'></i></button></td>
							</tr>
							<?php 
								ADMIN::echoShopItemsProducers("SELECT * FROM `producers` ORDER BY `producers`.`Producer_ID` DESC");
							?>
						</table>
					</div>
				<?php
			}
		?>

		<div class="areYouSure">
			<div class="areYouSureBlock">
				<header>
					<h1>Ви впевнені?</h1>
					<i class='bx bx-plus'></i>
				</header>
				<main class="deleteshOpcAtEgOrIEs">
					<p>Добре обдумайте це рішення.</p>
					<p>Повернути видалену категорію НЕМОЖЛИВО</p>
					<p>Дійсно бажаєте видалити?</p>
				</main>
				<main class="deleteshOpItEms">
					<p>Добре обдумайте це рішення.</p>
					<p>Повернути видалений товар НЕМОЖЛИВО</p>
					<p>Дійсно бажаєте видалити?</p>
				</main>
				<main class="deleteUsErs">
					<p>Добре обдумайте це рішення.</p>
					<p>Повернути видалений товар НЕМОЖЛИВО</p>
					<p>Дійсно бажаєте видалити?</p>
				</main>
				<main class="deleteshOpItEmswAItIng">
					<p>Добре обдумайте це рішення.</p>
					<p>Повернути видалений товар НЕМОЖЛИВО</p>
					<p>Дійсно бажаєте видалити?</p>
				</main>
				<main class="deleteshOpprOdUcErs">
					<p>Добре обдумайте це рішення.</p>
					<p>Повернути видаленого виробника НЕМОЖЛИВО</p>
					<p>Дійсно бажаєте видалити?</p>
				</main>
				<main class="addshOpcAtEgOrIEs">
					<h2>Введіть назву нової категорії</h2>
					<input type="text">
				</main>
				<main class="addshOpprOdUcErs">
					<h2>Введіть назву нового виробника</h2>
					<input type="text">
				</main>
				<main class="addshOpItEmswAItIng">
					<p>Ви дійсно бажаєте додати цей товар?</p>
				</main>
				<main class="hideshOpItEms">
					<p>Ви дійсно бажаєте сховати цей товар?</p>
				</main>
				<footer> 
					<form method="POST">
						<input type="hidden">
						<input type="submit" value="TAK !">
					</form>
				</footer>
			</div>
		</div>

	</div>
</div>