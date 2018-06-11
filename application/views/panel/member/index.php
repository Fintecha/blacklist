<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <section class="section">
          <div class="panel">
            <div class="panel-header">
              <h1>داشبورد</h1>
            </div>
            <div class="panel-body">
				  		<?php if (isset($alert) && $alert): ?>
              <div class="alert bg-<?php echo $alert['class']; ?>">
                <p><i class="icon-line icon-<?php echo $alert['icon']; ?>" aria-hidden="true"></i> <?php echo $alert['message']; ?></p>
              </div>
              <?php endif; ?>
              <div class="content">
                <div class="overview">
                  <div class="row">
                    <div class="cell">
                      <i class="icon-line icon-calender" aria-hidden="true"></i>
                      <span>تاریخ امروز</span>
                      <span dir="ltr"><?php echo fanum(shamsi($date)); ?></span>
                    </div>
                    <div class="cell">
										  <i class="icon-line icon-people" aria-hidden="true"></i>
									  	<span>تعداد گزارش ها</span>
                      <span dir="ltr"><?php echo fanum(number_format($complaint)); ?></span>
                    </div>
                    <div class="cell">
										  <i class="icon-line icon-magnifier" aria-hidden="true"></i>
									  	<span>تعداد استعلام ها</span>
                      <span dir="ltr"><?php echo fanum(number_format($inquiry)); ?></span>
                    </div>
                    <div class="cell">
										  <!-- NULL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-footer"></div>
          </div>
        </section>