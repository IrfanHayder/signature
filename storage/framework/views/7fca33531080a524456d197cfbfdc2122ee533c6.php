
<?php $__env->startSection('main'); ?>
      
 <div class="game-box">
            <div class="col-md-12 offset-md-3 ml-0 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Signature Pad</h5>
                    </div>
                    <div class="card-body">
                         <?php if($message = Session::get('success')): ?>
                             <div class="alert alert-success  alert-dismissible" id="close">
                                 <button type="button" class="close"  data-dismiss="alert">×</button>  
                                 <strong ><?php echo e($message); ?></strong>
                             </div>
                         <?php endif; ?>
                         <form method="POST" action="<?php echo e(route('signaturepad.upload')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                             <div class="col-md-12 sig_main">


                                <label class="" for="">Name:</label>
                                <br/>
                                <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Name" class="name"/>
                                <?php if($errors->has('name')): ?>
                                <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                                <br/>


                                
                                <label class="" for="">Email:</label>
                                <br/>
                                <input type="email" name="email" placeholder="Enter Email" value="<?php echo e(old('email')); ?>" class="date"/>
                                <?php if($errors->has('email')): ?>
                                <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                <?php endif; ?>
                                <br/>


                                <label class="" for="">Phone Number:</label>
                                <br/>
                                <input type="number" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="Enter Phone Number" class="name"/>
                                <?php if($errors->has('phone')): ?>
                                <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                                <?php endif; ?>
                                <br/>




                                <label class="" for="">Signature:</label>
                                <br/>
                                <div id="sig" class="mb-3"></div>
                                <br/>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                                <?php if($errors->has('signed')): ?>
                                <span class="text-danger"><?php echo e($errors->first('signed')); ?></span>
                                <?php endif; ?>
                                <br/>
                                <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                                
                             </div>
                             <br/>
                             <button type="submit" class="btn btn-success">Save</button>

                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('components.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\signature\resources\views/signaturePad.blade.php ENDPATH**/ ?>