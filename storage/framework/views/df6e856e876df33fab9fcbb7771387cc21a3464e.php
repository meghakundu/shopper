
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
                <th>Title</th>
                <th>Published At</th>
                <th>Reading Time</th>
                <th>Social Media Share</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $blogsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><a href="<?php echo e($blog_item['post_link']); ?>"><?php echo e($blog_item['name']); ?></a></td>
                <td><?php echo e(date('d M,y',strtotime($blog_item['created_at']))); ?></td>
                <td><?php echo e($blog_item['reading_time']); ?></td>
               <td>
                <?php if($blogs_per_month->count()>1): ?>
               <a href="/share-posts/<?php echo e($blog_item['id']); ?>"><button>Publish Later</button></a>
                <?php endif; ?>
               <div id="blogs-share"> <?php echo Share::page(url($blog_item['post_link']))->facebook(); ?></div>
              </td>   
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\shopper\resources\views/blogs.blade.php ENDPATH**/ ?>