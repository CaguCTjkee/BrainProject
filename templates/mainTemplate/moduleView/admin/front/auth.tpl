{{include file="moduleView/admin/_header.tpl"}}

<div class="wrapper wrapper-full-page">
    <div class="full-page login-page">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">

                        {{if !empty($error)}}
                            <div class="alert alert-danger">{{$error}}</div>
                        {{/if}}

                        {{if \Modules\Users\Model\User::$is_login == false}}
                            <form method="POST" action="/admin">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="card-header">
                                        <h3 class="card-title">Login</h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="text" name="login" placeholder="Enter email"
                                                   class="form-control input-no-border">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="pass" placeholder="Password"
                                                   class="form-control input-no-border">
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-fill btn-wd ">Let's go</button>
                                        <div class="forgot">
                                            <a href="#pablo">Forgot your password?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        {{/if}}
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer footer-transparent">
            <div class="container">
                <div class="copyright">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                    , made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative
                        Tim</a>
                </div>
            </div>
        </footer>
    </div>
</div>

{{include file="moduleView/admin/_footer.tpl"}}