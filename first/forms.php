<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title>
</head>
<body>
    <h1>Forms</h1>
    <p>Guesing game...</p>

    <?php
    $oldguess = isset($_POST['guess']) ? $_POST['guess'] : '';
    ?>
    <form method="post">
        <p>
            <label for="guess">Input Guess</label>
            <input type="text" name="guess" id="guess"
            size="40" value="<?= htmlentities($oldguess)?>" /> 
        </p>
        <input type="submit" />
    </form>

    <?= $oldguess ?>
    <?php echo($oldguess)?>
   
    
</body>
</html>