<section class="container">
    <h1 class="centered">
        Статистика посещений
    </h1>
    <h1 class="centered">
        Все посещения
    </h1>
    <table>
        <tr>
            <th>Дата</th>
            <th>Web-страница</th>
            <th>IP</th>
            <th>Имя хоста</th>
            <th>Браузер</th>
        </tr>
        <?php
        foreach ($model->stats as $stat)
        {
            echo '<tr><td>'.$stat->datetime.'</td>';
            echo '<td>'.$stat->link.'</td>';
            echo '<td>'.$stat->ip.'</td>';
            echo '<td>'.$stat->hostname.'</td>';
            echo '<td>'.$stat->browser.'</td></tr>';
        }
        ?>
    </table>
</section>
