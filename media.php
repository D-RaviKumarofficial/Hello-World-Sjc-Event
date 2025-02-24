<?php
include "includes/connection.php";

if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM media WHERE year = ? ORDER BY year DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $year);  
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media for Year <?= htmlspecialchars($year) ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        .media-container {
            margin-bottom: 30px;
            text-align: center;
        }
        .media-container img {
            width: 100%;
            max-width: 300px;
            height: auto;
            object-fit: cover;
            margin: 5px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .media-container img:hover {
            transform: scale(1.05);
        }
        .media-container h3 {
            font-size: 24px;
            color: #007bff;
            margin-top: 20px;
        }
        .media-container p {
            font-size: 16px;
            color: #555;
        }
        .media-container a {
            text-decoration: none;
            color: inherit;
        }
        .download-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin: 10px 0;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <div class="container my-5">
        <h1 class="text-center mb-5" data-aos="fade-up">Media for Year <?= htmlspecialchars($year) ?></h1>
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='media-container' data-aos='fade-up'>";
                echo "<h3 data-aos='fade-left'>Year: " . htmlspecialchars($row['year']) . "</h3>";

                $bannerImage = !empty($row['banner_image']) ? './admin/uploads/' . basename($row['banner_image'])  : './images/nodata.jpg';
                echo "<p data-aos='fade-right'>Banner Image: <a href='" . htmlspecialchars($bannerImage) . "' download><img src='" . htmlspecialchars($bannerImage) . "' alt='Banner Image'></a></p>";

                $invitationImage = !empty($row['invitation_image']) ? './admin/uploads/' . basename($row['invitation_image']) : './images/nodata.jpg';
                echo "<p data-aos='fade-right'>Invitation Image: <a href='" . htmlspecialchars($invitationImage) . "' download><img src='" . htmlspecialchars($invitationImage) . "' alt='Invitation Image'></a></p>";

                $certificateImage = !empty($row['certificate_image']) ? './admin/uploads/' . basename($row['certificate_image']) : './images/nodata.jpg';
                echo "<p data-aos='fade-right'>Certificate Image: <a href='" . htmlspecialchars($certificateImage) . "' download><img src='" . htmlspecialchars($certificateImage) . "' alt='Certificate Image'></a></p>";
                
                $groupPhoto = !empty($row['group_photo']) ? './admin/uploads/' . basename($row['group_photo']) : './images/nodata.jpg';
                echo "<p data-aos='fade-right'>Group Photo: <a href='" . htmlspecialchars($groupPhoto) . "' download><img src='" . htmlspecialchars($groupPhoto) . "' alt='Group Photo'></a></p>";

                $promoVideo = !empty($row['promo_video']) ? './admin/uploads/' . basename($row['promo_video']) : './images/nodata.jpg';
                echo "<p data-aos='fade-left'>Promo Video: <a href='" . htmlspecialchars($promoVideo) . "' class='download-btn' download>Download Promo Video</a></p>";

                $otherVideo = !empty($row['other_video']) ? './admin/uploads/' . basename($row['other_video']) : './images/nodata.jpg';
                echo "<p data-aos='fade-left'>Other Video: <a href='" . htmlspecialchars($otherVideo) . "' class='download-btn' download>Download Other Video</a></p>";
                
                echo "</div>"; 
            }
        } else {
            echo "<p>No data available for the selected year.</p>";
        }

        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200, 
            once: true, 
            offset: 100, 
        });
    </script>
</body>
</html>
