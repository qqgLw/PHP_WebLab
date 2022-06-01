<section class="container">
    <h1 class="centered">
        Регистрация пользователя
    </h1>
    <div class="contact">
        <form name="registerForm" method="POST">
            <label for="fio">ФИО</label>
            <input name="fio" placeholder="ФИО" type="text" value="<?php echo $model->bufferedFields['fio'] ?>">
            <label class="error-block" for="fio" id="fio-error">
                <?php echo $model->validator->validation_marks['fio']['error']; ?>
            </label>

            <label for="email">Электронная почта</label>
            <input name="email" placeholder="Электронная почта" type="email" value="<?php echo $model->bufferedFields['email'] ?>">
            <label class="error-block" for="email" id="email-error">
                <?php echo$model->validator->validation_marks['email']['error']; ?>
            </label>

            <label for="login">Логин</label>
            <input name="login" placeholder="Логин" type="text" value="<?php echo $model->bufferedFields['login'] ?>">
            <label class="error-block" for="login" id="login-error">
                <?php echo $model->validator->validation_marks['login']['error']; ?>
            </label>

            <label for="password">Пароль</label>
            <input name="password" placeholder="Пароль" type="password" value="<?php echo $model->bufferedFields['password'] ?>">
            <label class="error-block" for="password" id="password-error">
                <?php echo $model->validator->validation_marks['password']['error']; ?>
            </label>

            <div class="submit-container">
                <input class="submit" type="submit" id="submit-button" value="Регистрация">
            </div>
        </form>
    </div>
</section>
