<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php"); // Redirect to login if not logged in
    exit;
}

// Database connection
$host = 'localhost'; // Change if necessary
$dbname = 'your_database_name'; // Replace with your database name
$db_username = 'your_username'; // Replace with your MySQL username
$db_password = 'your_password'; // Replace with your MySQL password
$conn = new mysqli($host, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scheme_name = $_POST['scheme_name'];
    $description = $_POST['description'];
    $eligibility_criteria = $_POST['eligibility_criteria'];
    $benefits = $_POST['benefits'];
    $application_process = $_POST['application_process'];
    $category = $_POST['category'];

    // Insert scheme details into the database
    $stmt = $conn->prepare("INSERT INTO schemes (scheme_name, description, eligibility_criteria, benefits, application_process, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $scheme_name, $description, $eligibility_criteria, $benefits, $application_process, $category);
    
    if ($stmt->execute()) {
        $message = "Scheme added successfully!";
    } else {
        $message = "Error adding scheme: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Admin Dashboard</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <h3>Add New Scheme</h3>
    <form method="POST">
        <div class="form-group">
            <label for="scheme_name">Scheme Name</label>
            <input type="text" class="form-control" name="scheme_name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="eligibility_criteria">Eligibility Criteria</label>
            <textarea class="form-control" name="eligibility_criteria" required></textarea>
        </div>
        <div class="form-group">
            <label for="benefits">Benefits</label>
            <textarea class="form-control" name="benefits" required></textarea>
        </div>
        <div class="form-group">
            <label for="application_process">Application Process</label>
            <textarea class="form-control" name="application_process" required></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" name="category" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Scheme</button>
    </form>
</div>

</body>
</html>
