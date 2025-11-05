<?php
require_once __DIR__ . '/../data/functions.php';
$records = records_all();
?>

<div>
    <table>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Price</th>
            <th>Format</th>
        </tr>
        <tbody>
            <?php if (count($records) > 0): ?>
                <?php foreach ($records as $rows): ?>
                    <tr>
                        <td><?= htmlspecialchars($rows['title']) ?></td>
                        <td><?= htmlspecialchars($rows['artist']) ?></td>
                        <td><?= number_format((float)$rows['price'], 2) ?></td>
                        <td><?= htmlspecialchars($rows['name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>