<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'mydb';
$username = 'root';
$password = '';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';
$income = $_POST['income'] ?? '';
$preferences = $_POST['preferences'] ?? '';
$location = $_POST['location'] ?? '';
$categoryFilter = $_POST['category'] ?? '';

// Insert user data into the database
$sql = "INSERT INTO user_schemes (name, email, age, income, preferences, location) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisss", $name, $email, $age, $income, $preferences, $location);
$stmt->execute();

// Start the base query
$sql = "SELECT * FROM schemes WHERE 1=1";

// Add category filter if selected
if (!empty($categoryFilter)) {
    $sql .= " AND category = '" . $conn->real_escape_string($categoryFilter) . "'";
}

// Check for preferences
if (!empty($preferences)) {
    $preferenceArray = explode(',', $preferences);
    $preferenceString = implode("','", array_map('trim', $preferenceArray));
    $sql .= " AND (category IN ('$preferenceString') OR description LIKE '%" . $conn->real_escape_string($preferences) . "%')";
}

// Execute the query
$result = $conn->query($sql);

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relevant Schemes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .scheme-container {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
        }

        .scheme-container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .scheme-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .view-more-btn {
            display: block;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 8px;
            border-radius: 5px;
            text-decoration: none;
        }

        .view-more-btn:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
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
    <h2 class="text-center mb-4" style="font-family: Arial, sans-serif;">Relevant Schemes for You</h2>
    <div class="row">
        <!-- Sidebar for Filters -->
        <div class="col-md-3">
            <div class="sidebar p-3 border rounded">
                <h4>Filters</h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">All</option>
                            <option value="health" <?php if ($categoryFilter === 'health') echo 'selected'; ?>>Health</option>
                            <option value="medicine" <?php if ($categoryFilter === 'medicine') echo 'selected'; ?>>Medicine</option>
                            <option value="education" <?php if ($categoryFilter === 'education') echo 'selected'; ?>>Education</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="location">Location (Display Only)</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($location); ?>" readonly>
                    </div>
                    <input type="hidden" name="preferences" value="<?php echo htmlspecialchars($preferences); ?>">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="row">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="col-md-12">
                            <div class="scheme-container">
                            <img src="Source/for-you.png" alt="For You Icon" style="width: 50px; height: 50px;" class="d-block mx-auto mb-3">
                                <div class="scheme-title"><?php echo htmlspecialchars($row['scheme_name']); ?></div>
                                <p class="scheme-description"><?php echo htmlspecialchars($row['description']); ?></p>
                                <p><strong>Eligibility:<br></strong> <?php echo htmlspecialchars($row['eligibility_criteria']); ?></p>
                                <p><strong>Benefits:<br></strong> <?php echo htmlspecialchars($row['benefits']); ?></p>
                                <p><strong>Application Process:<br></strong> <?php echo htmlspecialchars($row['application_process']); ?></p>
                                <a href="view_more.php?id=<?php echo $row['scheme_id']; ?>" class="view-more-btn">View More</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No schemes found based on your preferences.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
