<?php
require_once '../model/models.php';

deleteReview(connectDB(), [':id' => $_GET['id']]);

header('Location: movie.php?id=' . $_GET['movie_id']);