<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <title><?=$title?></title>
</head>
<body>
    <header>
          <nav>
              <ul>
                    <li
                        class="menu-tag" name="Главная страница"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/home">Главная</a>
                    </li>
                    <li
                        class="menu-tag" name="Обо мне"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/about">Обо мне</a>
                    </li>
                    <li
                        class="menu-tag" name="Мои интересы"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a>Мои интересы</a>
                        <ul class="interests-dropdown">
                              <li><a class="alt-href" href="/interests#hobbies">Мои хобби</a></li>
                              <li><a class="alt-href" href="/interests#books">Мои любимые книги</a></li>
                              <li><a class="alt-href" href="/interests#music">Моя любимая музыка</a></li>
                              <li><a class="alt-href" href="/interests#movies">Мои любимые фильмы</a></li>
                        </ul>
                    </li>
                    <li
                        class="menu-tag" name="Учеба"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/study">Учеба</a>
                    </li>
                    <li
                        class="menu-tag" name="Альбом"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/album">Фотоальбом</a>
                    </li>
                    <li
                        class="menu-tag" name="Контакт-форма"   
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/contact">Контакт</a>
                    </li>
                    <li
                        class="menu-tag" name="Тест по МИО"
                        onmouseover="onMouseOverImage(this)"
                        onmouseout="onMouseOutImage(this)"
                    >
                        <div class="menu__image-wrapper">
                              <img src="../../public/assets/img/1.jpg" alt="" class="menu__image" />
                        </div>
                        <a href="/test">Тест</a>
                    </li>
              </ul>
          </nav>
          <div id="time" style="color: white; text-align: center;"></div>
    </header>
    <main>
    <article>
      <?include 'app/views/'.$content_view;?>
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