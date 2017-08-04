{{include file="_header.tpl"}}

{{include file="_menu.tpl"}}

<div class="container main-content">
    <div class="row">
        <div class="col-12 col-sm-8 mx-auto">
            <div class="h2 mt-4 mb-4 text-center">Добавить резюме</div>

            {{if !empty($error)}}
                <div class="alert alert-danger">{{$error}}</div>
            {{/if}}

            {{if !empty($info)}}
                <div class="alert alert-info">{{$info}}</div>
            {{/if}}

            <form method="POST" action="/resume/add">
                <div class="form-group">
                    <div class="mb-3">
                        <label>Желаемая должность</label>
                        <input type="text" name="position" class="form-control"
                               {{if !empty($smarty.post.login)}}value="{{$smarty.post.login}}"{{/if}}>
                    </div>
                    <div class="mb-3">
                        <label>Рубрика</label>
                        <select name="category_id" class="custom-select w-100">
                            {{foreach from=$categories item=category}}
                                <option value="{{$category.id}}">{{$category.name}}</option>
                            {{/foreach}}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Навыки</label>
                        <textarea name="skills" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Зарплата за месяц</label>
                        <input type="text" name="salary" class="form-control">
                    </div>
                    <div class="mb-5">
                        <label>Телефон</label>
                        <input type="text" name="phone" class="form-control"
                               {{if !empty($phone)}}value="{{$phone}}"{{/if}}>
                    </div>
                    <div class="mb-5">
                        <label>Доп. контакты ( Skype, Портфолио, Соц. сети)</label>
                        <textarea name="contacts" class="form-control"></textarea>
                    </div>
                    <div class="mb-5 block-parent">
                        <div class="pull-right">
                            <button class="btn btn-info add-block">
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                            </button>
                        </div>
                        <h3 class="mb-3">Опыт работы</h3>
                        <div class="block-content mb-3">
                            {{include file="moduleView/resume/block/experience.tpl"}}
                            <button class="btn btn-danger remove-block hidden">
                                Удалить
                            </button>
                        </div>
                    </div>
                    <div class="mb-5 block-parent">
                        <div class="pull-right">
                            <button class="btn btn-info add-block">
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                            </button>
                        </div>
                        <h3 class="mb-3">Образование</h3>
                        <div class="block-content mb-3">
                            {{include file="moduleView/resume/block/education.tpl"}}
                            <button class="btn btn-danger remove-block hidden">
                                Удалить
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>
                            Дополнительная информация (вледение языками, курсы, тренинги, сертификаты)
                        </label>
                        <textarea name="additional" class="form-control" rows="7"></textarea>
                    </div>
                    <button class="btn btn-success" type="submit">Добавить</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{include file="_footer.tpl"}}