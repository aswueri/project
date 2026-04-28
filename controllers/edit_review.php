<?php
require_once '../model/models.php';

$review = selectReviewById(connectDB(), [':id' => $_GET['id']]);

include '../views/edit_review.view.php';
?>