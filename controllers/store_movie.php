<?php
require_once '../model/models.php';

if (isset($_POST['title'])) {
    $data = [
        ':title' => $_POST['title'],
        ':year' => $_POST['year'] ?? null,
        ':description' => $_POST['description'] ?? null,
        ':genre_id' => !empty($_POST['genre_id']) ? $_POST['genre_id'] : null,
        ':actors' => $_POST['actors'] ?? null,
        ':poster' => $_POST['poster'] ?? null
    ];
    insertMovie(connectDB(), $data);
}

header('Location: ../main.php?tab=movies');
exit();