<?php
if (function_exists('connectDB')) {
    return;
}

function connectDB() {
    return new PDO('mysql:host=localhost;dbname=kinoteka', 'root', '');
}

function selectAllUsers($pdo) {
    return $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
}

function selectUserById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute($id);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertUser($pdo, $data) {
    $sql = "INSERT INTO users (name, email) VALUES(:name, :email)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($data);
}

function updateUser($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    return $stmt->execute($data);
}

function deleteUser($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    return $stmt->execute($id);
}

function selectAllMovies($pdo) {
    return $pdo->query("SELECT m.*, g.name as genre_name FROM movies m LEFT JOIN genres g ON m.genre_id = g.id ORDER BY m.year DESC")->fetchAll(PDO::FETCH_ASSOC);
}

function selectMovieById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT m.*, g.name as genre_name FROM movies m LEFT JOIN genres g ON m.genre_id = g.id WHERE m.id = :id");
    $stmt->execute($id);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertMovie($pdo, $data) {
    $sql = "INSERT INTO movies (title, year, description, genre_id, actors, poster) VALUES (:title, :year, :description, :genre_id, :actors, :poster)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($data);
}

function updateMovie($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE movies SET title = :title, year = :year, description = :description, genre_id = :genre_id, actors = :actors, poster = :poster WHERE id = :id");
    return $stmt->execute($data);
}

function deleteMovie($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM movies WHERE id = :id");
    return $stmt->execute($id);
}

function selectAllGenres($pdo) {
    return $pdo->query("SELECT * FROM genres ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
}

function selectReviewsByMovieId($pdo, $movie_id) {
    $stmt = $pdo->prepare("SELECT r.*, u.name as user_name FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.movie_id = :movie_id ORDER BY r.created_at DESC");
    $stmt->execute($movie_id);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function selectReviewById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT r.*, u.name as user_name, m.title as movie_title FROM reviews r JOIN users u ON r.user_id = u.id JOIN movies m ON r.movie_id = m.id WHERE r.id = :id");
    $stmt->execute($id);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertReview($pdo, $data) {
    $sql = "INSERT INTO reviews (user_id, movie_id, rating, comment) VALUES (:user_id, :movie_id, :rating, :comment)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($data);
}

function updateReview($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE reviews SET rating = :rating, comment = :comment WHERE id = :id");
    return $stmt->execute($data);
}

function deleteReview($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = :id");
    return $stmt->execute($id);
}

function getAvgRating($pdo, $movie_id) {
    $stmt = $pdo->prepare("SELECT AVG(rating) as avg FROM reviews WHERE movie_id = ?");
    $stmt->execute([$movie_id]);
    $avg = $stmt->fetch();
    return round($avg['avg'] ?? 0, 1);
}
?>