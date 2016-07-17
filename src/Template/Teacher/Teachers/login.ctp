<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void()"><b>Schools-Club</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?= $this->Flash->render() ?>
        <?= $this->Form->create() ?>
        <div class="form-group has-feedback">
            <?= $this->Form->input('email', ['class' => 'form-control', 'div' => false, 'label' => FALSE, 'placeholder' => 'Email']) ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $this->Form->input('password', ['class' => 'form-control', 'div' => false, 'label' => FALSE, 'placeholder' => 'Password']) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <?= $this->Form->input('remember', ['type' => 'checkbox', 'div' => false, 'label' => false]) ?> Remember Me
                    </label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign-In</button>
                <?= $this->Form->end() ?>
            </div><!-- /.col -->
        </div>
        </form>
        <a href="/teacher/teachers/forget-password">I forgot my password</a><br>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
