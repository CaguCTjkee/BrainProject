{{include file="_header.tpl"}}

{{include file="_menu.tpl"}}

<div class="container main-content">
    <div class="row">
        <div class="col-12 col-sm-8 mx-auto">
            <div class="h2 mt-4 mb-4 text-center">Мои резюме</div>

            {{if !empty($list)}}
                <ul class="list-group">
                    {{foreach from=$list item=data}}
                        <li class="list-group-item">
                            <a href="/resume/view/{{$data.resume_id}}">{{$data.position}}</a>
                        </li>
                    {{/foreach}}
                </ul>
            {{else}}
                <div class="alert alert-info">У вас нет ниодного резюме, <a href="/resume/add">добавить</a>.</div>
            {{/if}}

        </div>
    </div>
</div>

{{include file="_footer.tpl"}}