<?php
require('../model/database.php');

// Fetch the customer details
$customerID = filter_input(INPUT_GET, 'customerID', FILTER_VALIDATE_INT);
$query = 'SELECT * FROM customers WHERE customerID = :customerID';
$statement = $db->prepare($query);
$statement->bindValue(':customerID', $customerID);
$statement->execute();
$customer = $statement->fetch();
$statement->closeCursor();

// Fetch the list of countries for the drop-down
$query = 'SELECT * FROM countries';
$statement = $db->prepare($query);
$statement->execute();
$countries = $statement->fetchAll();
$statement->closeCursor();
?>

<?php include '../view/header.php'; ?>
<main>
    <h1>Update Customer</h1>
    <form action="update_customer.php" method="post">
        <input type="hidden" name="customerID" value="<?php echo $customer['customerID']; ?>">

        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($customer['firstName']); ?>"><br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($customer['lastName']); ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>"><br>

        <label>Country:</label>
        <select name="countryCode">
            <?php foreach ($countries as $country) : ?>
                <option value="<?php echo $country['countryCode']; ?>" 
                    <?php if ($country['countryCode'] == $customer['countryCode']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($country['countryName']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" value="Update Customer">
    </form>
</main>
<?php include '../view/footer.php'; ?>
