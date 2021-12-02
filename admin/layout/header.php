<header>
	<nav class="meta">
		<div class="wrapper">
			<ul>
				<li><a href="#">Доставка і оплата</a></li>
				<li><a href="#">Пункт видачі</a></li>
				<li><a href="#">Підтримка</a></li>
				<li><a href="tel:+380123456789" class="telephone">+38 012 345 67 89</a></li>
			</ul>
		</div>	
	</nav>
	<nav class="main">
		<div class="wrapper">
			<a class="logo" href="index.php">
				<figure><img src="../img/design/logo.png" alt="LOGO" class="logo"></figure>
				<h1 class="logoText">amaBuy</h1>
			</a>
			<!-- <nav class="catalog">
				<button>
					<img src="https://img.icons8.com/material-outlined/24/ffffff/menu--v1.png"/>
					Каталог
				</button>
				<nav class="catalog_menu"></nav>
			</nav> -->
			<form action="search.php">
				<input type="text" placeholder="Пошук">
				<img src="https://img.icons8.com/ios-glyphs/30/000000/search--v1.png"/>
			</form>
			<nav class="preferences">
				<ul>
					<li>
						<button class="user">
							<i class='bx bx-user'></i>
							<div class="preferenceName">Профіль</div>
						</button>
						<section class="toggleHeaderBtnsMenu">
								<button link="index.php?action=me">Мій кабінет</button>
								<?php 
								if (!empty($_POST)&&isset($_POST["isLogout"])) {
									$isLogout = $_POST["isLogout"];
									if($isLogout=="true"){	
										session_unset();
										header( 'Location: ../index.php' );
									   	exit();
									}
								} else {
									?>
									<div class="content">
										<form action="index.php" method="POST">
											<input type="hidden" name="isLogout" value="true">
											<button class="logout"><i class='bx bx-log-out'></i>Вийти</button>
										</form>	
									</div>
									<?php
								}
							?>
						</section>
					</li>
					<!-- <li>
						<button class="compare" link="#">
							<i class='bx bx-bar-chart-alt'></i>
							<div class="preferenceName">Порівняння</div>
						</button>
					</li>
					<li>
						<button class="collection" link="#">
							<i class='bx bx-heart'></i>
							<div class="preferenceName">Колекція</div>
						</button>
					</li> -->
					<li>
						<button class="basket" link="index.php?action=myShop">
							<i class='bx bx-basket' ></i>
							<div class="preferenceName">Корзина</div>
						</button>
					</li>
				</ul>
			</nav>
		</div>
	</nav>
	<!-- <nav class="menu">
		<div class="wrapper">
			<ul>
				<li><a href="#" class="menuItem"></a></li>
				<li><a href="#" class="menuItem"></a></li>
				<li><a href="#" class="menuItem"></a></li>
				<li><a href="#" class="menuItem"></a></li>
				<li><a href="#" class="menuItem"></a></li>
				<li><a href="#" class="menuItem"></a></li>
				<li><a href="#" class="menuItem"></a></li>
				<li><a href="#" class="menuItem"></a></li>
				<li><a href="#" class="menuItem menuMoreBtn">Ще</a></li>
			</ul>
		</div>
	</nav> -->
</header>