<?php
session_start();
$password = "PaKrRo";

// Check authentication - session or cookie
$authenticated = $_SESSION['authenticated'] ?? false;
if (!$authenticated && isset($_COOKIE['mom_site_auth'])) {
    if ($_COOKIE['mom_site_auth'] === hash('sha256', $password)) {
        $_SESSION['authenticated'] = true;
        $authenticated = true;
    }
}

// Redirect to main page if not authenticated
if (!$authenticated) {
    header('Location: index.php');
    exit;
}

$cdn_base = "https://d2wh0uzdov71sv.cloudfront.net/mom-memories/";
$total_photos = 51;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Photo Album</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: #ffffff;
            color: #000000;
            margin: 40px;
            line-height: 1.4;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #000000;
            padding-bottom: 15px;
        }

        .back-link {
            margin-bottom: 20px;
        }

        a {
            color: #0000ff;
            text-decoration: underline;
        }

        a:visited {
            color: #800080;
        }

        .photo-grid {
            display: table;
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px;
        }

        .photo-row {
            display: table-row;
        }

        .photo-cell {
            display: table-cell;
            width: 20%;
            text-align: center;
            vertical-align: top;
            border: 1px solid #cccccc;
            padding: 10px;
        }

        .photo-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            cursor: pointer;
        }

        .photo-thumbnail:hover {
            opacity: 0.8;
        }

        .photo-number {
            font-size: 12px;
            margin-top: 5px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 90vw;
            max-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-image {
            max-width: 100%;
            max-height: 90vh;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 25px;
            color: #ffffff;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
        }

        .close-btn:hover {
            color: #cccccc;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-style: italic;
            border-top: 1px solid #cccccc;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <h1>Photo Album</h1>

    <div class="back-link">
        <a href="index.php">&lt; Back to Birthday Page</a>
    </div>

    <div class="photo-grid">
        <?php
        for ($i = 1; $i <= $total_photos; $i += 5) {
            echo '<div class="photo-row">';

            for ($j = 0; $j < 5 && ($i + $j) <= $total_photos; $j++) {
                $photo_num = $i + $j;
                $photo_url = $cdn_base . $photo_num . ".jpg";

                echo '<div class="photo-cell">';
                echo '<img src="' . $photo_url . '" alt="Memory ' . $photo_num . '" class="photo-thumbnail" onclick="openModal(\'' . $photo_url . '\', ' . $photo_num . ')">';
                echo '<div class="photo-number">Photo ' . $photo_num . '</div>';
                echo '</div>';
            }

            echo '</div>';
        }
        ?>
    </div>

    <!-- Modal -->
    <div id="photoModal" class="modal" onclick="closeModal()">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <img id="modalImage" class="modal-image" src="" alt="">
        </div>
    </div>

    <div class="footer">
        <p><strong>50 Beautiful Memories</strong></p>
        <p><small>Click any photo to view larger</small></p>
        <p><small>Desktop: Use arrow keys ← → to navigate, ESC to close</small></p>
        <p><small>Mobile: Swipe left/right to navigate, tap X to close</small></p>
    </div>

    <script>
        var currentPhotoNum = 1;
        var totalPhotos = <?php echo $total_photos; ?>;
        var cdnBase = '<?php echo $cdn_base; ?>';

        // Touch/swipe variables
        var touchStartX = 0;
        var touchEndX = 0;
        var minSwipeDistance = 50;

        function openModal(imageUrl, photoNum) {
            var modal = document.getElementById('photoModal');
            var modalImg = document.getElementById('modalImage');

            currentPhotoNum = photoNum;
            modal.style.display = 'block';
            modalImg.src = imageUrl;
            modalImg.alt = 'Memory ' + photoNum;
        }

        function closeModal() {
            var modal = document.getElementById('photoModal');
            modal.style.display = 'none';
        }

        function showNextPhoto() {
            if (currentPhotoNum < totalPhotos) {
                currentPhotoNum++;
                var modalImg = document.getElementById('modalImage');
                modalImg.src = cdnBase + currentPhotoNum + '.jpg';
                modalImg.alt = 'Memory ' + currentPhotoNum;
            }
        }

        function showPrevPhoto() {
            if (currentPhotoNum > 1) {
                currentPhotoNum--;
                var modalImg = document.getElementById('modalImage');
                modalImg.src = cdnBase + currentPhotoNum + '.jpg';
                modalImg.alt = 'Memory ' + currentPhotoNum;
            }
        }

        function handleSwipe() {
            var swipeDistance = touchEndX - touchStartX;

            if (Math.abs(swipeDistance) > minSwipeDistance) {
                if (swipeDistance > 0) {
                    showPrevPhoto();
                } else {
                    showNextPhoto();
                }
            }
        }

        document.addEventListener('keydown', function(event) {
            var modal = document.getElementById('photoModal');
            if (modal.style.display === 'block') {
                switch (event.key) {
                    case 'Escape':
                        closeModal();
                        break;
                    case 'ArrowRight':
                        showNextPhoto();
                        event.preventDefault();
                        break;
                    case 'ArrowLeft':
                        showPrevPhoto();
                        event.preventDefault();
                        break;
                }
            }
        });

        document.addEventListener('touchstart', function(event) {
            var modal = document.getElementById('photoModal');
            if (modal.style.display === 'block') {
                touchStartX = event.changedTouches[0].screenX;
            }
        });

        document.addEventListener('touchend', function(event) {
            var modal = document.getElementById('photoModal');
            if (modal.style.display === 'block') {
                touchEndX = event.changedTouches[0].screenX;
                handleSwipe();
            }
        });
    </script>
</body>

</html>