<form class='user-form' action="/message/addMessage/" method="post">
    <input class="text" type="hidden" name='id' value="<?=$message['id'];?>">
    Введите дату
    <input class="text" type="date" name='date' value="<?=$message['date'];?>"><br>
    Выберите категорию
    <select class="text" name="category_id" style="height: 30px; width: 505px">
        <!--Выведем список возможных категорий, полученных из базы данных-->
        <?php foreach ($categoryes as $category): ?>
            <!--Присвоим атрибут selected нужной категории, если категория известна-->
            <? if ($category['id'] == $message['category_id']): ?>
                <option value="<?=$category['id']?>" selected="selected"><?=$category['name']?></option>
            <? else: ?>
                <option value="<?=$category['id']?>"><?=$category['name']?></option>
            <? endif; ?>
        <? endforeach; ?>
    </select>
    Введите текст записи
    <textarea class="text" type="text" name='content' placeholder="Текст" style="height: 150px;"><?=$message['content'];?></textarea>
    
    <? if (isset($message['id'])): ?>
        <input class="text link" type="submit" name="send" value="Изменить">
    <? else: ?>
        <input class="text link" type="submit" name="send" value="Добавить">
    <? endif; ?>
    
</form>
