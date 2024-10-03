

<?php
require('../model/database.php');

// Query to get all products
$query = 'SELECT * FROM products ORDER BY productID';
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><?php echo htmlspecialchars($product['version']); ?></td>
                <td><?php echo htmlspecialchars($product['releaseDate']); ?></td>
                <td>
                    <form action="delete_product.php" method="post">
                        <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Product</h2>
    <form action="add_product.php" method="post">
        <label>Name:</label>
        <input type="text" name="name"><br>

        <label>Version:</label>
        <input type="text" name="version"><br>

        <label>Release Date:</label>
        <input type="date" name="releaseDate"><br>

        <input type="submit" value="Add Product">
    </form>
</main>
<?php include '../view/footer.php'; ?>
