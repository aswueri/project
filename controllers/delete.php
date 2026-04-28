<?php
require_once '../model/models.php';

if ($_GET['type'] == 'movie') {
    deleteMovie(connectDB(), [':id' => $_GET['id']]);
} else {
    deleteUser(connectDB(), [':id' => $_GET['id']]);
}

header('Location: ../main.php');