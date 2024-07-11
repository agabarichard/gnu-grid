<?php
include("connection.php");
// include("files.php");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap-5.3.0-alpha1/dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Create Your Account</h2>
            <p>Made with love for designers & developers.</p>
            <form action="connection.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Akim">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Tom">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required 
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                    title="Please enter a valid email address">
                </div>
                <!-- <div class="mb-3">
                    <label for="nationalid" class="form-label">National ID:</label>
                    <input type="file" class="form-control" id="nationalid" name="nationalid">
                </div> -->
                <div class="mb-3">
                    <label for="phonenumber" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control" id="phonenumber" name="phonenumber" placeholder="+256-770-000-000">
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input type="date" class="form-control" id="dob" name="dob" placeholder="01/01/2033">
                </div>
                <div class="mb-3">
                    <label for="categories" class="form-label">Categories:</label>
                    <select class="form-select" id="categories" name="categories" aria-label="select category">
                        <option selected>select your category</option>
                        <option value="farmer">Farmer</option>
                        <option value="collector">Collector</option>
                        <option value="agent">Agent</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select class="form-select" id="gender" name="gender" aria-label="select gender">
                        <option selected>select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required 
                    pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#]).{5,}$"
                    maxlength="10" 
                    title="Password must be more than 4 characters, and include at least one letter, one number, and one symbol.">
                </div>
                <div class="checkbox-group mb-3">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms and Conditions</a></label>
                </div>
                <button type="submit" class="btn btn-primary">Create My Account</button>
            </form>
            <p class="login-link" style="color: #ccc;">Already have an account? <a href="logIn.php">Log in</a></p>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
