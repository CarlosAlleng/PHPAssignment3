<?php
require('../model/database.php');

$techID = filter_input(INPUT_POST, 'techID', FILTER_VALIDATE_INT);

if ($techID == null || $techID == false) {
    $error = "Missing or incorrect technician ID.";
    include('../errors/error.php');
} else {
    $query = 'DELETE FROM technicians WHERE techID = :techID';
    $statement = $db->prepare($query);
    $statement->bindValue(':techID', $techID);
    $statement->execute();
    $statement->closeCursor();

    // Redirect back to the technician list
    header('Location: technician_list.php');
}
?>
