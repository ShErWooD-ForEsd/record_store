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
        SELECT records.title, records.artist, formats.name, records.price
        FROM records
        JOIN formats ON formats.id = records.format_id;
    ");

    $stmt->execute();
    return $stmt->fetchAll();
}

function record_insert(string $title, string $artist, float $price, int $format_id): void
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
}

function esc_html(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function record_delete(int $id): int {
    $pdo = get_pdo();
    $stmt = $pdo->prepare("DELETE FROM records WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}

function record_get(int $id): ?array {
    $pdo = get_pdo();

}
