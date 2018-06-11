<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['db_invalid_connection_str'] = 'تشخیص تنظیمات پایگاه داده بر اساس رشته اتصال ارسالی از سوی شما امکان پذیر نیست.';
$lang['db_unable_to_connect'] = 'اتصال به سرویس پایگاه داده بر اساس تنظیمات ارائه شده امکان پذیر نیست.';
$lang['db_unable_to_select'] = 'عدم موفقیت در اتصال به پایگاه داده مشخص شده: %s';
$lang['db_unable_to_create'] = 'عدم موفقیت در ایجاد جدول مشخص شده: %s';
$lang['db_invalid_query'] = 'پرس و جوی ارسال شده از سوی شما معتبر نیست.';
$lang['db_must_set_table'] = 'برای اجرای پرس و جو باید جدولی از پایگاه داده را مشخص کنید.';
$lang['db_must_use_set'] = 'برای به روز رسانی یک رکورد باید از متد "Set" استفاده کنید.';
$lang['db_must_use_index'] = 'برای به روز رسانی دسته ای باید یک ایندکس مشخص کنید.';
$lang['db_batch_missing_index'] = 'ایندکس مورد نظر برای به روز رسانی دسته ای یک یا بیشتر رکورد یافت نشد.';
$lang['db_must_use_where'] = 'به روز رسانی بدون استفاده از بخش "Where" در پرس و جو امکان پذیر نیست.';
$lang['db_del_must_use_where'] = 'حذف بدون استفاده از بخش "Where" یا "Like" در پرس و جو امکان پذیر نیست.';
$lang['db_field_param_missing'] = 'دریافت نام فیلدها مستلزم ارسال نام جدول به عنوان پارامتر است.';
$lang['db_unsupported_function'] = 'این امکان برای پایگاه داده ای که شما استفاده می کنید موجود نیست.';
$lang['db_transaction_failure'] = 'خطای اجرای تراکنش: عملیات بازگشت به نقطه پیش از اجرای تراکنش انجام شد.';
$lang['db_unable_to_drop'] = 'عدم موفقیت در حذف پایگاه داده مورد نظر.';
$lang['db_unsupported_feature'] = 'از یک ویژگی پایگاه داده که پشتیبانی نشده استفاده می کنید.';
$lang['db_unsupported_compression'] = 'قالب فشرده سازی فایل انتخابی شما، توسط سرویس دهنده پشتیبانی نمی شود.';
$lang['db_filepath_error'] = 'نوشتن در مسیر فایل ارسالی از سوی شما امکان پذیر نیست.';
$lang['db_invalid_cache_path'] = 'مسیر Cache ارسالی از سوی شما معتبر نبوده و یا اجازه نوشتن در آن را ندارید.';
$lang['db_table_name_required'] = 'برای انجام این کار اسم جدول نیاز است.';
$lang['db_column_name_required'] = 'برای انجام این کار نام ستون مورد نیاز است.';
$lang['db_column_definition_required'] = 'یک ستون تعریف شده برای این کار مورد نیاز است.';
$lang['db_unable_to_set_charset'] = 'عدم امکان تغییر گروه زبانی اتصال کاربر به: %s';
$lang['db_error_heading'] = 'خطایی در پایگاه داده رخ داده است.';
