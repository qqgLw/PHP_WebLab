<section>
    <h1 class="centered">
        Мой блог
    </h1>
    
</section>
<div class="pages">
    Страницы:
    <?php
        if ($model->page > 0)
        {
            echo '<a href="/blog/?page='.($model->page - 1).'&page_size='.$model->pageSize.'"><-Предыдущая </a>';
        }
        if ($model->page < $model->maxPages - 1)
        {
            echo '<a href="/blog/?page='.($model->page + 1).'&page_size='.$model->pageSize.'">Следующая-></a>';
        }
        echo '<br>';
        for ($i = 0; $i < min(2, $model->page); $i++) {
            echo '<a href="/blog/?page='.$i.'&page_size='.$model->pageSize.'">'.($i+1).' </a>';
        }
        if ($model->page > 2)
            echo '...';
        echo $model->page + 1;
        if ($model->page < $model->maxPages-3)
            echo '...';
        for ($i = max($model->maxPages - 3, $model->page) + 1; $i < $model->maxPages; $i++) {
            echo '<a href="/blog/?page='.$i.'&page_size='.$model->pageSize.'"> '.($i+1).'</a>';
        }
        echo '<br>';
        echo 'Отображать на странице: ';
        $sizes = [1,2,5,10,20];
        foreach ($sizes as $size)
        {
            if ($model->pageSize != $size)
            {
                echo '<a href="/blog/?page=0&page_size='.$size.'">'.$size.' </a>';
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
    if (!empty($blog->imageGUID))
        echo '<img src="'.$blog->imageGUID.'">';
    echo '<div>';
    echo '<div>'.$blog->author.'</div><br>';
    echo '<div>'.$blog->subject.'</div><br>';
    echo '<div>'.$blog->message.'</div><br>';
    echo '<div>'.$blog->date.'</div><br>';
    echo '</div>';
    echo '</section><br>';
}
?>

