<section class="container">
    <h1 class="centered">
        Загрузка сообщений гостевой книги
    </h1>
    <div class="contact">
        <h2> Форма для загрузки файлов </h2>
        <form method="post" enctype="multipart/form-data">
            <label for="messages">Файл сообщений гостевой книги</label>
            <input type="file" name="messages">
            <label class="error-block" for="message" id="message-error">
                <?php echo $model->validator->validation_marks['message']['error']; ?>
            </label>
            <div class="submit-container">
                <input class="submit" type="submit" value="3arpyзить">
            </div>
        </form>
    </div>
</section>