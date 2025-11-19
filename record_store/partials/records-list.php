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
                            <form method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="action" value="add_to_cart">
                                <button class="btn btn-sm btn-outline-success">Add to Cart</button>
                            </form>

                            <form method="post" class="d-inline" onsubmit="return confirm('Delete this record?');">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>