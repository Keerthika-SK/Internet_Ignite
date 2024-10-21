<?php
// Database connection parameters
$host = 'localhost'; // Update if necessary
$dbname = 'mydb'; // Replace with your DB name
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the scheme ID from the URL
$scheme_id = $_GET['id'] ?? 0; // Default to 0 if not found

// Fetch scheme details from the database
$sql = "SELECT * FROM schemes WHERE scheme_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $scheme_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the scheme exists
if ($result->num_rows > 0) {
    $scheme = $result->fetch_assoc();
} else {
    echo "<p>No scheme found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($scheme['scheme_name']); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header class="header d-flex justify-content-between align-items-center">
    <div class="logo">
        <a href="main.php"><img src="Source/keerthika logo.png" style="height:150px; width:300px;"></a>
    </div>
    <div class="search-container">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for schemes..." aria-label="Search">
            <div class="input-group-append">
                <button class="btn" type="button">Search</button>
            </div>
        </div>
    </div>
    <a href="login.php"><button class="btn">Sign In</button></a>
</header>

<div class="container mt-5">
    <h1 class="mb-4"><?php echo htmlspecialchars($scheme['scheme_name']); ?></h1>
    
    <p><strong>Description:<br></strong> <?php echo htmlspecialchars($scheme['description']); ?></p>
    <p><strong>Eligibility:<br></strong> <?php echo htmlspecialchars($scheme['eligibility_criteria']); ?></p>
    <p><strong>Benefits:<br></strong> <?php echo htmlspecialchars($scheme['benefits']); ?></p>
    <p><strong>Application Process:<br></strong> <?php echo htmlspecialchars($scheme['application_process']); ?></p>
    <p><strong>Location:</strong> <?php echo htmlspecialchars($scheme['location']); ?></p>
        <br>
        <br>
    <!-- Click to Visit Website Button -->
    <?php if (!empty($scheme['website_url'])): ?>
        <a href="<?php echo htmlspecialchars($scheme['website_url']); ?>" class="btn btn-success mt-3" target="_blank">Click to Visit Website</a>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary mt-4">Back to Schemes</a>
</div>
<footer class="footer bg-dark text-white text-center py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#about" class="text-white">About Us</a></li>
                    <li><a href="#faq" class="text-white">FAQ</a></li>
                    <li><a href="#contact" class="text-white">Contact</a></li>
                    <li><a href="#terms" class="text-white">Terms of Service</a></li>
                    <li><a href="#privacy" class="text-white">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>Email: <a href="mailto:info@schemegenie.com" class="text-white">info@schemegenie.com</a></p>
                <p>Phone: +1 234 567 890</p>
                <p>Address: 123 Scheme Street, City, Country</p>
            </div>
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white mr-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white mr-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <hr class="bg-white">
        <p class="mb-0">© 2024 Scheme Genie. All rights reserved.</p>
    </div>
</footer>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
