<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("SYSTEM", "hobby29432", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>
Login form
<hr>

<?PHP
	
	if(isset($_POST['submit'])){
if($_POST['capt']==$_POST['captcha']){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$query = "SELECT * FROM USERNAME WHERE LOGIN='$username' and PASS='$password'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		// Fetch each row in an associative array
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row){
			$_SESSION['NAME'] = $row['NAME'];
			$_SESSION['LAST'] = $row['LAST'];
			echo '<script>window.location = "MemberPage.php";</script>';
		}
else{
echo "Login fail. ";
}
}else {echo "Wrong Captcha. ";}
}

		
	
	oci_close($conn);
?>

<form action='login.php' method='post'><?php $cap = rand(1000,9999);?>
	Username <br>
	<input name='username' type='input'><br>
	Password<br>
	<input name='password' type='password'><br><br>
	<?PHP echo "Captcha Number: $cap" ; ?>
	<input name='capt' type='hidden' value ='<?=$cap?>'><br><br>
	<input name='captcha' type='input'><br><br>
	<input name='submit' type='submit' value='Login'>
</form>
