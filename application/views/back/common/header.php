<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html> 
<html lang="fa-ir">
  <head>
    <title>Back</title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
    <meta name="handheldfriendly" content="true" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge, chrome=1">

    <link rel="icon" type="image/x-icon" href="<?php echo base_url('dist/img/brand.png'); ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('dist/img/brand.png'); ?>">

    <link rel="stylesheet" media="screen, projection" type="text/css" href="<?php echo base_url('dist/css/main.css'); ?>" />
    <link rel="stylesheet" media="screen, projection" type="text/css" href="<?php echo base_url('dist/css/font.css'); ?>" />
    <link rel="stylesheet" media="screen, projection" type="text/css" href="<?php echo base_url('dist/css/datepicker.css'); ?>" />
  </head>
  <body id="lang-fa">
    <header class="header">
      <div class="wrapper">
        <div class="brand">
          <a href="<?php echo base_url('back'); ?>" target="_self" title="پنل کاربر">
            <img src="<?php echo base_url('dist/img/brand.png'); ?>" width="40px" height="40px" title="پنل کاربر" />
            <span>سامانه استعلام پذیرندگان</span>
          </a>
        </div>
        <?php if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE): ?><nav class="nav">
          <ul class="menu">
            <li>
              <a href="<?php echo base_url('back/login'); ?>" target="_self" title="کاربر مهمان">
                <img src="<?php echo base_url('dist/img/member.png'); ?>" width="30px" height="30px" title="کاربر مهمان" class="member">
                <span>کاربر مهمان، لطفا وارد شوید</span>
              </a>
            </li>
          </ul>
        </nav><?php else: ?><nav class="nav">
          <ul class="menu">
            <li class="chunk">
              <a href="<?php echo base_url('back/dashboard'); ?>" target="_self" title="<?php echo $member->name; ?>">
                <img src="<?php echo base_url('dist/img/member.png'); ?>" width="30px" height="30px" title="<?php echo $member->name; ?>" class="member">
                <span><?php echo $member->name; ?>، خوش آمدید</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('back/logout'); ?>" target="_self" title="خروج">
                <span>خروج</span>
              </a>
            </li>
          </ul>
        </nav><?php endif; ?>
      </div>
    </header>
    <main class="main">
      <div class="wrapper">
