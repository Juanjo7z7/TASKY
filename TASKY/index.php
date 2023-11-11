<?php include('includes/header.php'); ?>
<?php
include("database/db.php");

if ($_POST) {
    $name = $_POST['name'];

    try {
        $query = "SELECT * FROM usuarios WHERE name = '$name'";

        $request = $connection->prepare($query);
        $request->execute();

        $resultUser = $request->fetch(PDO::FETCH_LAZY);

        if ($resultUser) {
            $_SESSION['id'] = $resultUser['id'];
            $_SESSION['name'] = $resultUser['name'];
            echo "<script>
	        document.addEventListener('DOMContentLoaded', () => {
	       	redirect('$urlServer/home.php', 0);
        	});
            </script>";
        } else {
            $_SESSION['message'] = 'Este usuario no existe';
            $_SESSION['message_type'] = 'danger';
        }
    } catch (Exception $error) {
        echo $error;
    }
}

?>


<main class="d-flex flex-column justify-content-center align-items-center mani ">
    <h1>Inicio de sesion</h1>
    <h1 class="text-white">..:::TASKY:::..</h1>
    <p class="text-white w-50">En Tasky, entendemos lo ocupada que puede ser tu vida y lo difícil que es mantener todo organizado. Es por eso que creamos esta plataforma intuitiva y fácil de usar para ayudarte a gestionar tus tareas de manera efectiva y sin complicaciones.</p>
    <form action="index.php" method="post">
        <div class="mb-3">
            <label for="nameUser" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="nameUser" name="name" placeholder="Ingresa tu Usuario">
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p>¿No tienes un usuario?, <a href="<?php echo $urlnew; ?>">Crea uno presionando aqui</a></p>
</main>
<?php include 'includes/footer.php'; ?>