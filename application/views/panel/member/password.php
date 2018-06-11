<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <section class="section">
          <div class="panel">
            <div class="panel-header">
              <h1>تغییر کلمه عبور</h1>
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
			              <label for="current" class="label">کلمه عبور فعلی</label>
			              <input id="current" name="current" type="password" class="input ltr" />
			              <?php echo form_error('current', '<span class="wrong">', '</span>'); ?>
			            </div>
			            <div class="form-field">
			              <label for="password" class="label">کلمه عبور جدید</label>
			              <input id="password" name="password" type="password" class="input ltr" />
			              <?php echo form_error('password', '<span class="wrong">', '</span>'); ?>
			            </div>
			            <div class="form-field">
			              <label for="confirm" class="label">تکرار کلمه عبور جدید</label>
			              <input id="confirm" name="confirm" type="password" class="input ltr" />
			              <?php echo form_error('confirm', '<span class="wrong">', '</span>'); ?>
						    	</div>
					     		<div class="form-field">
			              <button id="submit" name="submit" type="submit" class="button bg-info">
			                <i class="icon-line icon-pencil" aria-hidden="true"></i> تغییر کلمه عبور
			              </button>
						      	<a href="<?php echo base_url('panel'); ?>" target="_self" class="button bg-danger">
							        <i class="icon-line icon-action-undo" aria-hidden="true"></i>
								      <span>برگشت</span>
								    </a>
                  </div>
                </form>
              </div>
            </div>
            <div class="panel-footer"></div>
          </div>
        </section>
