<?php
$mom_name = "Mom";
$birth_date = date('F j, Y', strtotime('2025-09-05'));

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

    <h2>Our Letter to You</h2>
    <div class="message">
        <p>Dearest Ma,</p>

        <p>Today we celebrate you turning <?php echo $age; ?>, and we can't help but think about all the ways you've shaped us into who we are. You've never just been our mom - you've been our biggest supporter, our toughest coach, and somehow always our softest place to land.</p>

        <p>We think about how you used to sneak back stacks of math contest papers for Parth, watching his eyes light up as he dove into them immediately. Or how you'd drop everything to drive him to competitions you'd never even heard of, simply because you believed in his dreams. That's who you are. You fuel our passions even when you don't fully understand them.</p>

        <p>We remember the late nights when you couldn't sleep until you heard the door close, knowing we were home safe. "SHAPATH?" you'd ask us through skeptical eyes, making sure we'd kept our promises. You've always cared more about our well-being than your own rest.</p>

        <p>You call us out when we're glued to our phones instead of being present with family, reminding us that real life happens away from screens. You bring us chai and fresh fruit even after we say no, because you know what we need better than we do. You turn every daal-ki-roti into a masterpiece, and somehow each one really is better than the last.</p>

        <p>You push us to be great - encouraging Ronnie to seek passions like cooking, sending Parth & Krish health videos you know we'll only half-watch, and always challenging us to achieve greater heights. But you also know when to let us spread our wings, even when it means we're further from your nest than you'd like. We promise we'll visit more often.</p>

        <p>You've taught us that love isn't always gentle. Sometimes it's staying awake until 1:30 AM so you can hear us come home, sometimes it's saying "no SAD," and sometimes it's asking the hard questions we don't want to hear. But it's always, always putting us first.</p>

        <p>Thank you for being the kind of mother who shows up, who remembers, who cares enough to call us out and love us anyway. Thank you for every sacrifice, every lecture, every daal-roti-kabob wrap, every "chaanta", and every "SHAPATH." You've kept us humble and grounded.</p>

        <p>Today and every day, we're grateful to be your sons.</p>

        <p>With all our love,<br>Parth, Krish, and Ronny</p>
    </div>

    <h2>Birthday Statistics</h2>
    <table>
        <tr>
            <td><strong>Age:</strong></td>
            <td><?php echo $age; ?> years old (perfect square age coming at 64!)</td>
        </tr>
        <tr>
            <td><strong>Days on Earth:</strong></td>
            <td><?php echo number_format($age * 365.25); ?> days of spreading joy</td>
        </tr>
        <tr>
            <td><strong>Fibonacci Fun:</strong></td>
            <td>You've lived through <?php echo floor($age / 8); ?> Fibonacci decades (8, 13, 21, 34, 55...)</td>
        </tr>
        <tr>
            <td><strong>Prime Status:</strong></td>
            <td><?php echo $age; ?> is <?php
                                        $is_prime = true;
                                        if ($age < 2) $is_prime = false;
                                        for ($i = 2; $i <= sqrt($age); $i++) {
                                            if ($age % $i == 0) {
                                                $is_prime = false;
                                                break;
                                            }
                                        }
                                        echo $is_prime ? "prime" : "composite";
                                        ?> - just like your one-of-a-kind awesomeness!</td>
        </tr>
        <tr>
            <td><strong>Years of being our superhero:</strong></td>
            <td><?php echo $age; ?> and counting (infinity more to go!)</td>
        </tr>
        <tr>
            <td><strong>Favorite things:</strong></td>
            <td>Quality time with family, making perfect bhindi and saag, and making sure we're not doing "SAD"...</td>
        </tr>
    </table>

    <h2>Quick Links</h2>
    <p>
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