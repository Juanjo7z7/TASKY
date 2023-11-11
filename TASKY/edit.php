<?php
include('database/db.php');
$title = '';
$description = '';

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	try {
		$query = "SELECT * FROM task WHERE id=$id";
		$request = $connection->prepare($query);

		$request->execute();

		$resultTask = $request->fetch(PDO::FETCH_LAZY);
	} catch (Exception $error) {
		echo $error;
	}
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
	<h1>Edita la tareas que seleccionaste</h1>
	<div class="row">
		<div class="col-md-4 mx-auto">
			<div class="card card-body">
				<form action="home.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					<div class="form-group">
						<input name="title" type="text" class="form-control" value="<?php echo $resultTask['title']; ?>" placeholder="Actualizar titulo">
					</div>
					<div class="form-group">
						<textarea name="description" class="form-control" cols="30" rows="10"><?php echo $resultTask['description']; ?></textarea>
					</div>
					<button class="btn-success" name="edit">
						Actualizar
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include('includes/footer.php'); ?>