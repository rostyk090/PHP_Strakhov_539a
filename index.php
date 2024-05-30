<?php
if(isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);  // Захист від XSS-атак

    $apiKey = 'AIzaSyBEqA3HlyGpbeqdzrfoTHtC6yZZkUt7E';
    $cx = 'b306b8059bdb3420b';

    $url = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$cx}&q={$search}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);  // Встановити тайм-аут
    curl_setopt($ch, CURLOPT_FAILONERROR, true);  // Повернення false при помилці HTTP

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
    }

    curl_close($ch);

    if (isset($error_msg)) {
        // Обробка помилки
        echo "Error: " . $error_msg;
    } else {
        $data = json_decode($response, true);

        if (isset($data['items'])) {
            $items = $data['items'];
        } else {
            echo "No results found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h3 {
            margin-top: 20px;
            text-align: center;
        }

        .results {
            margin-left: 20px;
            margin-right: 20px;
        }

        .result-item {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 10px;
        }

        .result-item a {
            color: #1a0dab;
            text-decoration: none;
        }

        .result-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h2>My Browser</h2>

<form method="GET" action="">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value=""><br><br>
    <input type="submit" value="Submit">
</form>

<?php
if(isset($items)) {
    echo "<h3>Search result: " . htmlspecialchars($search) . "</h3>";
    echo "<div class='results'>";
    foreach($items as $item) {
        echo "<div class='result-item'><a href='" . htmlspecialchars($item['link']) . "'>" . htmlspecialchars($item['title']) . "</a><br>" . htmlspecialchars($item['snippet']) . "</div>";
    }
    echo "</div>";
}
?>
</body>
</html>
