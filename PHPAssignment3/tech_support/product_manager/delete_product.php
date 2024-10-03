<?php
require('../model/database.php');

$productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);

if ($productID == null || $productID == false) {
    $error = "Missing or incorrect product ID.";
    include('../errors/error.php');
} else {
    $query = 'DELETE FROM products WHERE productID = :productID';
    $statement = $db->prepare($query);
    $statement->bindValue(':productID', $productID);
    $statement->execute();
    $statement->closeCursor();

    // Redirect to the product list
    header('Location: index.php');
}
?>
