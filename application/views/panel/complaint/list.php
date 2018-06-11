<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <section class="section">
          <div class="panel">
            <div class="panel-header">
              <h1>لیست تخلف ها</h1>
            </div>
            <div class="panel-body">
				  		<?php if (isset($alert) && $alert): ?>
              <div class="alert bg-<?php echo $alert['class']; ?>">
                <p><i class="icon-line icon-<?php echo $alert['icon']; ?>" aria-hidden="true"></i> <?php echo $alert['message']; ?></p>
              </div>
              <?php endif; ?>
							<?php if ($complaint): ?>
              <div class="content">
                <div class="table">
                  <div class="head">
                    <div class="cell">
								  		<span>نام پذیرنده</span>
                    </div>
                    <div class="cell">
                      <span>کد ملی</span>
                    </div>
                    <div class="cell">
                      <span>شماره موبایل</span>
                    </div>
                    <div class="cell">
                      <span>آدرس اینترنتی</span>
                    </div>
                    <div class="cell">
                      <span>تخلف ها</span>
                    </div>
                    <div class="cell">
                      <span>ریسک</span>
                    </div>
                    <div class="cell">
                      <span>ثبت کننده</span>
                    </div>
                    <div class="cell">
                      <!-- NULL -->
                    </div>
                  </div>
                  <?php foreach ($complaint as $complaint): ?>
                  <div class="row">
                    <div class="cell">
                      <span><?php echo $complaint->name; ?></span>
                    </div>
                    <div class="cell ltr">
                      <span><?php echo fanum($complaint->nid); ?></span>
                    </div>
                    <div class="cell ltr">
                      <span><?php echo isset($complaint->mobile) ? fanum($complaint->mobile) : '-'; ?></span>
                    </div>
                    <div class="cell ltr">
                      <?php if (isset($complaint->domain)): ?>
                      <a href="<?php echo $complaint->domain; ?>" target="_blank">
                        <span><?php echo $complaint->domain; ?></span>
                      </a>
                      <?php else : ?>
                      <span>-</span>
                      <?php endif; ?>
                    </div>
                    <div class="cell ltr">
                      <span><?php echo fanum($complaint->count); ?></span>
                    </div>
                    <div class="cell ltr">
                      <span><?php echo fanum($complaint->risk); ?></span>
                    </div>
                    <div class="cell ltr">
                      <span><?php echo $complaint->issuer; ?></span>
                    </div>
                    <div class="cell">
                      <a href="javascript:void()" target="_self" class="button btn-small bg-success click">
                        <i class="icon-line icon-eye" aria-hidden="true"></i>
                        <div class="detail">
                          <div class="list">
                            <div class="line">
                              <div class="col">
                                <span>کد ملی</span>
                              </div>
                              <div class="col ltr">
                                <span><?php echo fanum($complaint->nid); ?></span>
                              </div>
                            </div>
                            <div class="line">
                              <div class="col">
                                <span>عنوان تخلف</span>
                              </div>
                              <div class="col ltr">
                                <span><?php echo $complaint->reason; ?></span>
                              </div>
                            </div>
                            <div class="line">
                              <div class="col">
                                <span>امتیاز منفی</span>
                              </div>
                              <div class="col ltr">
                                <span class="txt-danger"><?php echo fanum($complaint->point); ?></span>
                              </div>
                            </div>
                            <div class="line">
                              <div class="col">
                                <span>تاریخ انجام تخلف</span>
                              </div>
                              <div class="col ltr">
                                <span><?php echo isset($complaint->date) ? fanum($complaint->date) : '-'; ?></span>
                              </div>
                            </div>
                            <div class="line">
                              <div class="col">
                                <span>تاریخ ایجاد</span>
                              </div>
                              <div class="col ltr">
                                <span><?php echo fanum(shamsi($complaint->created)); ?></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php else: ?>
              <div class="no-content">
                <i class="icon-line icon-info" aria-hidden="true"></i>
                <p>هیچ گزارشی یافت نشد</p>
              </div>
              <?php endif; ?>
            </div>
            <div class="panel-footer"></div>
          </div>
        </section>