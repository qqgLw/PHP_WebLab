<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title><?=$title?></title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <div class="centered">Администратор</div>
                <li
                        class="menu-tag" name="Главная страница"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/admin/home/index">Главная</a>
                    </li>
                </li>
                <li
                        class="menu-tag" name="Гостевая книга"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/admin/guestbook/index">Гостевая книга</a>
                    </li>
                </li>
                <li
                        class="menu-tag" name="Мой блог"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/admin/blog/index">Мой Блог</a>
                    </li>
                    <li
                        class="menu-tag" name="Статистика посещений"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/admin/stats/index">Статистика посещений</a>
                    </li>
                <div class="centered" id="clockText"></div>
            </ul>
        </nav>
        <div id="time" style="color: white; text-align: center;"></div>
    </header>
    <main>
    <article>
      <?include 'app/admin/views/'.$content_view;?>
    </article>
    </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?if($title==='Альбом')
    {
        echo '<script src="../../public/assets/js/album-script.js" defer>'; 
    }?>
    <script src="../../public/assets/js/script.js"></script>
</body>
</html>