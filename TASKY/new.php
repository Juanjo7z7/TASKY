<?php include('includes/header.php'); ?>

<?php
include("database/db.php");

if ($_POST) {
	$name = $_POST['userName'];

	try {
	    $query = "INSERT INTO usuarios VALUES(NULL, '$name')";
		$request = $connection->prepare($query);

		$request->execute();

		echo "
		<script>
		  document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Usuario creado correctamente'));
		</script>
		";
		echo "
		<script>
			document.addEventListener('DOMContentLoaded', () => redirect('$urlServer/index.php', 1000));
		</script>
		";
	} catch (Exception $error) {
		echo "
		<script>
		  document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Usuario \"$name\" ya existe', 3000, 'danger'));
		</script>
		";
		
	}
}
?>
<main class="d-flex flex-column justify-content-center align-items-center mani ">
	<h1 class="text-white">..:::TASKY:::..</h1>
	<form action="new.php" method="post">
		<div class="mb-3">
			<h2>Crea tu usuario</h2>
			<input type="text" class="form-control" id="userName" name="userName" placeholder="Ingresa tu Usuario" required>
		</div>
		<button class="btn btn-primary" type="submit">Enviar</button>

	</form>
	<div id="alert"></div>
</main>
<?php include('includes/footer.php'); ?>