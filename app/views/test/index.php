<header>
  <h1>Тест по методам исследования операций (МИО):</h1>
</header> 
<section>
      <header><a class="alt-href" href="/study"><p>Учеба</p></a></header>
      <span style="font-weight: bold;" class="validate-result"><?if(isset($model->bufferedFields['submit'])) echo ($model->validator->isTestValid())? $model->positiveValidMes : $model->negativeValidMes?></span>
      <span style="font-weight: bold;" class="verify-result"><?if(isset($model->bufferedFields['submit']) and $model->validator->isTestValid()) echo ($model->validator->isResultsRight())? $model->positiveVerifMes : $model->negativeVerifMes?></span>
      <form method="POST">
          <p>Введите ФИО:</p>
          <div>
                <span class="error"><?php echo $model->validator->validation_marks['name']['error'];?></span>
                <span class="mark"><?php echo $model->validator->validation_marks['name']['mark'];?></span>
                <input name="name" type="text" placeholder="Например, Иванов Иван Иванович" value="<? echo $model->bufferedFields['name'] ?>"/>
          </div>
          <p>Выберете Вашу группу из контекстного списка:</p>
          <span class="error"><?php echo $model->validator->validation_marks['group']['error'];?></span>
          <span class="mark"><?php echo $model->validator->validation_marks['group']['mark'];?></span>
          <select class="option-group" name="group" size="4">
                <optgroup label="I курс">
                    <option value="course1group1" <? if (isset($model->bufferedFields['group']) && ($model->bufferedFields['group'] == "course1group1")) echo "selected"; ?>>ИС/б-21-1-о
                    <option value="course1group2" <? if (isset($model->bufferedFields['group']) && ($model->bufferedFields['group'] == "course1group2")) echo "selected"; ?>>ИС/б-21-2-о
                </optgroup>
                <optgroup label="III курс">
                    <option value="course3group1" <? if (isset($model->bufferedFields['group']) && ($model->bufferedFields['group'] == "course3group1")) echo "selected"; ?>>ИС/б-19-2-о
                    <option value="course3group2" <? if (isset($model->bufferedFields['group']) && ($model->bufferedFields['group'] == "course3group2")) echo "selected"; ?>>ИС/б-19-2-о  
                </optgroup>
          </select>
          <ol class="test">
                <li>
                    <p>
                        Вопрос номер 1:
                        <span class="error"><?php echo $model->validator->validation_marks['awnser1']['error'];?></span>
                        <span class="mark"><?php echo $model->validator->validation_marks['awnser1']['mark'];?></span>
                    </p>
                    <input type="text" placeholder="Ваш ответ" name="awnser1" value="<? echo $model->bufferedFields['awnser1'] ?>"/>
                </li>
                <li>
                    <p>
                        Вопрос номер два:
                        <span class="error"><?php echo $model->validator->validation_marks['awnser2']['error'];?></span>
                        <span class="mark"><?php echo $model->validator->validation_marks['awnser2']['mark'];?></span>
                    </p>
                    <p>Выберете варианты ответа:</p>
                    <div class="radio-select">
                          <label for="awnser21">Вариант 1</label>
                          <input type="checkbox" name="awnser21" value="1" id="awnser21" <? if (!empty($model->bufferedFields['awnser21'])) echo "checked"; ?>/>
                          <label for="awnser22">Вариант 2</label>
                          <input type="checkbox" name="awnser22" value="2" id="awnser22" <? if (!empty($model->bufferedFields['awnser22'])) echo "checked"; ?>/>
                          <label for="awnser23">Вариант 3</label>
                          <input type="checkbox" name="awnser23" value="3" id="awnser23" <? if (!empty($model->bufferedFields['awnser23'])) echo "checked"; ?>/>                                   
                          <label for="awnser24">Вариант 4</label>
                          <input type="checkbox" name="awnser24" value="4" id="awnser24" <? if (!empty($model->bufferedFields['awnser24'])) echo "checked"; ?>/>
                    </div>
                </li>
                <li style="text-align: center;">
                    <p>
                        Вопрос номер 3:
                        <span class="error"><?php echo $model->validator->validation_marks['awnser3']['error'];?></span>
                        <span class="mark"><?php echo $model->validator->validation_marks['awnser3']['mark'];?></span>
                    </p>
                    <p>Выберете вариант из контекстного списка:</p>
                    <select name="awnser3[]" multiple>
                          <optgroup label="Первые два варианта">
                              <option value="1" <? if (is_array($model->bufferedFields['awnser3']) and isset($model->bufferedFields['awnser3']) && (in_array("1", $model->bufferedFields['awnser3']))) echo "selected"; ?>>1</option>
                              <option value="2" <? if (is_array($model->bufferedFields['awnser3']) and isset($model->bufferedFields['awnser3']) && (in_array("2", $model->bufferedFields['awnser3']))) echo "selected"; ?>>2</option>
                          </optgroup>
                          <optgroup label="Последние два варианта">
                              <option value="3" <? if (is_array($model->bufferedFields['awnser3']) and isset($model->bufferedFields['awnser3']) && (in_array("3", $model->bufferedFields['awnser3']))) echo "selected"; ?>>3</option>
                              <option value="4" <? if (is_array($model->bufferedFields['awnser3']) and isset($model->bufferedFields['awnser3']) && (in_array("4", $model->bufferedFields['awnser3']))) echo "selected"; ?>>4</option> 
                          </optgroup>
                    </select>
                </li>
          </ol>
          <div class="submit-container">
                <input class="submit-button" name="submit" type=submit value="Отправить"/>
                <input class="submit-button" name="reset" type="reset" onclick="resetForm(this)" value="Сбросить"/>
          </div>
      </form>
</section>

<?php 
if (isset($_SESSION['Logged']))
{
    foreach ($model->testResults as $result)
    {
        echo '<section class="container" style="max-width: 70%;">';
        echo '<div class="question">';
            echo '<br>';
            echo '<div class="centered">';
                echo 'Ответы '.$result->name;
            echo '</div>';
            echo '<div> Вопрос 1: '.$result->ans_1.'</div>';
            echo '<div> Вопрос 2: '.$result->ans_2.'</div>';
            echo '<div> Вопрос 3: '.$result->ans_3.'</div>';
            echo '<div> Отвечено верно: '.(($result->iscorrect==='1')?'true':'false').'</div>';
            echo '<div>Группа: '.$result->ngroup.'</div>';
            echo '<div>Дата: '.$result->date.'</div>';
        echo '</div>';
        echo '</section>';
        echo '<br>';
    }
}
?>