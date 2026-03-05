<form class="form-horizontal" action="<?php echo e(route('commissions.refuse')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal-header">
    	<h5 class="modal-title h6"><?php echo e(translate('Refuse')); ?></h5>
    	<button type="button" class="close" data-dismiss="modal">
    	</button>
    </div>
    <input type="hidden" value="<?php echo e($id); ?>" name="withdraw_request_id"  />
    <div class="modal-body">
      <table class="table table-striped table-bordered" >
          <tbody>
                <tr>
                    <?php if($user->shop->admin_to_pay >= 0): ?>
                        <td><?php echo e(translate('Due to seller')); ?></td>
                        <td><?php echo e(single_price($user->shop->admin_to_pay)); ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <?php if($seller_withdraw_request->amount > $user->shop->admin_to_pay): ?>
                        <td><?php echo e(translate('Requested Amount is ')); ?></td>
                        <td><?php echo e(single_price($seller_withdraw_request->amount)); ?></td>
                    <?php endif; ?>
                </tr>
                <?php if($user->shop->bank_payment_status == 1): ?>
                    <tr>
                        <td><?php echo e(translate('Bank Name')); ?></td>
                        <td><?php echo e($user->shop->bank_name); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(translate('Bank Account Name')); ?></td>
                        <td><?php echo e($user->shop->bank_acc_name); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(translate('Bank Account Number')); ?></td>
                        <td><?php echo e($user->shop->bank_acc_no); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(translate('Bank Routing Number')); ?></td>
                        <td><?php echo e($user->shop->bank_routing_no); ?></td>
                    </tr>
                 
                <?php endif; ?>
                
                   <tr>
                       <td colspan="2">
                           <div class="form-group row">
                <label class="col-sm-3 col-from-label"  for="payment_option"><?php echo e(translate('Remarks')); ?></label>
                <div class="col-sm-9">
                    <textarea cols=50 rows="10" class="form-control" name="remarks"></textarea>
                </div>
            </div></td>
            </tr>
            
            </tbody>
        </table>

    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo e(translate('Confirm')); ?></button>
      <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
    </div>
</form>
<?php /**PATH /home/longkubz1/public_html/resources/views/backend/sellers/seller_withdraw_requests/refuse_modal.blade.php ENDPATH**/ ?>