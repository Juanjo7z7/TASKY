<?php

include('database/db.php');

if ($_POST) {
  $id = $_POST['id'];
  try {
    $query = "DELETE FROM task WHERE id = $id";
    $request = $connection->prepare($query);
  
    $request->execute();

  header('Location: home.php');
  } catch (Exception $error) {
    echo $error;
  }
}
