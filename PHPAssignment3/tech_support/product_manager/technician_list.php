<?php
require('../model/database.php');

// Query to get all technicians
$query = 'SELECT * FROM technicians ORDER BY techID';
$statement = $db->prepare($query);
$statement->execute();
$technicians = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>
<main>
    <h1>Technician List</h1>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($technicians as $technician) : ?>
            <tr>
                <td><?php echo htmlspecialchars($technician['firstName']); ?></td>
                <td><?php echo htmlspecialchars($technician['lastName']); ?></td>
                <td><?php echo htmlspecialchars($technician['email']); ?></td>
                <td><?php echo htmlspecialchars($technician['phone']); ?></td>
                <td>
                    <form action="delete_technician.php" method="post">
                        <input type="hidden" name="techID" value="<?php echo $technician['techID']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Technician</h2>
    <form action="add_technician.php" method="post">
        <label>First Name:</label>
        <input type="text" name="firstName"><br>

        <label>Last Name:</label>
        <input type="text" name="lastName"><br>

        <label>Email:</label>
        <input type="email" name="email"><br>

        <label>Phone:</label>
        <input type="text" name="phone"><br>

        <input type="submit" value="Add Technician">
    </form>
</main>
<?php include '../view/footer.php'; ?>
