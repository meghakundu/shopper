
<?php $__env->startSection('content'); ?>
<form action="/update-transactions/<?php echo e($transactions['id']); ?>" method="POST" id="edit_form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
       
            <div class="card-body">
              <input type="hidden" class="form-control" name="id" value="<?php echo e($transactions['id']); ?>" />
              <div class="form-group">
              <label>Paid To:</label>
                <input type="text" name="bank_name" class="form-control mb-12 <?php $__errorArgs = ['bank_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="exampleInputTitle" value="<?php echo e($transactions['bankData']['name']); ?>" disabled>
              </div>
              <div class="form-group mb-12">
                <label>Refund Type:</label>
               <select name="refund_type" id="ddlSuggestion" onchange="GetSelectedTextValue()">
                <option value="full-refund">Full Refund</option>
                <option value="partial-refund">Partial Refund</option>
               </select>
              </div>
              <div class="form-group">
                <label>Payable Amount:</label>
              <input type="hidden" name="balance" value="<?php echo e($transactions['bankData']['balance']); ?>"/>
              <input type="text" name="amount" value="<?php echo e($transactions['amount']); ?>" disabled/>
              </div>
              <div class="form-group" id="txtComments" style="display: none;" >
              <label>Partial Refund Amount:</label>
              <input type="text" name="refund_amount">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Repay</button>
            </div>
        </form>
        <script type="text/javascript">
            function GetSelectedTextValue() {
                var v=document.getElementById("ddlSuggestion");
          var v1=document.getElementById("txtComments");
          if(v.value=="partial-refund")
          {
             v1.style.display='block';
          }
          else
          {
             v1.style.display='none';
          }
         }
            </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\shopper\resources\views/transaction/refund_payment.blade.php ENDPATH**/ ?>