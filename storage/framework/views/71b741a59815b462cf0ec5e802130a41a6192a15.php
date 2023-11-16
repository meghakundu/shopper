
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
                <th>Customer_Name</th>
                <th>Product_Name</th>
                <th>Delivery_type</th>
                <th>Destination</th>
                <th>Order_date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ord_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($ord_item['company']['name']); ?></td>
                <td><?php echo e($ord_item['product_name']); ?></td>
                <td><?php echo e($ord_item['delivery_type']); ?></td>
                <td><?php echo e($ord_item['destination_postal_code']); ?></td>
                <td><?php echo e(date('d M,y',strtotime($ord_item['created_at']))); ?></td>
                <td><?php if($ord_item['status']==0): ?> Pending <?php else: ?> Completed <?php endif; ?></td>
                <td class="action_row"><a href="/edit_status/<?php echo e($ord_item['id']); ?>">Edit</a>
                <?php if($ord_item['status']==0): ?> <a href="/send-mail/<?php echo e($ord_item['id']); ?>"><button class="mail_btn">Reason for delay(via Email)</button></a>
                <?php else: ?>
                <a href="/send-invoice/<?php echo e($ord_item['id']); ?>">
                <button class="mail_btn">Send Invoice</button></a>
                <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h3>Orders in queue:<?php echo e($count_orders_queued); ?></h3>
    <button id="queued_btn">View Orders in Queue</button>
    
    <table id="queued_orders" class="display nowrap" style="width:100%;display:none">
        <thead>
            <tr>
                <th>Customer_Name</th>
                <th>Product_Name</th>
                <th>Vendor_Name</th>
                <th>Actual_wait_time(<7mins)</th>
                <th>Status</th>
                <th>Remarks send by customers(if any)</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $queued_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $queued_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($queued_item['company']['name']); ?></td>
                <td><?php echo e($queued_item['product_name']); ?></td>
                <td><?php echo e($queued_item['company_name']); ?></td>
                <td><?php echo e($queued_item['actual_wait_time']); ?></td>
                <td><?php if($queued_item['status']==2): ?> Added to Cart <?php endif; ?></td>
                <td><?php echo e($queued_item['reason']); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </thead>
        </table>
        <h3>Limited Stock in vendors:</h3>
       <?php $__currentLoopData = $limited_stock_vendors->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <?php echo e($item['company_name']); ?> <?php if($loop->last!=1): ?>,<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <h3>Renewable Subscription offer:</h3>
       <?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $id = str_replace('article:',' ',$value);
        $subscrpt_name = App\Models\orders::select('product_name')->where('id',$id)->first();
        ?>
        "<?php echo e($subscrpt_name['product_name']); ?>" is most renewed.
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <script>
$(document).ready(function(){
  $("#queued_btn").click(function(){
    $("#queued_orders").toggle();
  });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\shopper\resources\views/home/orders.blade.php ENDPATH**/ ?>