<?php

$con = new PDO("mysql:host=localhost;dbname=dashboard",'root','');

if (isset($_POST["submit"])) {
	$str = $_POST["search"];
	$sth = $con->prepare("SELECT w.*, m.* FROM work_log w INNER JOIN m_user m ON m.user_id = w.user_id WHERE name= '$str' or w.user_id='$str'");

	$sth->setFetchMode(PDO:: FETCH_OBJ);
	$sth -> execute();

	if($row = $sth->fetch())
	{
		?>
		<br><br><br>
		
<?php 
	}
		
		
		else{
			echo "Name Does not exist";
		}


}

?>