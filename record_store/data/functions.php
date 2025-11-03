<?php

require_once __DIR__ . "/db.php";

function formats_all(): array
{
    $pdo = get_pdo();
    return $pdo->query("SELECT id, name FROM formats")->fetchAll();
}

function records_all(): array
{
    $pdo = get_pdo();

    $stmt = $pdo->prepare("
        SELECT records.title, formats.name, records.price
        FROM records
        JOIN formats ON formats.id = records.format_id;
    ");

    $stmt->execute();
    return $stmt->fetchAll();
}

function record_insert($title = "AC/DC", $artist = "AC/DC", $price = "19.99", $format_id = 1): void
{
    $pdo = get_pdo();

    $stmt = $pdo->prepare("
        INSERT INTO records (title, artist, price, format_id)
        VALUES (:title, :artist, :price, :format_id);
    ");

    $stmt->execute([
        ':title' => $title,
        ':artist' =>  $artist,
        ':price' => $price,
        ':format_id' => $format_id
    ]);

    // $title = "Back in Black";
    // $artist = "AC/DC";
    // $price = "19.99";
    // $format_id = 1;

}
