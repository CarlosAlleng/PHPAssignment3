<?php
require('../model/database.php');

$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone');

if ($firstName == null || $lastName == null || $email == null || $phone == null) {
    $error = "Invalid technician data. Please check all fields and try again.";
    include('../errors/error.php');
} else {
    $query = 'INSERT INTO technicians (firstName, lastName, email, phone)
              VALUES (:firstName, :lastName, :email, :phone)';
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->execute();
    $statement->closeCursor();

    // Redirect back to the technician list
    header('Location: technician_list.php');
}
?>
