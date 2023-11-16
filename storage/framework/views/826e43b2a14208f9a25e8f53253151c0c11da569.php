
<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="alert alert-success" role="alert">
    <?php echo e(session('success')); ?>

</div>
 <?php endif; ?>
 <?php if(session('error')): ?>
<div class="alert alert-danger" role="alert">
<?php echo e(session('error')); ?>

</div>
 <?php endif; ?>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Ordered By</th>
                <th>Product_Name</th>
                <th>Payment Mode</th>
                <th>Amount Payable</th>
                <th>Transaction Date</th>
                <th>Bank Balance</th>
                <th>Order Status</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item['paymentTypes']['login_email']); ?></td>
                <td><?php echo e($item['orderData']['product_name']); ?></td>
                <td><?php echo e($item['paymentTypes']['name']); ?></td>
                <td><?php echo e($item['amount']); ?></td>
                <td><?php echo e(date('d M,y',strtotime($item['updated_at']))); ?></td>
                <td><?php if($item['bankData']!= null): ?><?php echo e($item['bankData']['balance']); ?><?php endif; ?></td>
                <td><?php if($item['orderData']['status']==0): ?> Cancelled/Pending <?php else: ?> Completed <?php endif; ?></td>
                <td><?php if($item['status']==0): ?> Cancelled/Refund <?php else: ?> Completed <?php endif; ?></td>
                <td><?php if($item['orderData']['status']==0): ?> <a href="/refund-transaction/<?php echo e($item['id']); ?>"><button class="mail_btn">Refund</button></a>
                <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\shopper\resources\views/transaction/index.blade.php ENDPATH**/ ?>