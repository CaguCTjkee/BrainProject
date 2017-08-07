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

                <h3>Резюме "{{$resume.position}}"</h3>

                <form method="POST" action="/admin/resume/edit/{{$resume.resume_id}}">
                    <div class="form-group">
                        <div class="mb-3">
                            <label>Желаемая должность</label>
                            <input type="text" name="position" class="form-control"
                                   {{if !empty($smarty.post.position)}}value="{{$smarty.post.position}}"{{/if}}
                                    {{if !empty($resume.position)}}value="{{$resume.position}}"{{/if}}>
                        </div>
                        <div class="mb-3">
                            <label>Рубрика</label>
                            <select name="category_id" class="custom-select w-100">
                                {{foreach from=$categories item=category}}
                                    <option value="{{$category.category_id}}"
                                            {{if !empty($resume.category_id) && $resume.category_id == $category.category_id}}
                                                selected
                                            {{/if}}
                                    >{{$category.name}}</option>
                                {{/foreach}}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Навыки</label>
                            <textarea name="skills"
                                      class="form-control">{{if !empty($smarty.post.skills) && empty($resume.skills)}}{{$smarty.post.skills}}{{/if}}{{if !empty($resume.skills)}}{{$resume.skills}}{{/if}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Зарплата за месяц</label>
                            <input type="text" name="salary" class="form-control"
                                   {{if !empty($smarty.post.salary)}}value="{{$smarty.post.salary}}"{{/if}}
                                    {{if !empty($resume.salary)}}value="{{$resume.salary}}"{{/if}}>
                        </div>
                        <div class="mb-5">
                            <label>Телефон</label>
                            <input type="text" name="phone" class="form-control"
                                   {{if !empty($phone) && empty($smarty.post.position)}}value="{{$phone}}"{{/if}}
                                    {{if !empty($smarty.post.phone)}}value="{{$smarty.post.phone}}"{{/if}}
                                    {{if !empty($resume.phone)}}value="{{$resume.phone}}"{{/if}}>
                        </div>
                        <div class="mb-5">
                            <label>Доп. контакты ( Skype, Портфолио, Соц. сети)</label>
                            <textarea name="contacts"
                                      class="form-control">{{if !empty($smarty.post.contacts) && empty($resume.contacts)}}{{$smarty.post.contacts}}{{/if}}{{if !empty($resume.contacts)}}{{$resume.contacts}}{{/if}}</textarea>
                        </div>
                        <div class="mb-5 block-parent">
                            <div class="pull-right">
                                <button class="btn btn-info add-block">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </button>
                            </div>
                            <h3 class="mb-3">Опыт работы</h3>
                            {{foreach from=$experience item="exp" name=experience}}
                                <div class="block-content mb-3">
                                    {{include file="moduleView/resume/admin/experience.tpl"}}
                                    <button class="btn btn-danger remove-block {{if $smarty.foreach.experience.first}}hidden{{/if}}">
                                        Удалить
                                    </button>
                                </div>
                                {{foreachelse}}
                                <div class="block-content mb-3">
                                    {{include file="moduleView/resume/admin/experience.tpl"}}
                                    <button class="btn btn-danger remove-block hidden">
                                        Удалить
                                    </button>
                                </div>
                            {{/foreach}}
                        </div>
                        <div class="mb-5 block-parent">
                            <div class="pull-right">
                                <button class="btn btn-info add-block">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </button>
                            </div>
                            <h3 class="mb-3">Образование</h3>
                            {{foreach from=$education item="edu" name=education}}
                                <div class="block-content mb-3">
                                    {{include file="moduleView/resume/admin/education.tpl"}}
                                    <button class="btn btn-danger remove-block {{if $smarty.foreach.education.first}}hidden{{/if}}">
                                        Удалить
                                    </button>
                                </div>
                                {{foreachelse}}
                                <div class="block-content mb-3">
                                    {{include file="moduleView/resume/admin/education.tpl"}}
                                    <button class="btn btn-danger remove-block hidden">
                                        Удалить
                                    </button>
                                </div>
                            {{/foreach}}
                        </div>
                        <div class="mb-3">
                            <label>
                                Дополнительная информация (владение языками, курсы, тренинги, сертификаты)
                            </label>
                            <textarea name="additional" class="form-control"
                                      rows="7">{{if !empty($smarty.post.additional) && empty($resume.additional)}}{{$smarty.post.additional}}{{/if}}{{if !empty($resume.additional)}}{{$resume.additional}}{{/if}}</textarea>
                        </div>
                        <button class="btn btn-success" type="submit">Редактировать</button>
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