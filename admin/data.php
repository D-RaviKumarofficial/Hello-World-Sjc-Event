<?php
include "../includes/connection.php";  

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");  
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["year"])) {
    $year = $_POST["year"];
    
    $bannerImage = isset($_FILES["banner_image"]) ? uploadFile($_FILES["banner_image"]) : null;
    $invitationImage = isset($_FILES["invitation_image"]) ? uploadFile($_FILES["invitation_image"]) : null;
    $certificateImage = isset($_FILES["certificate_image"]) ? uploadFile($_FILES["certificate_image"]) : null;
    $promoVideo = isset($_FILES["promo_video"]) ? uploadFile($_FILES["promo_video"]) : null;
    $otherVideo = isset($_FILES["other_video"]) ? uploadFile($_FILES["other_video"]) : null;
    
    $groupPhoto = isset($_FILES["group_photo"]) ? uploadFile($_FILES["group_photo"]) : null;

    $sql = "INSERT INTO media (year";
    $values = "VALUES ('$year'";

    if ($bannerImage) {
        $sql .= ", banner_image";
        $values .= ", '$bannerImage'";
    }
    if ($invitationImage) {
        $sql .= ", invitation_image";
        $values .= ", '$invitationImage'";
    }
    if ($certificateImage) {
        $sql .= ", certificate_image";
        $values .= ", '$certificateImage'";
    }
    if ($promoVideo) {
        $sql .= ", promo_video";
        $values .= ", '$promoVideo'";
    }
    if ($otherVideo) {
        $sql .= ", other_video";
        $values .= ", '$otherVideo'";
    }
    if ($groupPhoto) {
        $sql .= ", group_photo";
        $values .= ", '$groupPhoto'";
    }

    $sql .= ") " . $values . ")";

    if ($conn->query($sql) === TRUE) {
        $message = "New record created successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function uploadFile($file) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (in_array($imageFileType, ["jpg", "jpeg", "png", "gif", "mp4"])) {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return null; 
        }
    } else {
        return null; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Media</title>
    
    <!-- Bootstrap CSS for Responsiveness -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AOS (Animate On Scroll) CDN -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f7fc;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .btn-block {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <h1>Upload Media Files</h1>
        
        <form action="../includes/logout.php" method="POST" data-aos="fade-right" data-aos-duration="1000">
            <button type="submit" name="logout" class="btn btn-danger btn-block">Logout</button>
        </form>

        <?php
        if (isset($message)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '$message',
                    showConfirmButton: true
                });
            </script>";
        }
        ?>

        <div class="form-container" data-aos="fade-up" data-aos-duration="1500">
            <form action="#" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="year">Year:</label>
                    <select name="year" class="form-control" required>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="banner_image">Banner Image (Optional):</label>
                    <input type="file" name="banner_image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="invitation_image">Invitation Image (Optional):</label>
                    <input type="file" name="invitation_image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="certificate_image">Certificate Image (Optional):</label>
                    <input type="file" name="certificate_image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="group_photo">Group Photo (Optional):</label>
                    <input type="file" name="group_photo" class="form-control">
                </div>

                <div class="form-group">
                    <label for="promo_video">Promo Video (Optional):</label>
                    <input type="file" name="promo_video" class="form-control">
                </div>

                <div class="form-group">
                    <label for="other_video">Other Video (Optional):</label>
                    <input type="file" name="other_video" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary btn-block" >Upload</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js and AOS Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Initialize AOS Animations -->
    <script>
        AOS.init();
    </script>
</body>
</html>
