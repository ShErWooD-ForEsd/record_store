<?php

require_once __DIR__ . '/data/functions.php';

$formats = formats_all();
// $records = records_all();
// $insert = record_insert();

$view = filter_input(INPUT_GET, 'view') ?: 'list';
$action = filter_input(INPUT_POST, 'action');

switch($action) {

    case 'create':
    $title = trim((string)(filter_input(INPUT_POST, 'title') ?? ''));
    $artist = trim((string)(filter_input(INPUT_POST, 'artist') ?? ''));
    $price = (float)(filter_input(INPUT_POST, 'price') ?? 0);
    $format_id = (int)(filter_input(INPUT_POST, 'format_id') ?? 0);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Shop</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>
    <?php require __DIR__ . "/components/nav.php" ?>
    <div>
        <?php
        if ($view === 'list')           include __DIR__ . '/partials/records-list.php';
        elseif ($view == 'create')      include __DIR__ . '/partials/record-form.php';
        elseif ($view === 'created')    include __DIR__ . '/partials/record-created.php';
        else                            include __DIR__ . '/partials/records-list.php';
        ?>
    </div>

</body>

</html>