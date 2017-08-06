{{include file="_header.tpl"}}

{{include file="_menu.tpl"}}

<div class="container mt-5">

    <h2 class="mb-4">Личный кабинет</h2>

    <div class="row">
        <div class="hidden-sm-down col-md-3">
            {{include file="moduleView/users/block/_cabinet-menu.tpl"}}
        </div>
        <div class="col-md-9">
            <form action="/cabinet" method="POST">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card text-center">
                            <input type="hidden" name="avatar"{{if !empty($avatar)}} value="{{$avatar}}"{{/if}}>
                            <img class="card-img-top cabinet-avatar"
                                 src="{{if !empty($avatar)}}{{$avatar}}{{else}}/upload/default-avatar.png{{/if}}"
                                 alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">{{$user_data->getLogin()}}</h4>
                                <button class="btn btn-outline-info ajax-button">
                                    Загрузить<span class="hidden-md-down"> фото</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h4 class="mb-4">Личные данные</h4>

                        {{if !empty($error)}}
                            <div class="alert alert-danger">{{$error}}</div>
                        {{/if}}

                        {{if !empty($info)}}
                            <div class="alert alert-info">{{$info}}</div>
                        {{/if}}

                        <div class="input-group mb-3">
                            <span class="input-group-addon">Имя</span>
                            <input type="text" name="first_name" class="form-control" placeholder="Имя"
                                   {{if !empty($first_name)}}value="{{$first_name}}"{{/if}}>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-addon">Фамилия</span>
                            <input type="text" name="last_name" class="form-control" placeholder="Фамилия"
                                   {{if !empty($last_name)}}value="{{$last_name}}"{{/if}}>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-addon">Пол</span>
                            <select name="adult" class="custom-select">
                                <option value="male">Муржской</option>
                                <option value="female"{{if $adult == 'female'}} selected{{/if}}>Женский</option>
                            </select>
                        </div>
                        <div id="emailHelp" class="form-text text-muted">Дата в формате год-месяц-день (например 1990-12-24)</div>
                        <div class="input-group mb-3">
                            <span class="input-group-addon">Дата рождения</span>
                            <input type="text" name="date_birthday" id="datetimepicker" class="form-control"
                                   placeholder="Дата рождения"
                                   {{if !empty($date_birthday)}}value="{{$date_birthday}}"{{/if}}>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-addon">Телефон</span>
                            <input type="text" name="phone" class="form-control" placeholder="+380987654321"
                                   {{if !empty($phone)}}value="{{$phone}}"{{/if}}>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-addon">Город</span>
                            <input type="text" name="city" class="form-control" placeholder="Город"
                                   {{if !empty($city)}}value="{{$city}}"{{/if}}>
                        </div>
                        <div class="buttons">
                            <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

{{include file="_footer.tpl"}}