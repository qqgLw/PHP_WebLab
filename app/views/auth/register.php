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

            <label for="login">Логин</label>
            <input name="login" placeholder="Логин" onchange="checkLogin(this);" type="text" value="<?php echo $model->bufferedFields['login'] ?>">
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
                <!-- <a onclick="checkLogin()" name="check-login" class="alt-href">Проверка логина</a> -->
            </div>
        </form>
    </div>

    <script>

        function checkLogin(iLogin) {

            const login = iLogin.value;

            if (typeof login !== 'undefined' && login.length) {
                const payload = "<data><login>" + login + "</login></data>";
                fetch("/auth/checkLogin", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'text/xml; charset=UTF-8',
                    },
                    body: payload
                }).then(respone => {
                    switch (respone.status){
                        case 200:
                            $("#login-error").append("<p>Логин уникален</p>");
                            alert("Норм!")
                            break;

                        case 400:
                            $("#login-error").append("<p>!!!Логин неуникален!!!</p>");
                            alert("Нe норм!")
                            break;

                        default:
                            alert("Неожиданный ответ от сервера!")
                            break;
                    }
                }).catch((error)=>{
                    alert(`Ошибка сервера: ${error}`);
                })
            }
        }

    </script>
</section>
