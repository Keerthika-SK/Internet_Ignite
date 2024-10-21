<?php
// Database connection parameters
$host = 'localhost'; // Change this if your database is hosted elsewhere
$dbname = 'mydb'; // Replace with your database name
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all schemes from the database
$sql = "SELECT * FROM schemes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Schemes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
            font-family: 'Arial', sans-serif; /* Beautiful font */
        }

        .scheme-container {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            background-color: white; /* White background for the container */
        }

        .scheme-title {
            font-size: 1.5rem; /* Title font size */
            font-weight: bold;
            color: #007bff; /* Blue color for titles */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center" style="font-size: 2.5rem; font-weight: bold;">All Schemes</h2>
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-6">
                    <div class="scheme-container">
                        <div class="scheme-title"><?php echo htmlspecialchars($row['scheme_name']); ?></div>
                        <div><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></div>
                        <div><strong>Eligibility:</strong> <?php echo htmlspecialchars($row['eligibility_criteria']); ?></div>
                        <div><strong>Benefits:</strong> <?php echo htmlspecialchars($row['benefits']); ?></div>
                        <div><strong>Application Process:</strong> <?php echo htmlspecialchars($row['application_process']); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No schemes available.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
