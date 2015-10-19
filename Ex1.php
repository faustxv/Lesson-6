<form method="POST">
	Назва БД:   <input type="text" name="db" required>
	Користувач: <input type="text" name="login" required>
	Пароль:     <input type="password" name="pass">
	            <input type="submit" value="Enter">
</form>
	
	<?php 
		if (isset($_POST['db'])) {
			try {
			 	$db = new PDO('mysql:host=localhost; dbname='.$_POST['db'].'; charset=utf8',$_POST['login'],$_POST['pass']);
			 	$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 	echo "Ви ввійшли<br>";
			}
			catch(PDOException $e) {
		 		die("Введені невірні або не існуючі дані.<br>");
			}		
			try {
			 	$cr_table = $db -> query('CREATE TABLE `Users` (
					`uid` int NOT NULL AUTO_INCREMENT,
					`name` varchar(255),
					`password` varchar(255),
					PRIMARY KEY(`uid`) ) DEFAULT CHARACTER SET=utf8;'
			 	);
			 	echo "Табличку <b>Users</b> створено";
			}
			catch(PDOException $e) {
		 		die("Таблиця <b>Users</b> вже існує.");
			}
		}
	?>