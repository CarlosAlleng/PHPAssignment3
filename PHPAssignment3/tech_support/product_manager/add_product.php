<?php
require('../model/database.php');

$name = filter_input(INPUT_POST, 'name');
$version = filter_input(INPUT_POST, 'version');
$releaseDate = filter_input(INPUT_POST, 'releaseDate');

if ($name == null || $version == null || $releaseDate == null) {
    $error = "Invalid product data. Please check all fields and try again.";
    include('../errors/error.php');
} else {
    $query = 'INSERT INTO products (name, version, releaseDate)
              VALUES (:name, :version, :releaseDate)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':releaseDate', $releaseDate);
    $statement->execute();
    $statement->closeCursor();

    // Redirect to the product list
    header('Location: index.php');
}
?>
