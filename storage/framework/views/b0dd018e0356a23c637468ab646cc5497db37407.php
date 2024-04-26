
<?php $__env->startSection('head'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tools Audit</h4>
                    <table id="" class="table">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Tool</th>
                                <th>Audit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tools_with_audits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('tool.audit', ['id' => $item->id])); ?>">Audit</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\signature\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>