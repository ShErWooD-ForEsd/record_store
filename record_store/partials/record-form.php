<?php
require_once __DIR__ . '/../data/functions.php';
$formats = formats_all();
?>

<h2>Add Album</h2>

<div>
    <form method="post">
        <label>Title</label>
        <input name="title" required>
        </br> </br>
        <label>Artist</label>
        <input name="artist" required>
        </br> </br>
        <label>Price</label>
        <input name="title" required>
        </br> </br>
        <label>Format</label>

        <select name="name" required>
            <option value="">Select...</option>
            <?php foreach ($formats as $f): ?>
                <option><?= htmlspecialchars($f['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <input type="hidden" name="action" value="create">

        <button>Submit</button>

    </form>
</div>