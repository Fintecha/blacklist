<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <section class="section">
          <div class="panel">
            <div class="panel-header">
              <h1>گزارش تخلف</h1>
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
									  	<label for="name" class="label">نام پذیرنده <sup class="txt-danger">اجباری</sup></label>
			                <input id="name" name="name" type="text" value="<?php echo set_value('name'); ?>" class="input" />
			                <span class="help">نام و نام خانوادگی و یا نام شرکت.</span>
			                <?php echo form_error('name', '<span class="wrong">', '</span>'); ?>
			              </div>
			              <div class="field-half">
			                <label for="nid" class="label">کد ملی <sup class="txt-danger">اجباری</sup></label>
			                <input id="nid" name="nid" type="text" value="<?php echo set_value('nid'); ?>" class="input ltr" />
			                <span class="help">کد ملی باید ۱۰ رقم و معتبر وارد شود.</span>
			                <?php echo form_error('nid', '<span class="wrong">', '</span>'); ?>
			              </div>
			            </div>
			            <div class="form-field">
			              <div class="field-half">
			                <label for="mobile" class="label">شماره موبایل</label>
			                <input id="mobile" name="mobile" type="text" value="<?php echo set_value('mobile'); ?>" class="input ltr" />
			                <?php echo form_error('mobile', '<span class="wrong">', '</span>'); ?>
			              </div>
			              <div class="field-half">
			                <label for="domain" class="label">آدرس اینترنتی</label>
			                <input id="domain" name="domain" type="text" value="<?php echo set_value('domain'); ?>" class="input ltr" />
			                <?php echo form_error('domain', '<span class="wrong">', '</span>'); ?>
			              </div>
									</div>
			            <div class="form-field">
			              <div class="field-half">
			                <label for="reason" class="label">نوع تخلف <sup class="txt-danger">اجباری</sup></label>
			                <select id="reason" name="reason" class="select">
			                  <option value="" <?php echo set_select('reason', FALSE, TRUE); ?>>لطفا انتخاب کنید...</option>
												<?php foreach($reason as $reason): ?>
												<option value="<?php echo $reason->bit; ?>" <?php echo set_select('reason', $reason->bit); ?>><?php echo $reason->name; ?></option>
												<?php endforeach; ?>
			                </select>
			                <?php echo form_error('reason', '<span class="wrong">', '</span>'); ?>
			              </div>
			              <div class="field-half">
			                <label for="date" class="label">تاریخ انجام تخلف</label>
			                <input id="date" name="date" type="text" value="<?php echo set_value('date'); ?>" class="input picker ltr" />
			                <span class="help">تاریخ باید شمسی و مطابق با الگو YYYY/MM/DD باشد.</span>
			                <?php echo form_error('date', '<span class="wrong">', '</span>'); ?>
			              </div>
									</div>
			            <div class="form-field">
			              <button id="submit" name="submit" type="submit" class="button bg-info">
			                <i class="icon-line icon-plus" aria-hidden="true"></i> ثبت گزارش
			              </button>
			            </div>
                </form>
              </div>
            </div>
            <div class="panel-footer"></div>
          </div>
        </section>