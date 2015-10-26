<?PHP
	session_start();
	$conn = oci_connect("SYSTEM", "hobby29432", "//localhost/XE");
	if(empty($_SESSION['NAME']) || empty($_SESSION['LAST'])){
		echo '<script>window.location = "Login.php";</script>';
	}
?>
Change Pass
<hr>

<?PHP
	
	if(isset($_POST['submit'])){
if($_POST['password']==$_POST['conpassword']){
		$oldpass = trim($_POST['oldpass']);
		$password = trim($_POST['password']);
		$name = trim($_SESSION['NAME']);
		$query = "SELECT * FROM USERNAME WHERE PASS = '$oldpass'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		// Fetch each row in an associative array
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row){
		$query = "UPDATE USERNAME SET PASS=$password WHERE NAME='$name' and PASS='$oldpass'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
			echo '<script>window.location = "MemberPage.php";</script>';
		}
else{
echo "Wrong password ";
}
}else {echo "Confirm & pass does not match";}
}

		
	
	oci_close($conn);
?>

<form action='changepass.php' method='post'>
	OLD PASS <br>
	<input name='oldpass' type='password'><br>
	NEW PASS<br>
	<input name='password' type='password'><br><br>
	CONFIRM<br>
	<input name='conpassword' type='password'><br><br>
	<input name='submit' type='submit' value='Confirm!'>
</form>