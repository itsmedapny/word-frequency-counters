<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Word Frequency Counter</h1>
    
    <form action="process.php" method="post">
        <label for="text">Paste your text here</label><br>
        <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>
        
        <label for="sort">Sort by frequency</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending Order</option>
            <option value="desc">Descending Order</option>
        </select><br><br>
        
        <label for="limit">Numbers of words to display</label>
        <input type="number" id="limit" name="limit" value="10" min="1"><br><br>
        
        <input type="submit" value="Calculate Word Frequency">
        
    </form>
</body>
</html>