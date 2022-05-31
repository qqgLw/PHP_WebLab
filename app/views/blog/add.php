<section class="container" style="max-width: 70%;">
    <h1 class="centered">
        Редактор блога
    </h1>
    <div class="contact">
        <form name="blogForm" method="POST" enctype="multipart/form-data">
            <label for="author">Имя</label>
            <input name="author" placeholder="Имя" type="text" value="<?php echo $model->author ?>">
            <label class="error-block" for="author" id="author-error">
                <?php echo $model->showError('name'); ?>
            </label>
            <label for="subject">Тема</label>
            <input name="subject" placeholder="Тема" type="subject" value="<?php echo $model->subject ?>">
            <label class="error-block" for="subject" id="subject-error">
                <?php echo $model->showError('subject'); ?>
            </label>
            <label for="image">Файл изображения</label>
            <input type="file" name="image">
            <label class="error-block" for="image" id="image-error">
                <?php echo $model->showError('image'); ?>
            </label>
            <label for="message">Сообщение</label>
            <textarea name="message" name="message" placeholder="Сообщение"><?php echo $model->message; ?></textarea>
            <label class="error-block" for="message" id="message-error">
                <?php echo $model->showError('message'); ?>
            </label>
            <div class="submit-container">
                <input class="submit" type="submit" id="submit-button" value="Отправить">
                <input class="submit" type="reset" value="Очистить форму ">
            </div>
        </form>
    </div>
    
</section>
<br>
<section>
    <h1 class="centered">
        Все записи
    </h1>
</section>
<div class="pages">
    Страницы:
    <?php
        if ($model->page > 0)
        {
            echo '<a href="/blog/add?page='.($model->page - 1).'&page_size='.$model->pageSize.'"><-Предыдущая </a>';
        }
        if ($model->page < $model->maxPages - 1)
        {
            echo '<a href="/blog/add?page='.($model->page + 1).'&page_size='.$model->pageSize.'">Следующая-></a>';
        }
        echo '<br>';
        for ($i = 0; $i < min(2, $model->page); $i++) {
            echo '<a href="/blog/add?page='.$i.'&page_size='.$model->pageSize.'">'.($i+1).' </a>';
        }
        if ($model->page > 2)
            echo '...';
        echo $model->page + 1;
        if ($model->page < $model->maxPages-3)
            echo '...';
        for ($i = max($model->maxPages - 3, $model->page) + 1; $i < $model->maxPages; $i++) {
            echo '<a href="/blog/add?page='.$i.'&page_size='.$model->pageSize.'"> '.($i+1).'</a>';
        }
        echo '<br>';
        echo 'Отображать на странице: ';
        $sizes = [1,2,5,10,20];
        foreach ($sizes as $size)
        {
            if ($model->pageSize != $size)
            {
                echo '<a href="/blog/add?page=0&page_size='.$size.'">'.$size.' </a>';
            }
            else 
            {
                echo $size.' ';
            }
        }
    ?>
</div>
<br>
<?php
foreach ($model->blogs as $blog)
{
    echo '<section class="container blog">';
    if (!empty($blog->image))
        echo '<img class="blog-img" src="'.$blog->image.'">';
    echo '<div class="blog-text text-container">';
    echo '<div class="blog-text text-author">'.$blog->author.'</div><br>';
    echo '<div class="blog-text text-subject">'.$blog->subject.'</div><br>';
    echo '<div class="blog-text text-content">'.$blog->message.'</div><br>';
    echo '<div class="blog-text text-date">'.$blog->date.'</div><br>';
    echo '</div>';
    echo '</section><br>';
}
?>

