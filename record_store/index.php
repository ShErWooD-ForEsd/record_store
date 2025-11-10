<?php

require_once __DIR__ . '/data/functions.php';

$view = filter_input(INPUT_GET, 'view') ?: 'list';
$action = filter_input(INPUT_POST, 'action');
switch ($action) {

    case 'create':
        $title = trim((string)(filter_input(INPUT_POST, 'title') ?? ''));
        $artist = trim((string)(filter_input(INPUT_POST, 'artist') ?? ''));
        $price = (float)(filter_input(INPUT_POST, 'price') ?? 0);
        $name = (string)(filter_input(INPUT_POST, 'name') ?? 0);

        if ($title && $artist && $price && $format) {
            record_insert($title, $artist, $price, $format);
            $view = 'created';
        } else {
            $view = 'create';
        }
        // $view = "created";
        break;

    case 'delete':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $deleted = record_delete($id);
        }
        $view = 'deleted';
        break;

    case 'edit':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $record = record_get($id);
        }
        $view = 'create';
        break;
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
        elseif ($view === 'create')     include __DIR__ . '/partials/record-form.php';
        elseif ($view === 'created')    include __DIR__ . '/partials/record-created.php';
        elseif ($view == 'updated')     include __DIR__ . '/partials/records-updated.php';
        elseif ($view === 'deleted')    include __DIR__ . '/partials/record-deleted.php';
        else                            include __DIR__ . '/partials/records-list.php';
        ?>
    </div>

</body>

</html>