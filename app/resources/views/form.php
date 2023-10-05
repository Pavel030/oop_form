
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Form</title>
</head>

<body class="body">

<form method="POST" action="/form" novalidate class="form-holder" enctype="multipart/form-data">

    <div class="col-md-4 input-width">
        <label for="email" class="question-title">E-mail</label>
        <input type="text" class="<?= !empty($errors['email']) ? 'form-control is-invalid' : 'form-control' ?>"
               id="email" name="email" value="<?= htmlspecialchars($input['email'] ?? '') ?>" required>
        <span class="error"><?= !empty($errors['email']) ? htmlspecialchars($errors['email']) : '' ?></span>
    </div>
    <div class="col-md-4 input-width">
        <label for="name" class="question-title">Имя</label>
        <input type="text" class="<?= !empty($errors['name']) ? 'form-control is-invalid' : 'form-control' ?>" id="name"
               name="name" value="<?= htmlspecialchars($input['name'] ?? '') ?>" required>
        <span class="error"><?= !empty($errors['name']) ? htmlspecialchars($errors['name']) : '' ?></span>
    </div>
    <div class="col-md-4 input-width">
        <label for="surname" class="question-title">Фамилия</label>
        <input type="text" class="<?= !empty($errors['surname']) ? 'form-control is-invalid' : 'form-control' ?>"
               id="surname" name="surname" value="<?= htmlspecialchars($input['surname'] ?? '') ?>">
        <span class="error"><?= !empty($errors['surname']) ? htmlspecialchars($errors['surname']) : '' ?></span>
    </div>

    <label for="birthdate" class="question-title">Дата рождения</label>
    <input class="<?= !empty($errors['birthdate']) ? 'form-control is-invalid' : 'form-control' ?>" type="date"
           id="birthdate" name="birthdate">
    <span class="error"><?= !empty($errors['birthdate']) ? htmlspecialchars($errors['birthdate']) : '' ?></span>

    <div class="question-title">Где вы сейчас проживаете?</div>
    <div class="form-check">
        <input class="form-check-input" type="radio" value="UZB" id="zb" name="country" checked>
        <label class="form-check-label" for="uzb">Узбекистан</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" value="RUS" id="rus" name="country">
        <label class="form-check-label" for="rus">Россия</label>
    </div>
    <label for="recognize" class="question-title">Как вы узнали о нас?</label>
    <select multiple class="form-select" id="recognize" name="recognize[]">
        <option value="collaboration">HH.RU</option>
        <option value="recommendation">Рекомендация</option>
        <option value="telegram">Telegram</option>
        <option value="advertising">Реклама в интернете</option>
        <option value="other">Другое</option>
    </select>
    <div class="form-group mb-4">
        <label class="question-title" for="theme">Выберите тему обращения</label>
        <select id="theme" class="form-select" name="theme">
            <option selected value="collaboration">Сотрудничество</option>
            <option selected value="support">Поддержка продукта</option>
            <option value="order">Заказ проекта</option>
            <option value="school">Школа IT-профессий</option>
            <option value="vacancies">Вакансии</option>
        </select>
    </div>
    <div class="form-group mb-4">
        <label for="content" class="question-title">Ваше сообщение</label>
        <textarea class="form-control" rows="3" id="content"
                  name="content"><?= htmlspecialchars($input['content'] ?? '') ?></textarea>
    </div>
    <label for="content" class="question-title">Прикрепите обращение</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="90000000"/>
    <input type="file" name="userFile" id="userFile" accept=".pdf, .docx, .doc">
    <span class="error"><?= !empty($errors['fileError']) ? htmlspecialchars($errors['fileError']) : '' ?></span>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="personal" name="personal" checked>
        <label class="form-check-label" for="personal">Я согласен на обработку персональных данных</label>
    </div>
    <div class="attributes">
        <input type="submit" class="btn btn-primary" value="Отправить" name="submit">
        <input class="btn btn-secondary" type="reset" value="Сбросить форму" name="reset">
    </div>
</form>

</body>
</html>