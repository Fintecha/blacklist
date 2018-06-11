<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <section class="section">
          <div class="panel">
            <div class="panel-header">
              <h1>توکن ها</h1>
            </div>
            <div class="panel-body">
					  	<?php if (isset($alert) && $alert): ?>
              <div class="alert bg-<?php echo $alert['class']; ?>">
                <p><i class="icon-line icon-<?php echo $alert['icon']; ?>" aria-hidden="true"></i> <?php echo $alert['message']; ?></p>
              </div>
              <?php endif; ?>
							<?php if ($token): ?>
              <div class="content">
                <div class="table">
                  <div class="head">
                    <div class="cell">
								  		<span>کد توکن</span>
                    </div>
                    <div class="cell">
                      <span>IP سرور</span>
                    </div>
                    <div class="cell">
                      <span>تاریخ ایجاد</span>
                    </div>
                    <div class="cell">
                      <span>وضعیت</span>
                    </div>
                  </div>
                  <?php foreach ($token as $token): ?>
                  <div class="row">
                    <div class="cell ltr">
                      <span><?php echo $token->token; ?></span>
                    </div>
                    <div class="cell ltr">
                      <span><?php echo $token->server; ?></span>
                    </div>
                    <div class="cell ltr">
                      <span><?php echo fanum(shamsi($token->created)); ?></span>
                    </div>
                    <div class="cell">
                      <div class="badge badge-<?php echo token_status($token->status, 'class'); ?>">
                        <i class="icon-line icon-<?php echo token_status($token->status, 'icon'); ?>" aria-hidden="true"></i>
                        <span><?php echo token_status($token->status, 'value'); ?></span>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php else: ?>
              <div class="no-content">
                <i class="icon-line icon-info" aria-hidden="true"></i>
                <p>هیچ توکنی برای شما ایجاد نشده است</p>
              </div>
              <?php endif; ?>
            </div>
            <div class="panel-footer"></div>
          </div>
        </section>