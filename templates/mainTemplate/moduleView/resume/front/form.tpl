{{include file="_header.tpl"}}

{{include file="_menu.tpl"}}

<div class="container main-content">
    <div class="row">
        <div class="col-12 col-sm-8 mx-auto">
            <div class="h2 mt-4 mb-4 text-center">
                {{if !empty($resume)}}
                    Редактировать
                {{else}}
                    Добавить
                {{/if}}
                резюме
            </div>

            {{if !empty($error)}}
                <div class="alert alert-danger">{{$error}}</div>
            {{/if}}

            {{if !empty($info)}}
                <div class="alert alert-info">{{$info}}</div>
            {{/if}}

            <form method="POST" action="{{if !empty($resume)}}
                    /resume/edit/{{$resume.resume_id}}
                {{else}}
                    /resume/add
                {{/if}}">
                <div class="form-group">
                    <div class="mb-3">
                        <label>Желаемая должность</label>
                        <input type="text" name="position" class="form-control"
                               {{if !empty($smarty.post.position) && empty($resume)}}value="{{$smarty.post.position}}"{{/if}}
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
                                  class="form-control">{{if !empty($smarty.post.skills) && empty($resume)}}{{$smarty.post.skills}}{{/if}}{{if !empty($resume.skills)}}{{$resume.skills}}{{/if}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Зарплата за месяц</label>
                        <input type="text" name="salary" class="form-control"
                               {{if !empty($smarty.post.salary) && empty($resume) && empty($resume)}}value="{{$smarty.post.salary}}"{{/if}}
                                {{if !empty($resume.salary)}}value="{{$resume.salary}}"{{/if}}>
                    </div>
                    <div class="mb-5">
                        <label>Телефон</label>
                        <input type="text" name="phone" class="form-control"
                               {{if !empty($phone) && empty($smarty.post.position) && empty($resume)}}value="{{$phone}}"{{/if}}
                                {{if !empty($smarty.post.phone) && empty($resume)}}value="{{$smarty.post.phone}}"{{/if}}
                                {{if !empty($resume.phone)}}value="{{$resume.phone}}"{{/if}}>
                    </div>
                    <div class="mb-5">
                        <label>Доп. контакты ( Skype, Портфолио, Соц. сети)</label>
                        <textarea name="contacts"
                                  class="form-control">{{if !empty($smarty.post.contacts) && empty($resume)}}{{$smarty.post.contacts}}{{/if}}{{if !empty($resume.contacts)}}{{$resume.contacts}}{{/if}}</textarea>
                    </div>
                    <div class="mb-5 block-parent">
                        <div class="pull-right">
                            <button class="btn btn-info add-block">
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                            </button>
                        </div>
                        <h3 class="mb-3">Опыт работы</h3>
                        {{if !empty($experience)}}
                            {{foreach from=$experience item="exp" name=experience}}
                                <div class="block-content mb-3">
                                    {{include file="moduleView/resume/block/experience.tpl"}}
                                    <button class="btn btn-danger remove-block {{if $smarty.foreach.experience.first}}hidden{{/if}}">
                                        Удалить
                                    </button>
                                </div>
                            {{/foreach}}
                        {{else}}
                            <div class="block-content mb-3">
                                {{include file="moduleView/resume/block/experience.tpl"}}
                                <button class="btn btn-danger remove-block hidden">
                                    Удалить
                                </button>
                            </div>
                        {{/if}}
                    </div>
                    <div class="mb-5 block-parent">
                        <div class="pull-right">
                            <button class="btn btn-info add-block">
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                            </button>
                        </div>
                        <h3 class="mb-3">Образование</h3>
                        {{if !empty($education)}}
                            {{foreach from=$education item="edu" name=education}}
                                <div class="block-content mb-3">
                                    {{include file="moduleView/resume/block/education.tpl"}}
                                    <button class="btn btn-danger remove-block {{if $smarty.foreach.education.first}}hidden{{/if}}">
                                        Удалить
                                    </button>
                                </div>
                            {{/foreach}}
                        {{else}}
                            <div class="block-content mb-3">
                                {{include file="moduleView/resume/block/education.tpl"}}
                                <button class="btn btn-danger remove-block hidden">
                                    Удалить
                                </button>
                            </div>
                        {{/if}}
                    </div>
                    <div class="mb-3">
                        <label>
                            Дополнительная информация (владение языками, курсы, тренинги, сертификаты)
                        </label>
                        <textarea name="additional" class="form-control"
                                  rows="7">{{if !empty($smarty.post.additional) && empty($resume)}}{{$smarty.post.additional}}{{/if}}{{if !empty($resume.additional)}}{{$resume.additional}}{{/if}}</textarea>
                    </div>
                    <button class="btn btn-success" type="submit">{{if !empty($resume)}}
                            Редактировать
                        {{else}}
                            Добавить
                        {{/if}}</button>
                    <a href="/resume/delete/{{$resume.resume_id}}" class="btn btn-danger float-right">Удалить</a>
                </div>
            </form>

        </div>
    </div>
</div>

{{include file="_footer.tpl"}}