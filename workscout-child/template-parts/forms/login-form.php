<?php if ( !is_user_logged_in() ): ?>
<form id="fc-login-form">
  <div class="row">
    <div class="email-wrap">
      <label for="login_email">E-mail <span class="required">*</span></label>
      <input type="text" name="login_email" id="login-email" />
    </div>
    <div class="password-wrap">
      <label for="login_password">Password <span class="required">*</span></label>
      <input type="password" name="login_password" id="login-password" />
    </div>
    <input class="btn btn-login" type="submit" value="Sign In">
  </div>

  <div class="notification error reg-form-output closeable" style="display: none; margin-top: 20px; margin-bottom: 0px;">
    <p></p>
</div>

</form>
<?php endif; ?>
