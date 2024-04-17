<?php

declare(strict_types=1);

$num01 = $num02 = $ops = $num01Err = $num02Err = $result = "";

$messages = [
    "error" => [
        "Something is wrong",
        "Input a digit",
        "Invalid. Please input a digit, and 2 decimals max",
        "Math isn't Mathing"
    ],
    "success" => [
        "Your result is ",
    ]
];

// FUNCTIONS
// function ring(float $data, string $data2, string $data3)
// {
//     $data = htmlspecialchars($_POST[$data3]);
//     if (empty($data)) {
//         $data = 0;
//     } elseif (!preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $data)) {
//         $data2 = "error shows";
//     }
// }ring($num01, $num01Err, "num01");



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ERROR HANDLING

    $num01 = htmlspecialchars($_POST["num01"]);
    if (empty($num01)) {
        $num01 = 0;
    } elseif (!preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $num01)) {
        $num01Err = $messages["error"][2];
    }



    $ops = htmlspecialchars($_POST["ops"]);

    $num02 = htmlspecialchars($_POST["num02"]);
    if (empty($num01)) {
        $num02 = 0;
    } elseif (!preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $num02)) {
        $num02Err = $messages["error"][2];
    }

    // CALCULATION
    if (empty($num01Err || $num02Err)) {
        switch ($ops) {
            case '+':
                $result = $num01 + $num02;
                break;
            case '-':
                $result = $num01 - $num02;
                break;
            case '*':
                $result = $num01 * $num02;
                break;
            case '/':
                $result = $num01 / $num02;
                break;
            default:
                $messages["error"][3];
        }
    }
} else {
    echo $messages["error"][0];
}

?>

<html>

<head>
    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <h3>Simple Calc</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="num01">Number 1</label>
        <input type="float" name="num01" placeholder="input first digit">
        <span class="error"><?php echo $num01Err; ?></span>

        <br><br>
        <select name="ops">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <br><br>
        <label for="num02">Number 2</label>
        <input type="float" name="num02" placeholder="input second digit">
        <span class="error"><?php echo $num02Err; ?></span>

        <br><br>
        <button type="submit">Calculate</button>
    </form>


    <span class='success'>
        <?php
        echo $messages["success"][0] . $num01 . " " . $ops . " " . $num02 . " = " . $result;
        ?>
    </span>

</body>

</html>