<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Schemes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px;
        }
        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
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
<div class="form-container">
    <div class="form-header">
        <h2>Find Your Schemes</h2>
        <p>Fill in the details to find suitable schemes for you.</p>
    </div>
    <form action="submit_schemes.php" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" id="age" name="age" required>
        </div>
        <div class="form-group">
            <label for="income">Annual Income (INR)</label>
            <input type="number" class="form-control" id="income" name="income" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="preferences">Preferences</label>
            <textarea class="form-control" id="preferences" name="preferences" rows="3" placeholder="e.g., Education, Health, Housing"></textarea>
        </div>
        <button type="submit" class="btn btn-custom btn-block">Submit</button>
    </form>
</div>
<!-- Footer Section -->
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
