
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('home.updateStatus',$edit_orderList['id'])); ?>" method="POST" id="edit_form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
       
            <div class="card-body">
              <input type="hidden" class="form-control" name="id" value="<?php echo e($edit_orderList['id']); ?>" />
              <div class="form-group">
                <input type="text" name="product_name" class="form-control mb-12 <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="exampleInputTitle" value="<?php echo e($edit_orderList['product_name']); ?>" disabled>
                <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
              <div class="form-group">
                <label>Update Order Status:</label>
               <select name="status" id="order_status">
                <option value="0" <?php if($edit_orderList['status']==0): ?> selected <?php endif; ?>>Pending</option>
                <option value="1"  <?php if($edit_orderList['status']==1): ?> selected <?php endif; ?>>Completed</option>
               </select>
               <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
             <?php if(strpos($edit_orderList['delivery_type'], 'subscription')): ?>
              <p class="title-subscribe">Edit Subscription</p>
              <p>Plan: <?php echo e($subscription_offers->subscription_type); ?></p>
              <label>Starts At:</label>
              <input type="date" name="start_date" value="<?php echo e($subscription_offers->start_date); ?>" disabled/>
              <label>Ends At:</label>
              <input type="date" name="end_date" value="<?php echo e($subscription_offers->end_date); ?>"/> 
            <?php endif; ?>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <form action="<?php echo e(route('home.cancelSubscribe',$edit_orderList['id'])); ?>" method="POST" id="edit_form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <input type="submit" class="btn btn-danger" onclick="clicked(event)" value="Unsubscribe" />
       </form>
       <script>
        function clicked(e)
        {
            if(!confirm('Are you sure?')) {
                e.preventDefault();
            }
        }
       </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\shopper\resources\views/home/edit-order.blade.php ENDPATH**/ ?>