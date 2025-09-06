<?php
$mom_name = "Mom";
$birth_date = "September 10, 1973";

// calculate age dynamically
$birthday = new DateTime('1973-09-05');
$today = new DateTime();
$age = $today->diff($birthday)->y;

$current_year = date('Y');
$last_updated = date('F Y');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Happy Birthday <?php echo $mom_name; ?></title>
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
        }

        h2 {
            font-size: 18px;
            margin-top: 25px;
            margin-bottom: 10px;
            border-bottom: 1px solid #cccccc;
            padding-bottom: 5px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000000;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .age {
            font-size: 36px;
            font-weight: bold;
            color: #0000ff;
        }

        .message {
            margin: 20px 0;
            text-align: justify;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-style: italic;
            border-top: 1px solid #cccccc;
            padding-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        td {
            border: 1px solid #000000;
            padding: 8px;
            vertical-align: top;
        }

        .center {
            text-align: center;
        }

        a {
            color: #0000ff;
            text-decoration: underline;
        }

        a:visited {
            color: #800080;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Happy Birthday <?php echo $mom_name; ?></h1>
        <div class="age"><?php echo $age; ?></div>
        <p><?php echo $birth_date; ?></p>
    </div>

    <h2>Birthday Message</h2>
    <div class="message">
        <p>Dearest <?php echo $mom_name; ?>,</p>

        <p>Today we celebrate you turning <?php echo $age; ?>! Another year older, another year wiser, and another year of being the most best mom anyone could ask for.</p>

        <p>Thank you for all the home-cooked meals, the late-night talks, the endless support, and for always believing in us. Your love has been the foundation of our family.</p>

        <p>We hope your special day is filled with all your favorite things.</p>
    </div>

    <h2>Birthday Statistics</h2>
    <table>
        <tr>
            <td><strong>Age:</strong></td>
            <td><?php echo $age; ?> years old</td>
        </tr>
        <tr>
            <td><strong>Years of being awesome:</strong></td>
            <td><?php echo $age; ?> and counting</td>
        </tr>
        <tr>
            <td><strong>Favorite things:</strong></td>
            <td>Spending time with family, cooking yummy treats, and spreading knowledge</td>
        </tr>
        <tr>
            <td><strong>Our wish for you:</strong></td>
            <td>Health, happiness, and more family time</td>
        </tr>
    </table>

    <h2>Quick Links</h2>
    <p>
        <a href="#memories">Favorite Memories</a> |
        <a href="photos.php">Photo Album</a>
    </p>

    <div class="footer">
        <p><strong>Happy Birthday Ma!</strong></p>
        <p>Created with love by Parth</p>
        <p><small>Last updated: <?php echo $last_updated; ?></small></p>
        <p><small>Page generated on <?php echo date('F j, Y \a\t g:i a'); ?></small></p>
    </div>
</body>

</html>