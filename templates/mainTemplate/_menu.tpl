<div class="container-white">
    <div class="container">
        <nav class="navbar navbar-light rounded navbar-toggleable-md">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/">Resumator</a>

            <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
                <ul class="nav navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/resume/add">Добавить резюме <span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/top">Топ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/search">Поиск</a>
                    </li>
                    {{if $is_login == false}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Войти</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="/auth/login">Логин</a>
                                <a class="dropdown-item" href="/auth/register">Регистрация</a>
                                <a class="dropdown-item" href="/auth/lostpassword">Забыли пароль</a>
                            </div>
                        </li>
                    {{else}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">{{$user_data->getLogin()}}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                {{if $user_data->getIsAdmin() == 1}}
                                    <a class="dropdown-item" href="/admin" target="_blank">Админ панель</a>
                                {{/if}}
                                <a class="dropdown-item" href="/cabinet">Кабинет</a>
                                <a class="dropdown-item" href="/auth/logout">Выйти</a>
                            </div>
                        </li>
                    {{/if}}
                </ul>
            </div>
        </nav>
    </div>
</div>