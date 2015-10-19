<form method="POST">
	Login:    <input type="text" name="login" required>
	Password: <input type="password" name="pass" required>
	          <input type="submit" value="Enter">
</form>

	<?php 
		$d = 'test';
		$u = 'root';
		$p = '';
		try {
		  $db = new PDO('mysql:host=localhost; dbname='.$d.'; charset=utf8', $u, $p);
		  $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			die("Error: ".$e->getMessage());
		}
		if (isset($_POST['login'])) {
			$login    = $_POST['login'];
			$password = md5($_POST['pass']);
			$stmt     = $db ->prepare('SELECT * FROM `Users` WHERE `name`= :login');
			$stmt     ->execute(array('login' => $login));
			$row      = $stmt -> fetch(PDO :: FETCH_ASSOC);
			if (empty($row)) {
				$stmt = $db->prepare('INSERT INTO Users VALUES (NULL, :login , :password);');
			 	$stmt ->execute(array('login' => $login, 'password' => $password));
			 	echo 'Ви зареєструвалися та увійшли як <b>'.$login.'<b>';
			}
			elseif ($row['password'] == $password) {
				echo 'Ви ввійшли як <b>'.$login.'<b>';
			}
			else {
				echo 'Пароль не співпадає';
			}		
		}
	?>