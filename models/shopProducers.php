<?php 
	class PRODUCERS
	{
		public static function echoProducers(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `producers` ORDER BY `producers`.`Producer_ID` DESC";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			$myResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			for ($i=0; $i < count($myResult); $i++) {
				?>
				<section class="brands">
					<h1 class="name">Популярні бренди</h1>
					<ul>
					<?php
						for ($i=0; $i < count($myResult); $i++) {
							if (intval($myResult[$i]['Producer_ID'])>1) {
								?>
									<li><a href="index.php?action=shopProducer&prOdUcEr=<?php echo $myResult[$i]['Producer_ID']?>"><img src="<?php if(isset($_SESSION['isAdmin'])&&$_SESSION['isAdmin'] == true){ echo '../img/brands/'.$myResult[$i]['Producer_ID'].'.webp';} else {echo 'img/brands/'.$myResult[$i]['Producer_ID'].'.webp';}?>" alt=""></a></li>
								<?php
							}
						}
					?>
					</ul>
				</section>
				<?php
			}
		}
	}
?>