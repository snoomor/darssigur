<!DOCTYPE html>
<html lang="ru">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <h3>Регистрация в системе Dars Sigur</h3>
    <p>Вы были зарегистрированы в пропускной системе Dars Sigur с правами
    @if($role == 'admin')
    администратора.
    @else
     управления работниками своей рабочей группы.
    @endif
    </p>
    <p>Информируем Вас о том, что Вы несете отвественность за достоверность предостваляемых Вами данных о регистриуемых сотрудниках.</p></br>
    <p>Страница входа в сиситему: <a href="https://sigur.darscompany.ru">sigur.darscompany.ru</a></p>
    <p>Логин: {{ $email }}</p>
    <p>Пароль: {{ $password }}</p><br>
    <p>По всем вопросам обращаться на почту d.novikov@darscompany.ru</p>
    <p>Письмо отправлено автоматически. Оно обязательно и не требует отписки.</p>
</body>