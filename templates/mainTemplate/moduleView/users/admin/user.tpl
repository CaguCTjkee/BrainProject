{{include file="moduleView/admin/_header.tpl"}}

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Resumator
                </a>
            </div>

            {{include file="moduleView/admin/_nav.tpl"}}
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="/admin">Главная</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="/">
                                <i class="ti-back-left"></i>
                                <p>На сайт</p>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/settings">
                                <i class="ti-settings"></i>
                                <p>Настройки</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">

                <h3>Редактировать пользователя {{$user.login}}</h3>

                {{if !empty($error)}}
                    <div class="alert alert-danger">{{$error}}</div>
                {{/if}}

                {{if !empty($info)}}
                    <div class="alert alert-info">{{$info}}</div>
                {{/if}}
                <form action="/admin/user/edit/{{$user.user_id}}" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="avatar text-center">
                                <p>
                                    <input type="hidden" name="avatar" value="{{if !empty($user_info.avatar)}}{{$user_info.avatar}}{{else}}/upload/default-avatar.png{{/if}}">
                                    <img src="{{if !empty($user_info.avatar)}}{{$user_info.avatar}}{{else}}/upload/default-avatar.png{{/if}}" alt="{{$user.login}}" style="max-width: 100%"
                                         class="cabinet-avatar">
                                </p>
                                <button class="btn btn-outline-info ajax-button" type="button">
                                    Загрузить<span class="hidden-md-down"> фото</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-9">

                            <h4>Основное</h4>

                            <div class="input-group mb-3">
                                <span class="input-group-addon">Логин</span>
                                <input type="text" name="login" class="form-control" placeholder="Имя"
                                       {{if !empty($user.login)}}value="{{$user.login}}"{{/if}}>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-addon">Почта</span>
                                <input type="text" name="mail" class="form-control" placeholder="Имя"
                                       {{if !empty($user.mail)}}value="{{$user.mail}}"{{/if}}>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-addon">Пароль</span>
                                <input type="text" name="pass" class="form-control"
                                       placeholder="Не заполнять, если не нужно сменить">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_admin" value="1"
                                           {{if $user.is_admin == 1}}checked{{/if}}>
                                    Админ
                                </label>
                            </div>

                            <h4>Личные данные</h4>

                            <div class="input-group mb-3">
                                <span class="input-group-addon">Имя</span>
                                <input type="text" name="first_name" class="form-control" placeholder="Имя"
                                       {{if !empty($user_info.first_name)}}value="{{$user_info.first_name}}"{{/if}}>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-addon">Фамилия</span>
                                <input type="text" name="last_name" class="form-control" placeholder="Фамилия"
                                       {{if !empty($user_info.last_name)}}value="{{$user_info.last_name}}"{{/if}}>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-addon">Пол</span>
                                <select name="adult" class="custom-select">
                                    <option value="male">Муржской</option>
                                    <option value="female"{{if $user_info.adult == 'female'}} selected{{/if}}>Женский
                                    </option>
                                </select>
                            </div>
                            <div id="emailHelp" class="form-text text-muted">Дата в формате год-месяц-день (например
                                1990-12-24)
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-addon">Дата рождения</span>
                                <input type="text" name="date_birthday" id="datetimepicker" class="form-control"
                                       placeholder="Дата рождения"
                                       {{if !empty($user_info.date_birthday)}}value="{{$user_info.date_birthday}}"{{/if}}>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-addon">Телефон</span>
                                <input type="text" name="phone" class="form-control" placeholder="+380987654321"
                                       {{if !empty($user_info.phone)}}value="{{$user_info.phone}}"{{/if}}>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-addon">Город</span>
                                <input type="text" name="city" class="form-control" placeholder="Город"
                                       {{if !empty($user_info.city)}}value="{{$user_info.city}}"{{/if}}>
                            </div>
                        </div>
                    </div>


                    <div class="buttons">
                        <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                    </div>
                </form>

            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                    , theme made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative
                        Tim</a>
                </div>
            </div>
        </footer>

    </div>
</div>

{{include file="moduleView/admin/_footer.tpl"}}