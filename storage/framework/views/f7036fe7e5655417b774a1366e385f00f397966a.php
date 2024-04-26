<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <div class="user-box text-center">

            <img src="" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">

            <div class="dropdown">

                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"

                    data-bs-toggle="dropdown">Admin</a>

                <div class="dropdown-menu user-pro-dropdown">

                    <a href="#" class="dropdown-item notify-item">

                        <i class="fe-log-out me-1"></i>

                        <span>Logout</span>

                    </a>

                </div>

            </div>

            <p class="text-muted">Admin Head</p>

        </div>

        <div id="sidebar-menu">

            <ul id="side-menu">

                <li>

                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="active">

                        <img src="<?php echo e(asset('web_assets/admin/images/dashboard.png')); ?>" alt="">

                        <span> Dashboard </span>

                    </a>

                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('super_admin')): ?>

                    <li>

                        <a href="#users" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">

                            <img src="<?php echo e(asset('web_assets/admin/images/admin.png')); ?>" alt="">

                            <span> Admins </span>

                            <span class="menu-arrow"> </span>

                        </a>


                        </a>

                    </li>

                <?php endif; ?>
          

            





                <li>

                    <a href="<?php echo e(route('signature.list')); ?>" >

                        <img src="<?php echo e(asset('web_assets/admin/images/settings.png')); ?>" alt="">

                        <span> List </span>

                    </a>

                </li>

                









               

        

            </ul>

        </div>

        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>

    <!-- Sidebar -left -->

</div>

<?php /**PATH D:\signature\resources\views/layout/admin/leftBar.blade.php ENDPATH**/ ?>