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
            <th>Actions</th>
        </tr>
        <tbody>
            <?php if (count($records) > 0): ?>
                <?php foreach ($records as $rows): ?>
                    <tr>
                        <td><?= htmlspecialchars($rows['title']) ?></td>
                        <td><?= htmlspecialchars($rows['artist']) ?></td>
                        <td><?= number_format((float)$rows['price'], 2) ?></td>
                        <td><?= htmlspecialchars($rows['name']) ?></td>

                        <td>
                            <form method="post">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                <button>Edit<button>
                            </form>

                            <form method="post" style="display:inline" onsubmit="return confirm('Delete this book?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hiden" name="id" value="<?= (int)$r['id'] ?>">
                                <button>Delete<button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>