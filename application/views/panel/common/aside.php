<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <aside class="aside">
          <div class="box">
            <div class="box-header">
              <img src="<?php echo base_url('dist/img/member.png'); ?>" alt="Member" class="avatar">
              <div class="member-info">
                <span><?php echo $member->name; ?></span>
                <span><?php echo $member->marker; ?></span>
              </div>
            </div>
            <div class="box-body">
              <ul class="menu">
                <li>
                  <a href="<?php echo base_url('panel/dashboard'); ?>" target="_self">
                    <i class="icon-line icon-speedometer" aria-hidden="true"></i>
                    <span>داشبورد</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('panel/complaint'); ?>" target="_self">
                    <i class="icon-line icon-magnifier" aria-hidden="true"></i>
                    <span>استعلام</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('panel/complaint/list'); ?>" target="_self">
                    <i class="icon-line icon-doc" aria-hidden="true"></i>
                    <span>لیست تخلف ها</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('panel/complaint/create'); ?>" target="_self">
                    <i class="icon-line icon-user-follow" aria-hidden="true"></i>
                    <span>گزارش تخلف</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('panel/token'); ?>" target="_self">
                    <i class="icon-line icon-key" aria-hidden="true"></i>
                    <span>توکن ها</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('panel/password'); ?>" target="_self">
                    <i class="icon-line icon-lock" aria-hidden="true"></i>
                    <span>تغییر کلمه عبور</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('panel/feedback'); ?>" target="_self">
                    <i class="icon-line icon-speech" aria-hidden="true"></i>
                    <span>ارسال فیدبک</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('panel/logout'); ?>" target="_self">
                    <i class="icon-line icon-power" aria-hidden="true"></i>
                    <span>خروج</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </aside>
