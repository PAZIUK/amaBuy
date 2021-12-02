<?php 
	if (isset($_SESSION["auth"])&&$_SESSION["auth"] == true) {
		header( 'Location: index.php' );
	} else {
		if(!empty($_POST)){
			$typeAddUser = $_POST["typeAddUser"];
			if ($typeAddUser=="reg") {
				$login = $_POST["login"];
				$name = trim($_POST["name"]);
				$password1 = $_POST["password1"];
				$password2 = $_POST["password2"];
				$mail = $_POST["mail"];
				$phone = $_POST["telephone"];
				$options = [
				    'cost' => 12,
				];
				$hashPassword = password_hash($password2, PASSWORD_BCRYPT, $options);
				$loginAttempts = 0;

				$error = USER::Validator($login,$name,$password1,$password2,$mail,$phone);
				?>
					<div id="content" class="errors">
						<div class="errors">
							<?php
								for ($i=0; $i < count($error); $i++) { 
									echo "<div class='errorItem'>
											<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>$error[$i]
										</div>"; 
								}
							?>
						</div>
					</div>
				<?php
				if(empty($error)){
					USER::addUser($login,$name,$hashPassword,$mail,$phone,$loginAttempts);
		   			exit(); 
				} else {
					?>
					<script>
						setTimeout(()=>{
							window.location.href = "index.php?action=addUser";
						},5000)
					</script>
					<?php
				}
			} else if ($typeAddUser=="log"){
				$mysqli = DATABASE::Connect();
				$username = $_POST['login'];
				$options = [
				    'cost' => 12,
				];
				$password = $_POST['password'];
				$loginAttempts = 0;
				$mysqli->set_charset("utf8mb4");
				$user = USER::getUserByLogin($mysqli,$username,1);
				$result = USER::getUserByLogin($mysqli,$username,2);
				$_SESSION["loginAttempts"] = $user["LoginAttempts"];
				?>
				<div id="content" class="errors">
					<div class="errors">
				<?php
				if($user!=NULL){
					if($_SESSION["loginAttempts"]>=5) {
						$canIAdd1ToAttempts = false;
					} else {
						$canIAdd1ToAttempts = true;
					}
					if(count($user)>0||(isset($_SESSION["loginAttempts"])&&$_SESSION["loginAttempts"]<1)){
					 	$passwordBD = $user["Password"];
					 	$isUser = USER::userExists($username,USER::getUserByLogin($mysqli,$username,1));
						if (password_verify($password, $passwordBD)&&!$isUser==true) {
							?>
							<script>
								document.querySelector(".loginError").style.opacity = "0";
								document.querySelector(".loginWait").style.opacity = "0";
							</script>
							<?php
							$_SESSION["ID"] = $user["User_ID"];
							$_SESSION["USERNAME"] = $user["Username"];
							if (intval($user["ADMIN"]) == 1) {
								$_SESSION["isAdmin"] = true;
							} else {
								$_SESSION["isAdmin"] = false;
							}
							$_SESSION["reg"] = true;
							$_SESSION["auth"] = true;
							$_SESSION["loginAttempts"] = 0;
							$_SESSION["login5Min"] = true;
							$sql = "UPDATE users SET LoginAttempts = ? WHERE username = ?"; // SQL with parameters
							$stmt = $mysqli->prepare($sql); 
							$stmt->bind_param("is", $_SESSION["loginAttempts"],$username);
							$stmt->execute();
							USER::updateLastLoginDate();
							header( 'Location: index.php?action=logSuccess' );
				   			exit();
						} else {
							USER::setLoginAttempts($canIAdd1ToAttempts,$username,$user);
							if ($_SESSION["loginAttempts"] == 5&&$_SESSION["login5Min"] == false) {
								?>
									<div class='errorItem'>
										<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>
										Зачекайте 5 хвилин і спробуйте ще раз!
									</div>
								<?php
							}
							?>
									<div class='errorItem'>
										<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>
										Невірний логін або пароль!
									</div>
							<script>
								setTimeout(()=>{
									window.location.href = "index.php?action=addUser";
								},2000)
							</script>
							<?php
						}   
					} else {
						?>
								<div class='errorItem'>
									<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>
									Невірний логін або пароль!
								</div>
							</div>
						</div>
						<script>
							setTimeout(()=>{
								window.location.href = "index.php?action=addUser";
							},2000)
						</script>
						<?php
					}
				} else {
					?>
							<div class='errorItem'>
								<img src='https://img.icons8.com/ios-glyphs/20/fff000/error--v1.png'/>
								Невірний логін або пароль!
							</div>
					<script>
						setTimeout(()=>{
							window.location.href = "index.php?action=addUser";
						},2000)
					</script>
					<?php
				}
				?>
					</div>
				</div>
				<?php
			}
		} else { ?>
				<div id="forgetPassword">
					<div class="forgetPasswordBlock">
						<header>
							<h1>Забули пароль?</h1>
							<i class='bx bx-plus'></i>
						</header>
						<main>
							<p>Заспокойтесь і спробуйте його згадати.</p>
							<p>Може ви кудись його записали?</p>
						</main>
						<footer> 
							<button>Дякую !</button>
						</footer>
					</div>		
				</div>
				<div id="content">
					<div class="wrapper">
						<div class="container">
							<div class="background">
								<div class="box signin">
									<h2>Вже маєте акаунт?</h2>
									<button class="signinBtn">Увійти</button>
								</div>
								<div class="box signup">
									<h2>Ще не маєте акаунта?</h2>
									<button class="signupBtn">Реєстрація</button>
								</div>
							</div>
							<div class="formBox">
								<div class="form signinForm">
									<form action="index.php?action=addUser" method="POST">
										<h1>Увійти</h1>
										<input type="text" name="login" placeholder="Введіть свій логін">
										<input type="password" name="password" placeholder="Введіть свій пароль">
										<input type="submit" value="УВІЙТИ">
										<div>Забули пароль?</div>

										<input type="hidden" name="typeAddUser" value="log">
									</form>
								</div>
								<div class="form signupForm">
									<form action="index.php?action=addUser" method="POST">
										<h1>Реєстрація</h1>
										<input type="text" name="login" placeholder="Введіть свій логін">
										<input type="text" name="name" placeholder="Введіть своє ім'я">
										<input type="password" name="password1" placeholder="Введіть пароль">
										<input type="password" name="password2" placeholder="Повторіть введений пароль">
										<input type="mail" name="mail" placeholder="Введіть свою пошту">
										<input name="telephone" placeholder="Введіть свій номер телефону" type="tel">
										<input type="submit" value="РЕЄСТРАЦІЯ">

										<input type="hidden" name="typeAddUser" value="reg">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script src="./js/addUser.js"></script>
			<?php 
		}
	}
?>
