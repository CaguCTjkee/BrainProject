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
                            <a href="/" class="dropdown-toggle" data-toggle="dropdown">
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

                <h3>
                    {{if !empty($category)}}
                        Редактировать
                    {{else}}
                        Добавить
                    {{/if}}
                    категорию</h3>

                <form {{if !empty($category)}}action="/admin/resume/editCategory/{{$category.category_id}}"
                      {{else}}action="/admin/resume/addCategory"{{/if}} method="post">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="name" class="form-control"
                               {{if !empty($smarty.post.name) && empty($category)}}value="{{$smarty.post.name}}"{{/if}}
                                {{if !empty($category.name)}}value="{{$category.name}}"{{/if}}>
                    </div>
                    <button class="btn btn-success" type="submit">
                        {{if !empty($category)}}
                            Редактировать
                        {{else}}
                            Добавить
                        {{/if}}
                    </button>
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