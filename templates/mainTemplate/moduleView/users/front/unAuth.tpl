{{include file="_header.tpl"}}

{{include file="_menu.tpl"}}

<div class="container mt-5">

    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Вы не зарегестрированы</h4>
        <p>Для доступа на эту страницу вам неоходимо зарегестрироватся или войти в систему.</p>
        <p class="mb-0">
            <a href="/auth/login" class="btn btn-danger">Вход</a> <a href="/auth/register" class="btn btn-warning">Регистрация</a>
        </p>
    </div>
</div>

{{include file="_footer.tpl"}}