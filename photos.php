<?php
$cdn_base = "https://d2wh0uzdov71sv.cloudfront.net/mom-memories/";
$total_photos = 50;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mom's Photo Album</title>
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
            border: 1px solid #000000;
            cursor: pointer;
        }
        
        .photo-thumbnail:hover {
            border: 2px solid #0000ff;
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
            background-color: rgba(0,0,0,0.8);
        }
        
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 90%;
            max-height: 90%;
        }
        
        .modal-image {
            width: 100%;
            height: auto;
            border: 2px solid #ffffff;
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
    <h1>Mom's Photo Album</h1>
    
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
    </div>
    
    <script>
        function openModal(imageUrl, photoNum) {
            var modal = document.getElementById('photoModal');
            var modalImg = document.getElementById('modalImage');
            
            modal.style.display = 'block';
            modalImg.src = imageUrl;
            modalImg.alt = 'Memory ' + photoNum;
        }
        
        function closeModal() {
            var modal = document.getElementById('photoModal');
            modal.style.display = 'none';
        }
        
        // Close modal when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>