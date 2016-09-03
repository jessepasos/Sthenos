<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog modal-sm" id="custom_Size" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="/show_tell/login">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="email@example.com" name="email" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LeI0SgTAAAAAIgXWodkRM557GKlQb52tGol_64h" style="width: 255px;"></div>
                        </div>
                        <input class="btn btn btn-primary btn-block" type="submit" name="action" value="Login">
                    </fieldset>

                    <div class="login-or">
                        <hr class="hr-or">
                        <span class="span-or">or</span>
                    </div>
                    <input class="btn btn btn-success btn-block" type="submit" name="action" value="Register">
                </form>
            </div>
        </div>
    </div>
</div>
