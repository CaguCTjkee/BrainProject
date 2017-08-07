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

                <h3>Пользователи</h3>

                <table class="table table-striped">
                    <thead>
                    <tr class="info">
                        <td class="text-center">ID</td>
                        <td class="text-center">Логин</td>
                        <td class="text-center">Почта</td>
                        <td class="text-center">Дата регистрации</td>
                        <td class="text-center">Дата входа</td>
                        <td class="text-center">Администратор</td>
                        <td class="text-center">Действия</td>
                    </tr>
                    </thead>
                    <tbody>
                    {{foreach from=$list item="user"}}
                        <tr>
                            <td class="text-center">{{$user.user_id}}</td>
                            <td class="text-center">{{$user.login}}</td>
                            <td class="text-center">{{$user.mail}}</td>
                            <td class="text-center">{{$user.date_register}}</td>
                            <td class="text-center">{{$user.date_last}}</td>
                            <td class="text-center">{{if $user.is_admin == 1}}Да{{else}}Нет{{/if}}</td>
                            <td class="text-center">
                                <a href="/admin/user/edit/{{$user.user_id}}"><i class="ti-pencil-alt"></i></a>
                                &nbsp;&nbsp;
                                <a href="/admin/user/delete/{{$user.user_id}}"><i class="ti-close"></i></a>
                            </td>
                        </tr>
                    {{/foreach}}
                    </tbody>
                </table>

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