<header>
  <h1>Мой альбом</h1>
</header> 
<section>
  <div id="app">
      <div class="album">
        <?
          for($i = 0; $i < count($model->images); $i++){
            echo '<span class="album-item">';
            echo '<img src="'.$model->images[$i]['photo'].'" alt="'.$model->images[$i]['alt'].'">';
            echo '</span>';
          }
        ?>
        <!-- <album-item v-for="(photo,i) in photos" :key="i" :package="photo" @click="index = i"></album-item>
      </div>
      <img-popup v-if="index !== -1" :photos="photos" :index="index" @close="index=-1">
      </img-popup> -->
  </div>
</section>