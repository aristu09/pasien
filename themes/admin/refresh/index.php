
<html>
	<head>
		<script src="jquery-latest.js"></script> 
		<script>
		var refreshId = setInterval(function()
		{
			 $('#responsecontainer').load('oo.php');
		}, 1000);
		</script>
	</head>
	<body>					
		<div id="responsecontainer">
		</div>		
	</body>
</html>