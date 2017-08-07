{{include file="_header.tpl"}}

{{include file="_menu.tpl"}}

<div class="container main-content">
    <div class="row">
        <div class="col-12">
            <div class="h2 mt-4 mb-4 text-center">
                Ваше резюме "{{$resume.position}}"
                {{if $user_data->getUserId() == $resume.user_id}}
                    <a href="/resume/edit/{{$resume.resume_id}}" target="_blank">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                {{/if}}
            </div>

            <div class="cart row">
                <div class="col-md-3">
                    <img src="{{$user_info.avatar}}" alt="{{$user_data->getLogin()}}" class="resume-avatar">
                </div>
                <div class="col-md-9">

                    <h4 class="mb-4">Основная информация</h4>

                    {{if !empty($user_info.first_name) || !empty($user_info.last_name)}}
                        <p><strong>Имя:</strong> {{$user_info.first_name}} {{$user_info.last_name}}</p>
                        <hr>
                    {{/if}}

                    {{if !empty($user_info.adult)}}
                        <p>
                            <strong>Пол:</strong>
                            {{if $user_info.adult == 'male'}}
                                Мужской
                            {{else}}
                                Женский
                            {{/if}}
                        </p>
                        <hr>
                    {{/if}}

                    {{if !empty($user_info.date_birthday)}}
                        <p><strong>День рождения:</strong> {{$user_info.date_birthday}}</p>
                        <hr>
                    {{/if}}

                    {{if !empty($user_info.city)}}
                        <p><strong>Город:</strong> {{$user_info.city}}</p>
                        <hr>
                    {{/if}}

                    {{if !empty($resume.phone)}}
                        <p>
                            <strong>Контактный телефон:</strong>
                            {{$resume.phone}}
                        </p>
                        <hr>
                    {{/if}}

                    {{if !empty($resume.contacts)}}
                        <p>
                        <div><strong>Дополнительные контакты:</strong></div>
                        {{$resume.contacts|nl2br}}
                        </p>
                        <hr>
                    {{/if}}

                </div>
            </div>

            {{if $experience}}
                <h4 class="mb-4">Опыт работы</h4>
                {{foreach from=$experience item='exp'}}

                    {{if !empty($exp.name_company)}}
                        <p>
                            <strong>Название компании:</strong> {{$exp.name_company}}
                        </p>
                    {{/if}}

                    {{if !empty($exp.position)}}
                        <p>
                            <strong>Должность:</strong> {{$exp.position}}
                        </p>
                    {{/if}}

                    {{if !empty($exp.date_start)}}
                        <p>
                            <strong>Период работы:</strong>
                            c {{$exp.date_start}} по
                            {{if $exp.present_time == 1}}
                                настоящее время
                            {{else}}
                                {{$exp.date_end}}
                            {{/if}}
                        </p>
                    {{/if}}

                {{/foreach}}
            {{/if}}

            {{if $education}}
                <h4 class="mb-4">Образование</h4>
                {{foreach from=$education item='edu'}}

                    {{if !empty($edu.level)}}
                        <p>
                            <strong>Уровень образования:</strong>
                            {{if $edu.level = 1}}
                                высшее
                            {{elseif $edu.level = 2}}
                                неоконченное высшее
                            {{elseif $edu.level = 3}}
                                средне-специальное
                            {{elseif $edu.level = 4}}
                                среднее
                            {{/if}}
                        </p>
                    {{/if}}

                    {{if !empty($edu.school)}}
                        <p>
                            <strong>Название вуза:</strong> {{$edu.school}}
                        </p>
                    {{/if}}

                    {{if !empty($edu.city)}}
                        <p>
                            <strong>Город:</strong> {{$edu.city}}
                        </p>
                    {{/if}}

                    {{if !empty($edu.speciality)}}
                        <p>
                            <strong>Факультет, Специальность:</strong> {{$edu.speciality}}
                        </p>
                    {{/if}}

                    {{if !empty($edu.year)}}
                        <p>
                            <strong>Год окончания:</strong> {{$edu.year}}
                        </p>
                    {{/if}}

                {{/foreach}}
            {{/if}}


            <h4 class="mb-4">Дополнительная информация</h4>

            {{if !empty($resume.skills)}}
                <p>
                <div><strong>Навыки:</strong></div>
                {{$resume.skills|nl2br}}
                </p>
            {{/if}}

            {{if !empty($resume.salary)}}
                <p>
                    <strong>Желаемая зарплата:</strong> {{$resume.salary}}
                </p>
            {{/if}}

            {{if !empty($resume.additional)}}
                <p>
                <div><strong>Владение языками, курсы, тренинги, сертификаты:</strong></div>
                {{$resume.additional}}
                </p>
            {{/if}}


        </div>
    </div>
</div>

{{include file="_footer.tpl"}}