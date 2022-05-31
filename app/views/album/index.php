<?  
    echo '<script>';
        echo 'const photoLinks = [';
            foreach ($model->images as $element) {
                echo '\''.$element['photo'].'\',';
            }
        echo '];';
        echo 'const photoTitles = [';
            foreach ($model->images as $element) {
                echo '\''.$element['title'].'\',';
            }
        echo '];';
    echo '</script>';
?>
<div class="container">
    <h1 class="centered">
        Фотоальбом
    </h1>
        <div class="modal" id="modal-main">
        <span class="close" id="modal-close">×</span>
        <span id="modal-left" onclick="slideImage(-1)"><</span>
        <span id="modal-right" onclick="slideImage(1)">></span>
        <img class="modal-content" id="modal-image">
        <div id="modal-caption"></div>
    </div>
    <div class="album">
        <?
          for($i = 0; $i < count($model->images); $i++){
            echo '<span class="album-item">';
            echo '<img class="popupable" src="'.$model->images[$i]['photo'].'" alt="'.$model->images[$i]['alt'].'">';
            echo '<p class="centered">'.$model->images[$i]['comment'].'</p>';
            echo '</span>';
          }
        ?>
    </div>
</div>