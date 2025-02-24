<?php
session_start();

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if ($username === "ravi" && $password === "ivar") {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $success = "Login successful! Redirecting...";
        
        header("refresh:2;url=data.php");
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AOS (Animate On Scroll) CDN -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container" data-aos="fade-up" data-aos-duration="1000">
        <h2>Login</h2>
        
        <?php if ($success): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $success; ?>',
                    timer: 2000,  
                    showConfirmButton: false
                });
            </script>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?php echo $error; ?>'
                });
            </script>
        <?php endif; ?>
        
        <form action="index.php" method="POST" data-aos="fade-up" data-aos-duration="1500">
            <div class="form-group" data-aos="fade-left" data-aos-duration="1500">
                <label for="username">Name</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="form-group" data-aos="fade-right" data-aos-duration="1500">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" data-aos="zoom-in" data-aos-duration="1000">Login</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
