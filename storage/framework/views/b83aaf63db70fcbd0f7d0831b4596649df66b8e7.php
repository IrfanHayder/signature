

<?php $__env->startSection('head'); ?>

    <link href="<?php echo e(asset('web_assets/admin/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')); ?>" rel="stylesheet"

        type="text/css" />

    <link href="<?php echo e(asset('web_assets/admin/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')); ?>"

        rel="stylesheet" type="text/css" />

    <style>

        .feature {

            max-width: 250px;

            width: 60px;

            border-radius: 50%;

        }



        tbody tr td {

            vertical-align: middle;

        }

    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">

        <div class="col-12 mt-4">

            <div class="card">

                <div class="card-body">

                    <h4 class="header-title">UsersTable</h4>



                    <table id="users_table" class="table dt-responsive nowrap w-100  order-column">

                        <thead>

                            <tr>

                                <th>Sr.</th>

                                <th>Name</th>

                                <th>PDF</th>

                            </tr>

                        </thead>



                        <tbody>
                            <?php $__currentLoopData = $signature_pdf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index+1); ?></td> 
                                    <td><?php echo e($sign->name); ?></td>
                            
                                    <td>
                                        <?php if(count($files) > 0): ?>
                                                
                                                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdfFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       
                                                       <?php if($pdfFile->getFilename() == $sign->pdf): ?>
                                                           
                                                       
                                                        <a href="<?php echo e(asset('pdf/' . $pdfFile->getFilename())); ?>" target="_blank">
                                                            <?php echo e($pdfFile->getFilename()); ?>

                                                        </a>
                                                        
                                                    <?php endif; ?>
                                                                    
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <?php else: ?>
                                                <p>No PDF files found.</p>
                                        <?php endif; ?>
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

    <script defer src="<?php echo e(asset('web_assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>

    <script defer src="<?php echo e(asset('web_assets/admin/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')); ?>"></script>

    <script defer src="<?php echo e(asset('web_assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>">

    </script>

    <script>

        $(document).ready(function() {

            $("#users_table").dataTable();

        });

    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\signature\resources\views/pdf.blade.php ENDPATH**/ ?>