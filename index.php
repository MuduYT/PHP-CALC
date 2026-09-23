<?php include 'logic.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./media/calculator-icon.ico" type="image/x-icon">
    <title>Rechner</title>
    <link rel="stylesheet" href="style.css">
    <link rel="php" href="logic.php">
</head>
<body>
    <h1>CALC</h1>

    <div class="calculator">
        <form method="POST">
            <div class="display">
                <input type="text" name="display" placeholder="0" value="<?php echo htmlspecialchars($display); ?>" readonly>
            </div>
            <div class="buttons">
                <button type="submit" name="btn" value="C" class="function">C</button>
                <button type="submit" name="btn" value="±" class="function">±</button>
                <button type="submit" name="btn" value="%" class="function">%</button>
                <button type="submit" name="btn" value="÷" class="operator">÷</button>

                <button type="submit" name="btn" value="7">7</button>
                <button type="submit" name="btn" value="8">8</button>
                <button type="submit" name="btn" value="9">9</button>
                <button type="submit" name="btn" value="×" class="operator">×</button>

                <button type="submit" name="btn" value="4">4</button>
                <button type="submit" name="btn" value="5">5</button>
                <button type="submit" name="btn" value="6">6</button>
                <button type="submit" name="btn" value="−" class="operator">−</button>

                <button type="submit" name="btn" value="1">1</button>
                <button type="submit" name="btn" value="2">2</button>
                <button type="submit" name="btn" value="3">3</button>
                <button type="submit" name="btn" value="+" class="operator">+</button>

                <button type="submit" name="btn" value="0" class="zero">0</button>
                <button type="submit" name="btn" value=".">.</button>
                <button type="submit" name="btn" value="=" class="operator equals">=</button>
            </div>
        </form>
    </div>
</body>
</html>