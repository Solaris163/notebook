<form class='user-form' action="/message/addMessage/" method="post">
    Введите дату
    <input class="text" type="date" name='date'><br>
    Выберите категорию
    <select class="text" name="category_id" style="height: 30px; width: 505px">
        <!--Выведем список возможных категорий-->
        <?php foreach ($categoryes as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <? endforeach; ?>
    </select>
    Введите текст записи
    <textarea class="text" type="text" name='content' placeholder="Текст" style="height: 150px;"></textarea>
    <input class="text link" type="submit" name="send" value="Добавить">
    
</form>
