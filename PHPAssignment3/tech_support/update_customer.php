<?php
require('../model/database.php');

$customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$countryCode = filter_input(INPUT_POST, 'countryCode');

if ($customerID == null || $firstName == null || $lastName == null || $email == null || $countryCode == null) {
    $error = "Invalid customer data. Please check all fields and try again.";
    include('../errors/error.php');
} else {
    $query = 'UPDATE customers
              SET firstName = :firstName, lastName = :lastName, email = :email, countryCode = :countryCode
              WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':countryCode', $countryCode);
    $statement->execute();
    $statement->closeCursor();

    header('Location: customer_list.php');
}
?>
