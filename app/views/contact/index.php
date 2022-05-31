<header>
  <h1>Напишите мне на  эл. почту</h1>
</header> 
<section>
  <form method="POST">
    <div>
        <label for="name">ФИО</label>
        <span class="error"><?php echo $model->validator->validation_marks['name']['error'];?></span>
        <input type="text" placeholder="Например, Иванов Иван Иванович" name = "name" id="name" value="<? echo $model->bufferedFields['name'] ?>">
        <div class="popover">Введите ваше ФИО полностью</div>
        <label for="email">Электронная почта</label>
        <span class="error"><?php echo $model->validator->validation_marks['email']['error'];?></span>
        <input type="text" placeholder="Например, test@gmail.com" name = "email" id="email" value="<? echo $model->bufferedFields['email'] ?>">
        <label for="phone">Телефон</label>
        <span class="error"><?php echo $model->validator->validation_marks['phone']['error'];?></span>
        <input type="tel" placeholder="Например, +71234567" name = "phone" id="phone" value="<? echo $model->bufferedFields['phone'] ?>">
    </div>
    <div>
        <label for="dateOfBirth">Дата рождения</label>
        <span class="error"><?php echo $model->validator->validation_marks['dateOfBirth']['error'];?></span>
        <input type="text" name = "dateOfBirth" id = "dateOfBirth" onclick = "showCalendar(new Date())" readonly value="<? echo $model->bufferedFields['dateOfBirth'] ?>">
        <div class="popover">Выберите дату рождения</div>
        <div id = "calendar" style="display: inline;">
              Месяц: <select id = "month" onclick = "redrawCalendar()">
              </select>
              Год: <select id = "year" onclick="redrawCalendar()">
              </select>
              <button type="button" onclick = "hideCalendar()">Спрятать календарь</button>
        </div>
    </div>
    <div class="radio-select">
        <p>Выберите пол:</p>
        <span class="error"><?php echo $model->validator->validation_marks['gender']['error'];?></span>
        <label for="gender_male">Мужской</label>
        <input type="radio" name="gender" value="male" id="gender_male" <? if (isset($model->bufferedFields['gender']) && ($model->bufferedFields['gender'] == "male")) echo "checked"; ?>>
        <label for="gender_female">Женский</label>
        <input type="radio" name="gender" value="female" id="gender_female" <? if (isset($model->bufferedFields['gender']) && ($model->bufferedFields['gender'] == "female")) echo "checked"; ?>>
    </div>
    <span class="error"><?php echo $model->validator->validation_marks['message']['error'];?></span>
    <textarea name="message" id="inpmessage"cols="20" rows="5" placeholder="Ваше сообщение*"><? echo $model->bufferedFields['message'] ?></textarea>
    <div class="submit-container">
      <input name="submit" type="submit" value="Отправить"/>
      <input name="reset" type="reset" onclick="resetForm(this)" value="Сбросить"/>
    </div>
    </form> 
</section>