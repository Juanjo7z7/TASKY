<?php include('includes/header.php'); ?>
<?php
include("database/db.php");

if (empty($_SESSION['id'])) {
    header("location: index.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    try {
        $query = "DELETE FROM task WHERE id = $id";
        $request = $connection->prepare($query);

        $request->execute();

        echo "
    <script>
      document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Tarea eliminada correctamente', 3000, 'danger'));
    </script>
    ";
    } catch (Exception $error) {
        echo $error;
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    try {
        $query = "UPDATE task set title = '$title', description = '$description' WHERE id=$id";
        $request = $connection->prepare($query);

        $request->execute();

        echo "
        <script>
        document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Tarea editada correctamente', 3000));
        </script>
        ";
    } catch (Exception $error) {
        echo $error;
    }
}

if (isset($_POST['save_task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    try {
        $query = "INSERT INTO task(title, description, idusuario) VALUES ('$title', '$description', '" . $_SESSION['id'] . "')";
        $request = $connection->prepare($query);

        $request->execute();

        echo "
          <script>
          document.addEventListener('DOMContentLoaded', () => showAlert('#alert', 'Tarea guardada correctamente', 3000));
          </script>
          ";
    } catch (Exception $error) {
        echo $error;
    }
}



try {
    $query = "SELECT * FROM task WHERE idusuario = '" . $_SESSION['id'] . "'";
    $request = $connection->prepare($query);

    $request->execute();

    $resultTasks = $connection->query($query);
} catch (Exception $error) {
    echo $error;
}

?>



<head>
    <link rel="stylesheet" href="styles.css">
</head>
<main class="container p-4">
    <h1>Bienvenido <?php echo $_SESSION['name']; ?> estas son tus tareas</h1>
    <div class="row">
        <div class="col-md-4">
            <!-- MESSAGES -->
            <div id="alert"></div>


            <!-- ADD TASK FORM -->
            <div class="card card-body">
                <form action="home.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control form-control-lg mb-3" placeholder="Titulo de la tarea" autofocus>
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control form-control-lg mb-3" placeholder="Descripcion"></textarea>
                    </div>
                    <input type="submit" name="save_task" class="btn btn-success btn-block" value="Guardar la tarea">
                </form>
            </div>
        </div>
        <div class="col-md-8 p-2 bg-white d-flex justify-content-center align-items-center rounded-3">
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha de creacion</th>
                        <th>Eliminar/Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultTasks->rowCount() > 0) {
                        foreach ($resultTasks as $e) { ?>
                            <tr>
                                <td><?php echo $e['title']; ?></td>
                                <td><?php echo $e['description']; ?></td>
                                <td><?php echo $e['created_at']; ?></td>
                                <td class="d-flex gap-3 justify-content-center">
                                    <a href="edit.php?id=<?php echo $e['id'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <form action="home.php" method="post">
                                        <input type="hidden" value="<?php echo $e['id'] ?>" name="id">
                                        <button type="submit" class="btn btn-danger" name="delete">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>