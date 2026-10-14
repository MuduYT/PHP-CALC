<?php include 'logic.php'; ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./media/calculator-icon.ico" type="image/x-icon">
    <title>Rechner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>CALC</h1>

    <div class="calculator">
        <form method="POST">
            <!-- Dieses Feld merkt sich, ob die Anzeige schon ein Ergebnis ist. -->
            <input type="hidden" name="just_calculated" value="<?php echo $justCalculated ? '1' : '0'; ?>">

            <!-- Hier zeigt PHP die aktuelle Eingabe oder das Ergebnis an. -->
            <div class="display">
                <input type="text" name="display" placeholder="0" value="<?php echo htmlspecialchars($display, ENT_QUOTES, 'UTF-8'); ?>" readonly>
            </div>

            <!-- Jede Taste sendet ihren Wert zusammen mit der Anzeige an PHP. -->
            <div class="buttons">
                <button type="submit" name="btn" value="C" class="function">C</button>
                <button type="submit" name="btn" value="±" class="function">±</button>
                <button type="submit" name="btn" value="%" class="function">%</button>
                <button type="submit" name="btn" value="⌫" class="function">⌫</button>

                <button type="submit" name="btn" value="7">7</button>
                <button type="submit" name="btn" value="8">8</button>
                <button type="submit" name="btn" value="9">9</button>
                <button type="submit" name="btn" value="÷" class="operator">÷</button>

                <button type="submit" name="btn" value="4">4</button>
                <button type="submit" name="btn" value="5">5</button>
                <button type="submit" name="btn" value="6">6</button>
                <button type="submit" name="btn" value="×" class="operator">×</button>

                <button type="submit" name="btn" value="1">1</button>
                <button type="submit" name="btn" value="2">2</button>
                <button type="submit" name="btn" value="3">3</button>
                <button type="submit" name="btn" value="−" class="operator">−</button>

                <button type="submit" name="btn" value="0">0</button>
                <button type="submit" name="btn" value=".">.</button>
                <button type="submit" name="btn" value="=" class="equals">=</button>
                <button type="submit" name="btn" value="+" class="operator">+</button>
            </div>
        </form>
    </div>
</body>
</html>
