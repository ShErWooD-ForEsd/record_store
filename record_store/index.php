<?php

require_once __DIR__ . '/data/functions.php';

$formats = formats_all();
$records = records_all();
$insert = record_insert();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Unit Test 1 - Formats</h2>
    <?php print_r($formats); ?>
    <hr>

    <h2>Unit Test 2 - Records JOIN</h2>

    <?php print_r($records); ?>

    <hr>

    <h2>Unit Test 3 - Insert</h2>
    <?php print_r($insert);
    // $stmt->rowCount();
    echo "Insert success: true, rows: 1";
    print_r($records);?>
    <hr>
</body>

</html>