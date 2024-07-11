<?php
    session_start();
    // include("login_process.php");
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form-container" >
            <h2>LogIn to Your account</h2>
            <p>Welcome  and  be at peace</p>
            <form  action="login_process.php" method="POST">
            
                <div class="mb-3">
                    <label for="email" class="form-label">Email Addresss:</label>
                
                    <input type="email" class="form-control" id="email" required 
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                    title="Please enter a valid email address" >
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Passward:</label>
                    <input type="password" class="form-control" id="password" required 
                    pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#]).{5,}$"
                    maxlength="10" 
                    title="Password must be more than 4 characters, and include at least one letter, one number, and one symbol.">
                </div>
               
                <button type="submit">LogIn</button>
            </form>
           
            <p class="login-link" style="color: #ccc;">You don't have an account? <a href="signUp.php">Create an account</a></p>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
