<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/style/main.css">
    <title>Блокнот</title>
</head>
<body>
<div class="main-container">
    <header>
        <h1 class="header_h1">Блокнот</h1>
        <div class="header_menu">
            <div class="header_left">
                <a href="/">Главная</a>
            </div>
            <div class="header_right">
                <?php if ($auth): //проверка аутентификации пользователя ?>
                    <form action="/user/logout/">
                        Добро пожаловать <?=$login?>&nbsp &nbsp
                        <?php if ($is_admin):?>
                            <!-- <a href="/adminPanel">Панель администратора</a>&nbsp &nbsp -->
                        <?php endif; ?>
                        <input type="submit" name="send" value="Выйти">
                    </form>
                <?php else: ?>
                    <a href="/user/loginForm">Вход</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <?=$content?>
</div>

</body>
</html>
