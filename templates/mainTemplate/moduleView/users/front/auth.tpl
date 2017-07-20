{{include file="_header.tpl"}}

{{include file="_menu.tpl"}}

<div class="container main-content">
    <div class="row">
        <div class="mx-auto col-md-6 col-lg-4">
            <div class="h2 mt-4 mb-4 text-center">Авторизация</div>

            {{if !empty($error)}}
                <div class="alert alert-danger">{{$error}}</div>
            {{/if}}

            {{if \Modules\Users\Model\User::$is_login == false}}
                <form method="POST" action="/auth/login">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                            <input type="text" name="login" placeholder="Логин" class="form-control"
                                   {{if !empty($smarty.post.login)}}value="{{$smarty.post.login}}"{{/if}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="pass" placeholder="Пароль" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Войти</button>
                        <a href="#pablo" class="btn float-right">Забыли пароль?</a>
                    </div>
                </form>
            {{/if}}
        </div>
    </div>
</div>

{{include file="_footer.tpl"}}