<?php
require('../model/database.php');
require('../model/product_db.php');

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version');
    $release_date = filter_input(INPUT_POST, 'release_date');

    // Validate inputs
    if (empty($code) || empty($name) || empty($version) || empty($release_date)) {
        $error = 'Please fill in all fields.';
    } else {
        add_product($code, $name, $version, $release_date);
        header("Location: index.php?action=view_products");
        exit();
    }
}
?>

<?php include '../view/header.php'; ?>
<main>
    <h2>Add Product</h2>
    <?php if ($error) : ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="add_product.php" method="post">
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" required><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="version">Version:</label>
        <input type="text" id="version" name="version" required><br>

        <label for="release_date">Release Date:</label>
        <input type="date" id="release_date" name="release_date" required><br><br>

        <input type="submit" value="Add Product">
    </form>
    <br>
    <a href="index.php?action=view_products">View Product List</a>
</main>
<?php include '../view/footer.php'; ?>
