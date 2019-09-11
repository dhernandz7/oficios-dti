<form action="/insertar" method="post">
	@csrf
	<input type="text" id="bd" name="bd">
	<input type="submit">
</form>

<button id="bd1">Base de datos 1</button>
<button id="bd2">Base de datos 2</button>
<script>
	inputbd = document.getElementById("bd");
	btn1 = document.getElementById("bd1");
	btn1.addEventListener('click', function(){
		inputbd.value = "sqlsrv";
		console.log(inputbd.value);
	});

	btn2 = document.getElementById("bd2");
	btn2.addEventListener('click', function(){
		inputbd.value = "sqlsrv2";
		console.log(inputbd.value);
	});
</script>