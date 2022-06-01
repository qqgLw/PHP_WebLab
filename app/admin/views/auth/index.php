<section class="container">
    <h1 class="centered">
        Авторизация администратора
    </h1>
    <div class="contact">
        <form name="guestForm" method="POST">
            <label for="email">Электронная почта</label>
            <input name="email" placeholder="Электронная почта" type="email" value="<?php echo $model->bufferedFields['email'] ?>">
            <label class="error-block" for="email" id="email-error">
                <?php echo$model->validator->validation_marks['email']['error']; ?>
            </label>

            <label for="password">Пароль</label>
            <input name="password" placeholder="Пароль" type="password" value="<?php echo $model->bufferedFields['password'] ?>">
            <label class="error-block" for="password" id="password-error">
                <?php echo $model->validator->validation_marks['password']['error']; ?>
            </label>
            <div class="submit-container">
                <input class="submit" type="submit" id="submit-button" value="Войти">
            </div>
        </form>
    </div>
</section>
