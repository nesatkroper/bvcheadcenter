

<?php $__env->startSection('panel_content'); ?>
    <div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
      <div class="col-md-6">
          <h1 class="h3"><?php echo e(translate('My Wallet')); ?></h1>
      </div>
    </div>
    </div>
    <div class="row gutters-10">
      <div class="col-md-3 mx-auto mb-3" >
          <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
            <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                <i class="las la-dollar-sign la-2x text-white"></i>
            </span>
            <div class="px-3 pt-3 pb-3">
                <div class="h4 fw-700 text-center"><?php echo e(single_price(Auth::user()->balance)); ?></div>
                <div class="opacity-50 text-center"><?php echo e(translate('Wallet Balance')); ?></div>
            </div>
          </div>
      </div>
      <div class="col-md-3 mx-auto mb-3" >
        <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition" onclick="show_wallet_modal()">
            <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                <i class="las la-plus la-3x text-white"></i>
            </span>
            <div class="fs-18 text-primary"><?php echo e(translate('Recharge Wallet')); ?></div>
        </div>
      </div>
      <?php if(addon_is_activated('offline_payment')): ?>
          <div class="col-md-3 mx-auto mb-3" >
              <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition" onclick="show_make_wallet_recharge_modal()">
                  <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                      <i class="las la-plus la-3x text-white"></i>
                  </span>
                  <div class="fs-18 text-primary"><?php echo e(translate('Offline Recharge Wallet')); ?></div>
              </div>
          </div>
      <?php endif; ?>
      
      
         <div class="col-md-3 mb-3 mx-auto">
            <div
                class="bg-grad-2 p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition"
                onclick="show_request_modal()">
              <span
                  class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                  <i class="las la-plus la-3x text-white"></i>
              </span>
                <div class="fs-18 text-white"><?php echo e(translate('Send Withdraw Request')); ?></div>
            </div>
        </div>
        
        
    </div>
    <div class="card">
      <div class="card-header">
          <h5 class="mb-0 h6"><?php echo e(translate('Wallet recharge history')); ?></h5>
      </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                  <tr>
                      <th>#</th>
                      <th data-breakpoints="lg"><?php echo e(translate('Date')); ?></th>
                      <th><?php echo e(translate('Amount')); ?></th>
                      <th data-breakpoints="lg"><?php echo e(translate('Payment Method')); ?></th>
                      <th class="text-right"><?php echo e(translate('Approval')); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td><?php echo e(date('d-m-Y', strtotime($wallet->created_at))); ?></td>
                          <td><?php echo e(single_price($wallet->amount)); ?></td>
                          <td><?php echo e(ucfirst(str_replace('_', ' ', $wallet ->payment_method))); ?></td>
                          <td class="text-right">
                              <?php if($wallet->offline_payment): ?>
                                  <?php if($wallet->approval): ?>
                                      <span class="badge badge-inline badge-success"><?php echo e(translate('Approved')); ?></span>
                                  <?php else: ?>
                                      <span class="badge badge-inline badge-info"><?php echo e(translate('Pending')); ?></span>
                                  <?php endif; ?>
                              <?php else: ?>
                                  N/A
                              <?php endif; ?>
                          </td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
            <div class="aiz-pagination">
                <?php echo e($wallets->links()); ?>

            </div>
        </div>
    </div>
    
    
    
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6"><?php echo e(translate('Withdraw Request history')); ?></h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(translate('Date')); ?></th>
                    <th><?php echo e(translate('Amount')); ?></th>
                    <th><?php echo e(translate('Type')); ?></th>
                    
                    <th data-breakpoints="lg"><?php echo e(translate('Status')); ?></th>
                    <th><?php echo e(translate('Withdraw Type')); ?></th>
                    <th><?php echo e(translate('Remarks')); ?></th>
                    <th data-breakpoints="lg" width="40%"><?php echo e(translate('Message')); ?></th>
                    
                    
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $seller_withdraw_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $seller_withdraw_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e(date('d-m-Y', strtotime($seller_withdraw_request->created_at))); ?></td>
                        <td><?php echo e(single_price($seller_withdraw_request->amount)); ?></td>
                        <td>
                            <?php if( $seller_withdraw_request->type == 1): ?>
                            
                            <?php echo e(translate('User Balance')); ?>

                            <?php else: ?>
                            
                              <?php echo e(translate('Guarantee')); ?>

                            <?php endif; ?>
                        </td>
                        <td> 
                            <?php if($seller_withdraw_request->status == 1): ?>
                                <span class=" badge badge-inline badge-success"><?php echo e(translate('Paid')); ?></span>
                             <?php elseif($seller_withdraw_request->status == 2): ?>
                                <span class=" badge badge-inline badge-danger"><?php echo e(translate('Refuse')); ?> </span>
                            <?php else: ?>
                                <span class=" badge badge-inline badge-info"><?php echo e(translate('Pending')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            
                            <?php if( $seller_withdraw_request->w_type == 1): ?>
                            
                            <?php echo e(translate('Cash')); ?>

                            <?php elseif( $seller_withdraw_request->w_type == 2): ?>
                            
                              <?php echo e(translate('Bank')); ?>

                            <?php elseif( $seller_withdraw_request->w_type == 3): ?>
                            <?php echo e(translate('USDT')); ?>

                            <?php endif; ?>
                        </td>
                             <td>
                            <?php echo e($seller_withdraw_request->remarks); ?>

                        </td>
                        <td>
                            <?php echo e($seller_withdraw_request->message); ?>

                        </td>
                   
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="aiz-pagination">
                <?php echo e($seller_withdraw_requests->links()); ?>

            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

  <div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Recharge Wallet')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <form class="" action="<?php echo e(route('wallet.recharge')); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <div class="modal-body gry-bg px-3 pt-3">
                      <div class="row">
                          <div class="col-md-4">
                              <label><?php echo e(translate('Amount')); ?> <span class="text-danger">*</span></label>
                          </div>
                          <div class="col-md-8">
                              <input type="number" lang="en" class="form-control mb-3" name="amount" placeholder="<?php echo e(translate('Amount')); ?>" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-4">
                              <label><?php echo e(translate('Payment Method')); ?> <span class="text-danger">*</span></label>
                          </div>
                          <div class="col-md-8">
                              <div class="mb-3">
                                  <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="payment_option" data-live-search="true">
                                    <?php if(get_setting('paypal_payment') == 1): ?>
                                        <option value="paypal"><?php echo e(translate('Paypal')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('stripe_payment') == 1): ?>
                                        <option value="stripe"><?php echo e(translate('Stripe')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('mercadopago_payment') == 1): ?>
                                        <option value="mercadopago"><?php echo e(translate('Mercadopago')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('toyyibpay_payment') == 1): ?>
                                        <option value="toyyibpay"><?php echo e(translate('ToyyibPay')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('sslcommerz_payment') == 1): ?>
                                        <option value="sslcommerz"><?php echo e(translate('SSLCommerz')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('instamojo_payment') == 1): ?>
                                        <option value="instamojo"><?php echo e(translate('Instamojo')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('paystack') == 1): ?>
                                        <option value="paystack"><?php echo e(translate('Paystack')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('voguepay') == 1): ?>
                                        <option value="voguepay"><?php echo e(translate('VoguePay')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('payhere') == 1): ?>
                                        <option value="payhere"><?php echo e(translate('Payhere')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('ngenius') == 1): ?>
                                        <option value="ngenius"><?php echo e(translate('Ngenius')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('razorpay') == 1): ?>
                                        <option value="razorpay"><?php echo e(translate('Razorpay')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('iyzico') == 1): ?>
                                        <option value="iyzico"><?php echo e(translate('Iyzico')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('bkash') == 1): ?>
                                        <option value="bkash"><?php echo e(translate('Bkash')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('nagad') == 1): ?>
                                        <option value="nagad"><?php echo e(translate('Nagad')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('payku') == 1): ?>
                                        <option value="payku"><?php echo e(translate('Payku')); ?></option>
                                    <?php endif; ?>
                                    <?php if(addon_is_activated('african_pg')): ?>
                                        <?php if(get_setting('mpesa') == 1): ?>
                                            <option value="mpesa"><?php echo e(translate('Mpesa')); ?></option>
                                        <?php endif; ?>
                                        <?php if(get_setting('flutterwave') == 1): ?>
                                            <option value="flutterwave"><?php echo e(translate('Flutterwave')); ?></option>
                                        <?php endif; ?>
                                        <?php if(get_setting('payfast') == 1): ?>
                                            <option value="payfast"><?php echo e(translate('PayFast')); ?></option>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(addon_is_activated('paytm') && get_setting('paytm_payment')): ?>
                                        <option value="paytm"><?php echo e(translate('Paytm')); ?></option>
                                    <?php endif; ?>
                                    <?php if(get_setting('authorizenet') == 1): ?>
                                        <option value="authorizenet"><?php echo e(translate('Authorize Net')); ?></option>
                                    <?php endif; ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="form-group text-right">
                          <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1"><?php echo e(translate('Confirm')); ?></button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>


  <!-- offline payment Modal -->
  <div class="modal fade" id="offline_wallet_recharge_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Offline Recharge Wallet')); ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div id="offline_wallet_recharge_modal_body"></div>
          </div>
      </div>
  </div>
 
    <?php
    $balance = \App\Models\User::where(['id'=>Auth::user()->id])->first()['balance'];
    ?>
    <div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Send A Withdraw Request')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php if($balance > 5): ?>
                    <form class="" action="<?php echo e(route('wallet.do_money_withdraw_request')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body gry-bg px-3 pt-3">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-success" role="alert">
                                        <h6><?php echo e(translate('Your wallet balance :')); ?> $<?php echo e($balance); ?></h6>
                                    </div>
                                    
                              
                                    
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label><?php echo e(translate('Amount')); ?> <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" lang="en" class="form-control mb-3" name="amount"
                                         
                                           placeholder="<?php echo e(translate('Amount')); ?>" required>
                                </div>
                            </div>
                             <div class="row" style="margin-bottom:5px; display:none;">
                                
                                 <div class="col-md-3">
                                    <label><?php echo e(translate('Opera Type')); ?></label>
                                </div>
                                 <div class="col-md-9">
                                     <select name="type" class="form-control">
                                         <option value="1"><?php echo e(translate('User Balance')); ?></option>
                                         
                                     </select>
                                </div>
                                
                                </div>
                            <div class="row" style="margin-bottom:5px;">
                                
                                 <div class="col-md-3">
                                    <label><?php echo e(translate('Withdraw Type')); ?></label>
                                </div>
                                 <div class="col-md-9">
                                     <select name="w_type" class="form-control" id="p">
                                        <option value="1"><?php echo e(translate('Cash')); ?></option>
                                        <option value="2"><?php echo e(translate('Bank')); ?></option>
                                        <option value="3"><?php echo e(translate('USDT')); ?></option>
                            
                                     </select>
                                </div>
                                
                                </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label><?php echo e(translate('Message')); ?></label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="message" rows="8" class="form-control mb-3"></textarea>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-sm btn-primary"><?php echo e(translate('Send')); ?></button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="p-5 heading-3">
                            <?php echo e(translate('You do not have enough balance to send withdraw request')); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
    
        function show_request_modal() {
            $('#request_modal').modal('show');
        }



        function show_wallet_modal(){
            $('#wallet_modal').modal('show');
        }

        function show_make_wallet_recharge_modal(){
            $.post('<?php echo e(route('offline_wallet_recharge_modal')); ?>', {_token:'<?php echo e(csrf_token()); ?>'}, function(data){
                $('#offline_wallet_recharge_modal_body').html(data);
                $('#offline_wallet_recharge_modal').modal('show');
            });
        }
        
        $(function(){
            <?php 
            $user = \App\Models\User::find(Auth::user()->id);
            ?>
         $("#p").change(function(){
            var usdt_status = <?php echo e($user->usdt_payment_status); ?>;
            var bank_payment_status = <?php echo e($user->bank_payment_status); ?>;
            var cash_on_delivery_status = <?php echo e($user->cash_on_delivery_status); ?>;
            var type = $(this).val();
            if (type == 3 && usdt_status == 0) {
                window.location.href = "/profile"
                $(".btn").attr("disabled")
            }
            if (type == 2 && bank_payment_status == 0) {
                window.location.href = "/profile#bank"
                 $(".btn").attr("disabled")
            }
            if (type == 1 && cash_on_delivery_status == 0) {
                window.location.href = "/profile#cash"
                 $(".btn").attr("disabled")
            }
        })
        
        
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.user_panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/longkubz1/public_html/resources/views/frontend/user/wallet/index.blade.php ENDPATH**/ ?>