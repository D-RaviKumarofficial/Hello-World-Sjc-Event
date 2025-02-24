<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department of Computer Applications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }
        video {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            transform: translate(-50%, -50%);
            background-size: cover;
        }
        h1 {
            margin-bottom: 20px;
        }
        button {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid white;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            font-size: 1.5em;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        button:hover {
            background-color: rgba(255, 255, 255, 0.5);
            color: black;
        }
    </style>
</head>
<body>
    <video autoplay muted loop>
        <source src="images/intro.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <h1>Department of Computer Applications</h1>

    <?php
    include "includes/connection.php";  
    
    $sql = "SELECT DISTINCT year FROM media ORDER BY year ASC";
    $result = $conn->query($sql);
    
    $years = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['year'] != 0) {
                $years[] = $row['year'];
            }
        }
    }
    $conn->close();
    
    foreach ($years as $index => $year): ?>
        <form action="media.php" method="GET">
            <button type="submit" name="year" value="<?= $year ?>" data-aos="fade-up" data-aos-delay="<?= $index * 200 ?>">
                <?= $year ?>
            </button>
        </form>
    <?php endforeach; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
