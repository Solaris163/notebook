<?php if ($is_admin): //проверка, является ли пользователь администратором ?>

<!-- <h1>Страница сообщений</h1> -->

<div class="flex secondMenu">
    <a href="/"><div class="link">Все</div></a>&nbsp
    <?php foreach ($categoryes as $category): ?>
    
    <a href="/show/index/?category_id=<?=$category['id']?>"><div class="link"><?=$category['name']?></div></a>&nbsp

    <?php endforeach; ?>
</div>

<form action="/message/index/">
    <button>Добавить запись</button>
</form>
<br>
<form action="/category/index/">
    <button>Добавить новую категорию</button>
</form>
<br>

<?php foreach ($content as $message): ?>

<div>
    <?php $date = date("d-m-Y", strtotime($message['date'])); ?>
    <span style="color: #822;"> <?=$date;?> </span> 
    <!-- <?=$message['category'];?><br> -->
    <?=$message['content'];?><br><br>
</div>

<?php endforeach; ?>

<?php else: ?>

<h3>Пожалуйста войдите на сайт</h3>

<?php endif; ?>