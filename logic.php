<?php
$display = "";


if (isset($_POST["display"])) {

    $display = $_POST["display"];

    $btn = $_POST["btn"] ?? "";

    if ($btn === "C") {
        $display = "";

    } elseif (in_array($btn, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'])) {
        $display .= $btn;

    } elseif (in_array($btn, ['+', '−', '×', '÷'])) {

        $display .= $btn;
    } elseif ($btn === "=") {


        if (strpos($display, "+") !== false) {
            $teile = explode("+", $display);
            if (count($teile) === 2 && is_numeric($teile[0]) && is_numeric($teile[1])) {
                $display = $teile[0] + $teile[1];
            }
        } elseif (strpos($display, "×") !== false) {
            $teile = explode("×", $display);
            if (count($teile) === 2 && is_numeric($teile[0]) && is_numeric($teile[1])) {
                $display = $teile[0] * $teile[1];
            }
        }
        // − (subtrahieren) und ÷ (dividieren)  


    }
}

?>