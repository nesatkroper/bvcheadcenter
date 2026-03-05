

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6"><?php echo e(translate('Rejected Request')); ?></h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(translate('Order Code')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Seller Name')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Product')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Price')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Seller Approval')); ?></th>
                    <th><?php echo e(translate('Admin Approval')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Reject Reason')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $refunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(($key+1) + ($refunds->currentPage() - 1)*$refunds->perPage()); ?></td>
                        <td>
                          <?php if($refund->order != null): ?>
                              <?php echo e($refund->order->code); ?>

                          <?php else: ?>
                              <?php echo e(translate('Order deleted')); ?>

                          <?php endif; ?>
                        </td>
                        <td>
                            <?php if($refund->seller != null): ?>
                                <?php echo e($refund->seller->name); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($refund->orderDetail != null && $refund->orderDetail->product != null): ?>
                              <a href="<?php echo e(route('product', $refund->orderDetail->product->slug)); ?>" target="_blank" class="media-block">
                                <div class="form-group row">
                                  <div class="col-md-5">
                                    <img src="<?php echo e(uploaded_asset($refund->orderDetail->product->thumbnail_img)); ?>" alt="Image" class="w-50px">
                                  </div>
                                  <div class="col-md-7">
                                    <div class="media-body"><?php echo e($refund->orderDetail->product->getTranslation('name')); ?></div>
                                  </div>
                                </div>
                              </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($refund->orderDetail != null): ?>
                                <?php echo e(single_price($refund->orderDetail->price)); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($refund->seller_approval == 1): ?>
                              <span class="badge badge-inline badge-success"><?php echo e(translate('Approved')); ?></span>
                            <?php else: ?>
                              <span class="badge badge-inline badge-warning"><?php echo e(translate('Pending')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($refund->admin_approval == 2): ?>
                                <span class="badge badge-inline badge-danger"><?php echo e(translate('Rejected')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-right">
                            <a href="javascript:void(0);" onclick="refund_reject_reason_show('<?php echo e(route('reject_reason_show', $refund->id )); ?>')" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="<?php echo e(translate('Reject Reason')); ?>">
                                <i class="las la-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                <?php echo e($refunds->appends(request()->input())->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<div class="modal fade reject_reason_show_modal" id="modal-basic">
	<div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title h6"><?php echo e(translate('Refund Request Reject Reason')); ?></h5>
              <button type="button" class="close" data-dismiss="modal"></button>
          </div>
          <div class="modal-body reject_reason_show">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(translate('Close')); ?></button>
          </div>
      </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  function refund_reject_reason_show(url){
      $.get(url, function(data){
          $('.reject_reason_show').html(data);
          $('.reject_reason_show_modal').modal('show');
      });
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/longkubz1/public_html/resources/views/refund_request/rejected_refund.blade.php ENDPATH**/ ?>