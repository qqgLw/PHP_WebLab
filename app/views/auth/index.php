<section class="container">
    <h1 class="centered">
        Авторизация пользователя <?=isset($_SESSION['Logged'])?'y':'n'?>
        <?php
            if(isset($model->bufferedFields['submit'])){
            if (isset($_SESSION['LastError'])){
                if(($_SESSION['LastError']) == 'WrongPass')
                {
                    echo "Неверный пароль";
                }
            }
            if (isset($_SESSION['LastError'])){
                if(($_SESSION['LastError']) == 'WrongUser')
                {
                    echo "Пользователя с таким логином не существует";
                }
            }}
        ?>
    </h1>
    <div class="contact">
        <form name="loginForm" method="POST">
            <label for="login">Логин</label>
            <input name="login" placeholder="Логин" type="text" value="<?php echo $model->bufferedFields['login'] ?>">
            <label class="error" for="login" id="login-error">
                <?php echo $model->validator->validation_marks['login']['error']; 
                if (isset($_SESSION['LastError'])){
                    if(($_SESSION['LastError']) == 'WrongUser')
                    {
                        echo "Пользователя с таким логином не существует";
                    }
                }?>
            </label>
            <label for="password">Пароль</label>
            <input name="password" placeholder="Пароль" type="password" value="<?php echo $model->bufferedFields['password'] ?>">
            <label class="error" for="password" id="password-error">
                <?php echo $model->validator->validation_marks['password']['error']; 
                if (isset($_SESSION['LastError'])){
                    if(($_SESSION['LastError']) == 'WrongPass')
                    {
                        echo "Неверный пароль";
                    }
                }?>
            </label>
            <div class="submit-container">
                <input class="submit" type="submit" value="Войти">
                <a href="/auth/register" class="alt-href">Регистрация</a>
            </div>                
        </form>
    </div>
</section>
