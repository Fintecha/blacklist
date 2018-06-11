<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <section class="section">
          <div class="panel">
            <div class="panel-header">
              <h1>استعلام</h1>
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
			              <div class="field-half">
			                <label for="nid" class="label">کد ملی</label>
			                <input id="nid" name="nid" type="text" value="<?php echo set_value('nid'); ?>" class="input ltr" />
			                <?php echo form_error('nid', '<span class="wrong">', '</span>'); ?>
			              </div>
			              <div class="field-half">
			                <label for="mobile" class="label">شماره موبایل</label>
			                <input id="mobile" name="mobile" type="text" value="<?php echo set_value('mobile'); ?>" class="input ltr" />
			                <?php echo form_error('mobile', '<span class="wrong">', '</span>'); ?>
			              </div>
			            </div>
			            <div class="form-field">
			              <label for="domain" class="label">آدرس اینترنتی</label>
			              <input id="domain" name="domain" type="text" value="<?php echo set_value('domain'); ?>" class="input ltr" />
			              <?php echo form_error('domain', '<span class="wrong">', '</span>'); ?>
			            </div>
			            <div class="form-field">
			              <button id="submit" name="submit" type="submit" class="button bg-info">
			                <i class="icon-line icon-magnifier" aria-hidden="true"></i> استعلام
			              </button>
			            </div>
                </form>
              </div>
            </div>
            <div class="panel-footer"></div>
          </div>
        </section>