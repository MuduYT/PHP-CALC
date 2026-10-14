<?php

// -------------------- Startwerte --------------------
$display = '';
$justCalculated = false;
$operators = ['+', '−', '×', '÷'];


// -------------------- Kleine Hilfsfunktionen --------------------

// Prüft, ob die Anzeige mit einem Rechenzeichen endet.
function endsWithOperator(string $text, array $operators): bool
{
    foreach ($operators as $operator) {
        if (substr($text, -strlen($operator)) === $operator) {
            return true;
        }
    }

    return false;
}

// Prüft, ob schon ein Rechenzeichen in der Anzeige steht.
function hasOperator(string $text, array $operators): bool
{
    foreach ($operators as $operator) {
        if (strpos($text, $operator) !== false) {
            return true;
        }
    }

    return false;
}

// Zeigt Zahlen ordentlich an und verhindert sehr lange oder unendliche Ergebnisse.
function formatNumber(float $number): string
{
    if (!is_finite($number)) {
        return 'Err';
    }

    // Auf 12 Nachkommastellen runden und überflüssige Nullen abschneiden.
    $text = rtrim(rtrim(number_format($number, 12, '.', ''), '0'), '.');

    if ($text === '' || $text === '-0') {
        $text = '0';
    }

    return strlen($text) <= 100 ? $text : 'Err';
}

// Rechnet eine Operation aus, zum Beispiel 1+6.
function calculateOneOperation(string $text): ?float
{
    if (is_numeric($text)) {
        return (float) $text;
    }

    if (strpos($text, '+') !== false) {
        $numbers = explode('+', $text);
        if (count($numbers) === 2 && is_numeric($numbers[0]) && is_numeric($numbers[1])) {
            return (float) $numbers[0] + (float) $numbers[1];
        }


    } elseif (strpos($text, '−') !== false) {
        $numbers = explode('−', $text);
        if (count($numbers) === 2 && is_numeric($numbers[0]) && is_numeric($numbers[1])) {
            return (float) $numbers[0] - (float) $numbers[1];
        }


    } elseif (strpos($text, '×') !== false) {
        $numbers = explode('×', $text);
        if (count($numbers) === 2 && is_numeric($numbers[0]) && is_numeric($numbers[1])) {
            return (float) $numbers[0] * (float) $numbers[1];
        }


    } elseif (strpos($text, '÷') !== false) {
        $numbers = explode('÷', $text);
        if (count($numbers) === 2 && is_numeric($numbers[0]) && is_numeric($numbers[1])) {


            if ((float) $numbers[1] === 0.0) {
                return INF;
            }

            return (float) $numbers[0] / (float) $numbers[1];
        }
    }

    // Zum Beispiel bei einer unvollständigen Eingabe wie 1+.
    return null;
}


// -------------------- Formular und Eingabe prüfen --------------------
if (isset($_POST['display'])) {
    $display = (string) $_POST['display'];

    // Nach einem Ergebnis soll die nächste Ziffer eine neue Zahl beginnen.
    $justCalculated = (($_POST['just_calculated'] ?? '') === '1') && is_numeric($display);

    // Erlaubt eine Zahl oder eine Rechnung mit genau einem Rechenzeichen.
    // Ein noch fehlender zweiter Wert ist erlaubt, solange man weiter eintippt.
    $validDisplay = preg_match('/^-?\d+(?:\.\d*)?(?:[+−×÷](?:\d+(?:\.\d*)?)?)?$/u', $display);

    if (strlen($display) > 100 || !$validDisplay) {
        $display = '';
        $justCalculated = false;
    }

    $button = (string) ($_POST['btn'] ?? '');


    // -------------------- Taste verarbeiten --------------------
    if ($button === 'C') {
        $display = '';
        $justCalculated = false;


    } elseif (in_array($button, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], true)) {
        $display = $justCalculated ? $button : $display . $button;
        $justCalculated = false;


    } elseif ($button === '.') {
        if ($justCalculated) {
            $display = '0.';
            $justCalculated = false;


        } else {
            // Nur der Teil nach dem Rechenzeichen ist gerade die aktuelle Zahl.
            $parts = preg_split('/[+−×÷]/u', $display);
            $lastNumber = end($parts);

            if (strpos($lastNumber, '.') === false) {
                $display .= ($lastNumber === '') ? '0.' : '.';
            }
        }


    } elseif (in_array($button, $operators, true)) {
        // Erlaube nur ein Rechenzeichen und setze es nur hinter eine fertige Zahl.
        if (
            $display !== '' &&
            !hasOperator($display, $operators) &&
            !endsWithOperator($display, $operators) &&
            substr($display, -1) !== '.'
        ) {
            $display .= $button;
            $justCalculated = false;
        }


    } elseif ($button === '±') {
        // Das Vorzeichen kann bei einer einzelnen Zahl umgedreht werden.
        if (is_numeric($display)) {
            $display = formatNumber((float) $display * -1);
            $justCalculated = true;
        }


    } elseif ($button === '%') {
        // Prozent bedeutet hier: Zahl durch 100 teilen.
        if (is_numeric($display)) {
            $display = formatNumber((float) $display / 100);
            $justCalculated = true;
        }


    } elseif ($button === '⌫') {
        // Rechenzeichen wie × bestehen aus mehreren Bytes und werden ganz gelöscht.
        if (endsWithOperator($display, $operators)) {
            foreach ($operators as $operator) {
                if (substr($display, -strlen($operator)) === $operator) {
                    $display = substr($display, 0, -strlen($operator));
                    break;
                }
            }


        } else {
            $display = substr($display, 0, -1);
        }

        $justCalculated = false;


    } elseif ($button === '=') {
        $result = calculateOneOperation($display);

        if ($result === null) {
            $display = 'Err';
            $justCalculated = false;

            
        } else {
            $display = formatNumber($result);
            $justCalculated = is_numeric($display);
        }
    }
}

?>
