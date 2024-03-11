<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Frequency Analyzer</title>
    <link rel="stylesheet" href="styles2.css">
</head>

<body>
    <div class="container">
        <h1>Word Frequency Analyzer</h1>
 

     <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        pForm();
    }

    function pForm() {
        $text = isset($_POST["text"]) ? $_POST["text"] : "";
        $sort = isset($_POST["sort"]) ? $_POST["sort"] : "";
        $limit = isset($_POST["limit"]) ? (int)$_POST["limit"] : 0;

        //check if input text is empty
        if (empty($text)) {
            displayError("Please enter text. Please try again!");
            return;
        }

        //check if input limit is valid
        if ($limit < 1) {
            displayError("The limit must be at least 1.");
            return;
        }

        //sanitize and validate text
        $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);

        //use a regular expression to allow only letters, numbers, and common punctuation
        if (!preg_match('/^[a-zA-Z0-9\s.,:;!?]+$/', $text)) {
            displayError("Invalid characters in the input. Please use only letters, numbers, and common punctuation.");
            return;
        }

        //process input text
        $stopWords = getStopWords();
        $wordCounts = calculateWordFrequencies($text, $sort, $limit, $stopWords);

        //display results
        displayResults($wordCounts);
    }

    //function error handling
    function displayError($message) {
        echo "<p class='error'>$message</p>";

        //display back button
        echo "<a href='index.php' class='back-button'>Back to Home</a>";
    }

    //function display results
    function displayResults($wordCounts) {
    if (!empty($wordCounts)) {
        echo "<table>";
        echo "<tr><th>Word</th><th>Number of Frequency</th></tr>";
        foreach ($wordCounts as $word => $frequency) {
            echo "<tr><td>$word</td><td>$frequency</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No words found after processing.</p>";
    }

    //display back button
    echo "<a href='index.php' class='back-button'>Back to Home</a>";

    }

     
     //function calculate word frequencies
    function calculateWordFrequencies($text, $sort, $limit, $stopWords) {
        $words = tokenizeText($text);
        $wordCounts = countAndFilterWords($words, $stopWords);
        $sWordCounts = sWordCounts($wordCounts, $sort);
        $lWordCounts = lWordCounts($sWordCounts, $limit);
    
        return $lWordCounts;
    }
    
    //function tokenize the input text into words
    function tokenizeText($text) {
        return preg_split('/[\s.,:;]+/', strtolower($text));
    }
    
    //function sorted counts
    function sWordCounts($wordCounts, $sort) {
        if ($sort == "asc") {
            asort($wordCounts);
        } else {
            arsort($wordCounts);
        }
    
        return $wordCounts;
    }
    
    //function limit the number of displayed words
    function lWordCounts($wordCounts, $limit) {
        if ($limit > 0) {
            return array_slice($wordCounts, 0, $limit);
        }
    
        return $wordCounts;
    }
    
    //function stop words
    function getStopWords() {
        return ["the", "and", "in", "of", "to", "with", "their", "but", "a", "an", "are", "as", "at", "be", "but", "by", "for", "if", 
            "into", "is", "it", "no", "not", "on", "or", "such", "that", "then", "there", "these", "they", "this", "to", "was", "will", "with"]; //common stop words
    }
    
    function countAndFilterWords($words, $stopWords) {
        $wordCounts = array_diff_assoc(array_count_values($words), array_flip($stopWords));
        return $wordCounts;
    }

    ?>
    
   </div>

</body>
</html>