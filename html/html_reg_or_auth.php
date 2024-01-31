<?php 
session_start();
?>

<div class="base-arforms">
    <h1> Профиль пользователя </h1>
    <div class="row">
        <form class="col-6 arforms" action="/auth.php" method="post">
            <h2> Авторизация </h2>
            <div class="row arforms-block">
                <span class="arforms-span col-10"> Логин </span>
                <input class="arforms-input col-10" name="login" type="text">
            </div>
            <div class="row arforms-block">
                <span class="arforms-span col-10"> Пароль </span>
                <input class="arforms-input col-10" name="password" type="password">
            </div>
            <div>
                <button type="submit" class="btn btn-green arforms-btn"> Зайти в аккаунт </button>
            </div>
        </form>
        <form class="col-6 arforms" action="/reg.php" method="post">
            <h2> Регистрация </h2>
            <div class="row arforms-block">
                <span class="arforms-span col-10"> Логин </span>
                <input class="arforms-input col-10" name="login" type="text">
            </div>
            <div class="row arforms-block">
                <span class="arforms-span col-10"> Пароль </span>
                <input class="arforms-input col-10" name="password" type="password">
            </div>
            <div>
                <button type="submit" class="btn btn-green"> Создать аккаунт </button>
            </div>
        </form>
    </div>
</div>

<?php unset($_SESSION['error-login']); ?>