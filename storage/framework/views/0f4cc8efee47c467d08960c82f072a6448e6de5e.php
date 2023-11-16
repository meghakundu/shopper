
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
                <th>Vendor_Name</th>
                <th>Product_Name</th>
                <th>Current Stock</th>
                <th>Total Stock</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $stockList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($stock_item['company_name']); ?></td>
                <td><?php echo e($stock_item['product_name']); ?></td>
                <td><?php if($stock_item['status']==1): ?><?php echo e($stock_item['stock']-$stock_item['qty']); ?> <?php elseif($stock_item['status']==2): ?> Item in Cart(<?php echo e($stock_item['qty']); ?>) <?php else: ?> <?php echo e($stock_item['stock']); ?> <?php endif; ?></td>
                <td><?php echo e($stock_item['stock']); ?></td>
                
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="container mt-4">
            <h2 class="mb-5 text-center">Connect with Vendors using Social media Share</h2>
            <?php echo $shareComponent; ?>

        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\shopper\resources\views/stocks_index.blade.php ENDPATH**/ ?>