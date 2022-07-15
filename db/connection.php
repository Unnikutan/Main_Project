<?php
	$conn = mysqli_connect("localhost","root","","garbage");
	if(!$conn){
		?>
		<script type="text/javascript">
			alert("Server Down");
			window.location.href="index.php";
		</script>
		<?php
	}
	session_start();
?>