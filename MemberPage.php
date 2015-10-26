<?PHP
	session_start();
	if(empty($_SESSION['NAME']) || empty($_SESSION['LAST'])){
		echo '<script>window.location = "Login.php";</script>';
	}
?>
Member page
<hr>
<?PHP
	echo "NAME : ".$_SESSION['NAME']."<br>";
	echo "LAST : ".$_SESSION['LAST']."<br>";
	echo "<a href='changepass.php'>Change pass</a><br>";
	echo "<a href='Logout.php'>Logout</a>";
?>