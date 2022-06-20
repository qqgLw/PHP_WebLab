<section>
    <h1 class="centered">
        Мой блог
    </h1>
    
</section>
<?php if (!empty($model->blogs)) : ?>
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

    <?php foreach ($model->blogs as $blog) : ?>
            <section class="container blog" id="blog-<?= $blog->id ?>">
                <div style="padding:15px;">
                    <header id="t1">
                        <?php if (isset($_SESSION['isAdmin'])) : ?>
                            <button onclick="openBlogEditor(<?= $blog->id ?>)">Изменить</button><br>
                        <?php endif; ?>
                        <h3 class=""><?= $blog->subject ?></h3>
                        <p><?=$blog->author?></p>
                        <small><?= $blog->date ?></small>
                    </header>
                    <div style="height: 15em; overflow: hidden;">
                        <div>
                            <?php if (empty($blog->imageGUID)) : ?>
                                <!-- <img src="/Default.jpg" alt=""> -->
                            <?php else : ?>
                                <img src="<?= $blog->imageGUID ?>" />
                            <?php endif; ?>
                        </div>
                        <p class="blog-message"><?= $blog->message ?></p>
                    </div>
                </div>

                <div style="padding-left: 10%; padding:10px; border-radius:0 0 10px 10px;">
                    <h3>Комментарии:</h3>
                    <hr>
                    <div style="margin-top: 10px;">
                        <?php if (isset($_SESSION['Logged'])) : ?>
                            <button class="" onclick="addComment(<?= $blog->id ?>)">Добавить комментарий</button>
                        <?php endif; ?>
                        <div id="add-comment-<?= $blog->id ?>" style="display: none;">
                            <br>
                            <textarea id="add-comment-textarea-<?= $blog->id ?>" rows="5" cols="100" placeholder="Ваш комментарий..."></textarea><br>
                            <button class="form-button" onclick="loadComment(<?= $blog->id ?>)">Отправить</button>
                        </div>
                    </div>
                    <div id="comments-<?= $blog->id ?>">
                        <?php if (isset($model->сomments[$blog->id])) : ?>
                            <?php foreach ($model->сomments[$blog->id] as $comment) : ?>
                                <!-- <p><small style="color: #ffa113;"><b><?= $comment['author'] ?></b></small></p> -->
                                <p><small><?= $comment['text'] ?></small></p>
                                <p><small><?= $comment['created'] ?></small></p>
                                <hr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <br><br>
    <?php endforeach; ?>
<?php endif; ?>

<div class="nmodal" id="modal">
    <div class="nmodal-header">
        <div class="nmodal-title">Изменить блог</div>
        <button id="img-close-button" class="close-button">&times;</button>
    </div>
    <div class="nmodal-body">
        <div style="display: inline-block;">
            <label for="blog-title">Тема:</label><br>
            <input style="margin-top: 5px;" id="blog-title" name="title" maxlength="100" size="50" type="text" required>
        </div>
        <br>
        <div style="margin: 0; margin-top: 20px;">
            <label for="blog-message">Сообщение:</label><br>
            <textarea id="blog-message" name="message" class="rounded-input" rows=10 cols=50 required></textarea>
            <br><br>
        </div>
        <br>
    </div>
    <div class="nmodal-footer">
        <button id="modal-save-btn" class="btn yes-btn">Сохранить</button>
    </div>
</div>
<div id="overlay"></div>

<script>
    var overlay = $("#overlay").get(0);

    function openModal(modal) {
        if (modal == null) return;
        modal.classList.add('active');
        overlay.classList.add('active');
        $('#overlay').blur();
    }

    function closeModal(modal) {
        if (modal == null) return;
        modal.classList.remove('active');
        overlay.classList.remove('active');
        $(".nmodal-body").empty();
    }

    $("#img-close-button").click((e) => {
            let modal = e.target.closest("#modal")
            closeModal(modal)
        });

        var req;

        function addComment(publicationId) {
            var section = document.getElementById('add-comment-' + publicationId);
            section.style.display = "block";
        }

        function loadComment(publicationId) {
            var commentTextarea = document.getElementById('add-comment-textarea-' + publicationId);
            var text = commentTextarea.value;
            text = text.trim();
            if (!text) {
                alert('Не был введен текст');
            } else {
                req = new XMLHttpRequest();
                req.onreadystatechange = function() {
                    loadCommentReady(publicationId)
                };
                req.open("POST", "/blog/loadComment", true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send(`publicationId=${publicationId}&commentText=${text}`);
            }
        }

        function loadCommentReady(publicationId) {
            try {
                if (req.readyState == 4) {
                    if (req.status == 200) {
                        alert("Данные успешно получены");
                        let comment = req.responseText;
                        var commentsArea = document.getElementById(`comments-${publicationId}`);
                        commentsArea.innerHTML += comment;
                        //comments-${publicationId}

                    } else {
                        alert("Не удалось получить данные:\n" + req.statusText);
                    }
                }
            } catch (e) {
                alert('Caught Exception: ' + e.description);
            }
        }

        function openBlogEditor(publicationId) {
            let blogTitle = modal.querySelector("#blog-title");
            let blogMessage = modal.querySelector("#blog-message");
            let saveButton = modal.querySelector("#modal-save-btn");

            let old_blogTitle;
            let old_blogMessage;

            $.post('/blog/getPublicationInfo', {
                blogId: publicationId
            }, function(result) {
                let blogInfo = JSON.parse(result);
                blogTitle.value = blogInfo.title;
                blogMessage.value = blogInfo.message;

                old_blogTitle = blogInfo.title;
                old_blogMessage = blogInfo.message;
            });

            saveButton.onclick = function() {
                editBlog(modal, publicationId, old_blogTitle, old_blogMessage)
            }

            openModal(modal);
        }



        function editBlog(modal, publicationId, old_blogTitle, old_blogMessage) {
            let blogTitle = modal.querySelector("#blog-title").value.trim();
            let blogMessage = modal.querySelector("#blog-message").value.trim();

            if (blogTitle != "" && blogMessage != "" && !(old_blogTitle == blogTitle && old_blogMessage == blogMessage)) {
                postData('/blog/editBlog', {
                    id: publicationId,
                    title: blogTitle,
                    message: blogMessage
                }).then(data => {
                    console.log(data);
                    let publication = $(`#publication-${publicationId}`).get(0);
                    let title = publication.querySelector(".publication-title");
                    let message = publication.querySelector(".publication-message");
                    title.innerHTML = data.title;
                    message.innerHTML = data.message;
                }).catch((error)=>{
                    alert(`Ошибка сервера: ${error}`);
                })
            }
            closeModal(modal);
        }


        async function postData(url = '', data = {}) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
            return response.json();
        }

</script>



