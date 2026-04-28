<?php
require_once '../model/models.php';

if ($_GET['type'] == 'movie') {
    $data = [
        ':id' => $_POST['id'],
        ':title' => $_POST['title'],
        ':year' => $_POST['year'],
        ':description' => $_POST['description'],
        ':genre_id' => $_POST['genre_id'] ?: null,
        ':actors' => $_POST['actors'] ?? null,
        ':poster' => $_POST['poster'] ?? null
    ];
    updateMovie(connectDB(), $data);
    header('Location: ../main.php?tab=movies');
} else {
    $data = [
        ':id' => $_POST['id'],
        ':name' => $_POST['name'],
        ':email' => $_POST['email']
    ];
    updateUser(connectDB(), $data);
    header('Location: ../main.php?tab=users');
}
exit();