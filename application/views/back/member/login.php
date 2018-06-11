<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <section class="login">
          <div class="panel">
            <div class="panel-header">
              <h1>ورود به پنل</h1>
            </div>
            <div class="panel-body">
						<?php if (isset($alert) && $alert): ?>
              <div class="alert bg-<?php echo $alert['class']; ?>">
                <p><i class="icon-line icon-<?php echo $alert['icon']; ?>" aria-hidden="true"></i> <?php echo $alert['message']; ?></p>
              </div>
              <?php endif; ?>
              <div class="content">
			          <?php echo form_open(); ?>
							  	<div class="form-field">
			              <label for="username" class="label">نام کاربری</label>
			              <input id="username" name="username" type="text" value="<?php echo set_value('username'); ?>" class="input ltr" />
			              <?php echo form_error('username', '<span class="wrong">', '</span>'); ?>
			            </div>
			            <div class="form-field">
			              <label for="password" class="label">کلمه عبور</label>
			              <input id="password" name="password" type="password" value="<?php echo set_value('password'); ?>" class="input ltr" />
			              <?php echo form_error('password', '<span class="wrong">', '</span>'); ?>
			            </div>
			            <div class="form-field">
			              <button id="submit" name="submit" type="submit" title="ورود به پنل" class="button bg-info">
			                <i class="icon-line icon-login" aria-hidden="true"></i> ورود به پنل
			              </button>
			            </div>
                </form>
              </div>
            </div>
            <div class="panel-footer"></div>
          </div>
        </section>
