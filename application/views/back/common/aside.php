<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>        <aside class="aside">
          <div class="box">
            <div class="box-header">
              <img src="<?php echo base_url('dist/img/member.png'); ?>" alt="Member" title="<?php echo $member->name; ?>" class="avatar">
              <div class="member-info">
                <span><?php echo $member->name; ?></span>
                <span><?php echo $member->marker; ?></span>
              </div>
            </div>
            <div class="box-body">
              <ul class="menu">
                <li>
                  <a href="<?php echo base_url('back/dashboard'); ?>" target="_self" title="داشبورد">
                    <i class="icon-line icon-speedometer" aria-hidden="true"></i>
                    <span>داشبورد</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('back/complaint'); ?>" target="_self" title="تخلف ها">
                    <i class="icon-line icon-docs" aria-hidden="true"></i>
                    <span>تخلف ها</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('back/member'); ?>" target="_self" title="کاربران">
                    <i class="icon-line icon-user" aria-hidden="true"></i>
                    <span>کاربران</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('back/reason'); ?>" target="_self" title="دسته بندی ها">
                    <i class="icon-line icon-folder" aria-hidden="true"></i>
                    <span>دسته بندی ها</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('back/history'); ?>" target="_self" title="گزارش ها">
                    <i class="icon-line icon-pie-chart" aria-hidden="true"></i>
                    <span>گزارش ها</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('back/setting'); ?>" target="_self" title="تنظیمات">
                    <i class="icon-line icon-settings" aria-hidden="true"></i>
                    <span>تنظیمات</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo base_url('back/password'); ?>" target="_self" title="تغییر کلمه عبور">
                    <i class="icon-line icon-lock" aria-hidden="true"></i>
                    <span>تغییر کلمه عبور</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </aside>
