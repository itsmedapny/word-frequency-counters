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
        <h1>Word Frequency Analyzer Program</h1>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $text = isset($_POST["text"]) ? $_POST["text"] : "";
        $sort = isset($_POST["sort"]) ? $_POST["sort"] : "";
        $limit = isset($_POST["limit"]) ? (int)$_POST["limit"] : 0;

        //check if the input text is empty
        if (empty($text)) {
            echo "<p class='error'>Please enter text.</p>";
        } else {
            //check if the input limit is valid
            if ($limit < 1) {
                echo "<p class='error'>The limit must be at least 1.</p>";
            } else {
                //sanitize and validate the input text
                $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);
                
                //use a regular expression to allow only letters, numbers, and common punctuation
                if (!preg_match('/^[a-zA-Z0-9\s.,:;!?]+$/', $text)) {
                    echo "<p class='error'>Invalid characters in the input. Please use only letters, numbers, and common punctuation.</p>";
                } else {
                    //process the input text
                    $wordCounts = calculateWordFrequencies($text, $sort, $limit);

                    //display the results
                    if (!empty($wordCounts)) {
                        echo "<h2>Word Frequencies</h2>";
                        echo "<ul>";
                        foreach ($wordCounts as $word => $frequency) {
                            echo "<li>$word: $frequency</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No words found after processing.</p>";
                    }
                }
            }
        }

         //display a back button to easy to go back in index
         echo "<a href='index.php' class='back-button'>Back to Home</a>";
    }

    //function to calculate word frequencies
    function calculateWordFrequencies($text, $sort, $limit) {

        //define common stop words to filter out
        $stopWords = ["the", "and", "in", "of", "to", "with", "their", "but", "a", "an", "are", "as", "at", "be", "but", "by", "for", "if", 
        "into", "is", "it", "no", "not", "on", "or", "such", "that", "then", "there", "these", "they", "this", "to", "was", "will", "with"];

        //tokenize the input text into words
        $words = preg_split('/[\s.,:;]+/', strtolower($text));

        //count word frequencies and filter out stop words
        $wordCounts = array_diff_assoc(array_count_values($words), array_flip($stopWords));

        //sort based on the user's choice (ascending or descending order)
        if ($sort == "asc") {
            asort($wordCounts);
        } else {
            arsort($wordCounts);
        }

        //limit the number of displayed words
        if ($limit > 0) {
            $wordCounts = array_slice($wordCounts, 0, $limit);
        }

        return $wordCounts;

    }
    
    ?>

    </div>
</body>
</html>
