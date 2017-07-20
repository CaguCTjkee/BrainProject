{{include file="_header.tpl"}}

{{include file="_menu.tpl"}}

<div class="container main-content">
    <div class="row">
        <div class="mx-auto col-md-6 col-lg-4">
            <div class="h2 mt-4 mb-4 text-center">Регистрация</div>

            {{if !empty($error)}}
                <div class="alert alert-danger">{{$error}}</div>
            {{/if}}

            {{if !empty($info)}}
                <div class="alert alert-info">{{$info}}</div>
            {{/if}}

            {{if empty($info)}}
                <form method="POST" action="/auth/register">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                            <input type="text" name="login" placeholder="Логин" class="form-control"
                                   {{if !empty($smarty.post.login)}}value="{{$smarty.post.login}}"{{/if}} required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                            <input type="email" name="mail" placeholder="Электронная почта" class="form-control"
                                   {{if !empty($smarty.post.email)}}value="{{$smarty.post.email}}"{{/if}} required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="pass" placeholder="Пароль" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock rotate90"></i></span>
                            <input type="password" name="pass_repeat" placeholder="Повтор пароля" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Регистрация</button>
                    </div>
                </form>
            {{/if}}
        </div>
    </div>
</div>

{{include file="_footer.tpl"}}