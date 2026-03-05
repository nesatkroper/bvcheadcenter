<form class="form-horizontal" action="<?php echo e(route('commissions.pay_to_seller2')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal-header">
    	<h5 class="modal-title h6"><?php echo e(translate('Pay to seller')); ?></h5>
    	<button type="button" class="close" data-dismiss="modal">
    	</button>
    </div>
    <div class="modal-body">
      <table class="table table-striped table-bordered" >
          <tbody>
               
              <?php if( $seller_withdraw_request->t_type ==2 ): ?>
              
               <!------------------------------>
              <tr>
                    <?php if($user2->balance >= 0): ?>
                        <td><?php echo e(translate('Due to seller')); ?></td>
                        <td><?php echo e(single_price($user2->balance)); ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <?php if($seller_withdraw_request->amount > $user2->balance ): ?>
                        <td><?php echo e(translate('Requested Amount is ')); ?></td>
                        <td><?php echo e(single_price($seller_withdraw_request->amount)); ?></td>
                    <?php endif; ?>
                </tr>
            
                <?php if($user2->bank_payment_status == 1): ?>
                    <tr>
                        <td><?php echo e(translate('Bank Name')); ?></td>
                        <td><?php echo e($user2->bank_name); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(translate('Bank Account Name')); ?></td>
                        <td><?php echo e($user2->bank_acc_name); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(translate('Bank Account Number')); ?></td>
                        <td><?php echo e($user2->bank_acc_no); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(translate('Bank Routing Number')); ?></td>
                        <td><?php echo e($user2->bank_routing_no); ?></td>
                    </tr>
                    
                  
                    
                    
                <?php endif; ?>
                
                 <?php if($user2->usdt_payment_status == 1): ?>
                
                   <tr>
                        <td><?php echo e(translate('USDT Link')); ?></td>
                        <td><?php echo e($user2->usdt_type); ?></td>
                    </tr>
                    
                    
                     <tr>
                        <td><?php echo e(translate('USDT Address')); ?></td>
                        <td><?php echo e($user2->usdt_address); ?></td>
                    </tr>
                    
                    
                <?php endif; ?>
                
                
                
                <!------------------------------>
              
              
              <?php else: ?>
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
                
                <?php if($user->shop->usdt_payment_status == 1): ?>
                <tr>
                        <td><?php echo e(translate('USDT Link')); ?></td>
                        <td><?php echo e($user->shop->usdt_type); ?></td>
                    </tr>
                    
                    
                     <tr>
                        <td><?php echo e(translate('USDT Address')); ?></td>
                        <td><?php echo e($user->shop->usdt_address); ?></td>
                    </tr>
                    
                <?php endif; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if($user->shop->admin_to_pay > 0 || true): ?>
            <input type="hidden" name="shop_id" value="<?php echo e($user->shop->id); ?>">
            <input type="hidden" name="payment_withdraw" value="withdraw_request">
            <input type="hidden" name="withdraw_request_id" value="<?php echo e($seller_withdraw_request->id); ?>">
            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="amount"><?php echo e(translate('Requested Amount')); ?></label>
                <div class="col-sm-9">
                    <?php if($seller_withdraw_request->amount > $user->shop->admin_to_pay && false): ?>
                        <input type="number" lang="en" min="0" step="0.01" name="amount" id="amount" value="<?php echo e($user->shop->admin_to_pay); ?>" class="form-control" required>
                    <?php else: ?>
                        <input type="number" lang="en" min="0" step="0.01" name="amount" id="amount" value="<?php echo e($seller_withdraw_request->amount); ?>" class="form-control" required>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="payment_option"><?php echo e(translate('Payment Method')); ?></label>
                <div class="col-sm-9">
                    <select name="payment_option" id="payment_option" class="form-control demo-select2-placeholder" required>
                        <option value=""><?php echo e(translate('Select Payment Method')); ?></option>
                        <?php if($user->shop->cash_on_delivery_status == 1 || true): ?>
                            <option value="cash"><?php echo e(translate('Cash')); ?></option>
                        <?php endif; ?>
                        <?php if($user->shop->bank_payment_status == 1 || true): ?>
                            <option value="bank_payment"><?php echo e(translate('Bank Payment')); ?></option>
                        <?php endif; ?>
                        <?php if($user->shop->usdt_payment_status == 1 || true): ?>
                            <option value="usdt_payment"><?php echo e(translate('USDT Payment')); ?></option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
                        <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="payment_option"><?php echo e(translate('Remarks')); ?></label>
                <div class="col-sm-9">
                    <textarea cols=50 rows="10" class="form-control" name="remarks"></textarea>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <div class="modal-footer">
      <?php if($user->shop->admin_to_pay >= 0): ?>
        <button type="submit" class="btn btn-primary"><?php echo e(translate('Pay')); ?></button>
      <?php endif; ?>
      <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
    </div>
    
     <input type="hidden" value="<?php echo e($seller_withdraw_request_id); ?>" name="seller_withdraw_request_id" />
</form>

<script>
$(document).ready(function(){
    $('#payment_option').on('change', function() {
      if ( this.value == 'bank_payment')
      {
        $("#txn_div").show();
      }
      else
      {
        $("#txn_div").hide();
      }
    });
    $("#txn_div").hide();
    AIZ.plugins.bootstrapSelect('refresh');
});
</script>
<?php /**PATH /home/longkubz1/public_html/resources/views/backend/sellers/seller_withdraw_requests/payment_modal.blade.php ENDPATH**/ ?>