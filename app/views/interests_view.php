<header>
        <h1>Мои интересы</h1>
  </header> 
  <aside>
      <?
            echo '<ul>';
            foreach ($model->interests as $hobby) {
                  echo '<li><a class="alt-href" href="'.$hobby['anchor'].'">'.$hobby['title'].'</a></li>';
            }
            echo '</ul>';
      ?>
  </aside>
  <br>
  <?
      foreach ($model->interests as $hobby) {
            echo '<section><header><a name="'
            .$hobby['name'].'"></a><h2>'
            .$hobby['title'].'</h2><p>'
            .$hobby['description'].'</p></header><br></section>';
      }
  ?>
