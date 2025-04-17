<footer class="footer pt-3">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <?php echo date('Y'); ?> - تمامی حقوق برای <span class="font-weight-bold"><?php echo $SCHOOL_NAME; ?></span> محفوظ است.
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="<?php echo site_url(); ?>" class="nav-link text-muted" target="_blank">مشاهده وب‌سایت</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo admin_url('settings/general.php'); ?>" class="nav-link text-muted">تنظیمات</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo admin_url('config/loguot-admin.php'); ?>" class="nav-link pe-0 text-muted">خروج</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>