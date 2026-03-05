

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <h3 class="mb-0 h6"><?php echo e(translate('Seller Payments')); ?></h3>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th data-breakpoints="lg"><?php echo e(translate('Date')); ?></th>
                    <th><?php echo e(translate('Customer')); ?></th>
                    <th><?php echo e(translate('Amount')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Payment Details')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $user = \App\Models\User::find($payment->seller_id); ?>
                    <?php if($user  ): ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td><?php echo e($payment->created_at); ?></td>
                            <td>
                                <?php echo e($user->name); ?>  
                            </td>
                            <td>
                                <?php echo e(single_price($payment->amount)); ?>

                            </td>
                            <td><?php echo e(ucfirst(str_replace('_', ' ', $payment->payment_method))); ?> <?php if($payment->txn_code != null): ?> (<?php echo e(translate('TRX ID')); ?> : <?php echo e($payment->txn_code); ?>) <?php endif; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="aiz-pagination">
              <?php echo e($payments->links()); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/longkubz1/public_html/resources/views/backend/sellers/payment_histories/index2.blade.php ENDPATH**/ ?>