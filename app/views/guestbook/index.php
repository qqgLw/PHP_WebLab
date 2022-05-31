<section class="container">
    <h1 class="centered">
        Гостевая книга
    </h1>
    <h1 class="centered">
        Добавить новое сообщение
    </h1>
    <div class="contact">
        <form name="guestForm" method="POST">
            <label for="name">ФИО</label>
            <input name="name" placeholder="ФИО" type="text" value="<?php echo $model->name ?>">
            <label class="error-block" for="name" id="name-error">
                <?php echo $model->showError('name'); ?>
            </label>
            <label for="email">Электронная почта</label>
            <input name="email" placeholder="Электронная почта" type="email" value="<?php echo $model->email ?>">
            <label class="error-block" for="email" id="email-error">
                <?php echo $model->showError('email'); ?>
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
    <h1 class="centered">
        Все отзывы
    </h1>
    <table>
        <tr>
            <th>Дата</th>
            <th>ФИО</th>
            <th>Email</th>
            <th>Сообщение</th>
        </tr>
        <?php
        foreach ($model->messages as $message)
        {
            echo '<tr><td>'.$message['date'].'</td>';
            echo '<td>'.$message['name'].'</td>';
            echo '<td>'.$message['email'].'</td>';
            echo '<td>'.$message['message'].'</td></tr>';
        }
        ?>
    </table>
</section>
