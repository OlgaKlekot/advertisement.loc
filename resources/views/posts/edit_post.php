<div class="addPage">
    <form action="<?= \app\core\createUrl('save_edit', ['edit_id' => $edit_post['id']]) ?>" id="artToAdd" method="post" class="addForm">
        <input class="field" placeholder="title" name="title" required value="<?= $edit_post['title'] ?>">
        <select name="category" id="cat" class="field">
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
            <?php endforeach; ?>
        </select>
        <input class="field" placeholder="price" name="price" value="<?= sprintf ("%01.2f", $edit_post['price']) ?>">
        <textarea class="field" name="text" id="" cols="70" rows="10" required><?= $edit_post['main'] ?></textarea>
        <input type="submit" name="save" class="button" value="Save" form="artToAdd">
</form>
</div>