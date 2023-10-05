<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Form</title>
</head>

<body class="body">

<div class="table-holder">
    <div class="attributes">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link font-black" href="<?php if($page != 1){ echo $page - 1;}?>">Previous</a></li>

                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <li class="page-item"><a class="page-link font-black" href="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li class="page-item"><a class="page-link font-black" href="<?php if($page != $pages){ echo $page + 1; } ?>">Next</a></li>
            </ul>
        </nav>
    </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID обращения</th>
            <th>Почта</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Дата рождения</th>
            <th>Страна</th>
            <th>Узнал о нас</th>
            <th>Тема</th>
            <th>Обращение</th>
            <th>Личные данные</th>
            <th>Файл</th>
        </tr>
        </thead>
        <?php foreach ($paginatedMessages as $message) {
            echo "
        <tr class='tr'>
        <td>{$message['id']}</td>
        <td>{$message['email']}</td>
        <td>{$message['name']}</td>
        <td>{$message['surname']}</td>
        <td>{$message['birthdate']}</td>
        <td>{$message['country']}</td>
        <td>{$message['recognize']}</td>
        <td>{$message['theme']}</td>
        <td>{$message['content']}</td>
        <td>{$message['personal']}</td>
        <td>{$message['filename']}</td>
        </tr>
        ";
        } ?>
    </table>
    <a href="/form" class="btn btn-secondary btn-lg active btn-w" role="button" aria-pressed="true">Форма</a>
</div>
</body>
</html>