<section class="container">
    <h1 class="centered">
        Загрузка сообщений блога
    </h1>
    <div class="contact">
        <h2> Форма для загрузки файлов </h2>
        <form method="post" enctype="multipart/form-data">
            <label for="messages">Файл сообщения блога</label>
            <input type="file" name="messages">
            <label class="error-block" for="message" id="message-error">
                <?php echo $model->showError('messagыe'); ?>
            </label>
            <div class="submit-container">
                <input class="submit" type="submit" value="3arpyзить">
            </div>
        </form>
    </div>
</section>