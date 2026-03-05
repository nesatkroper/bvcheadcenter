<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 h6"><?php echo e(translate('Basic Affiliate')); ?></h6>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="<?php echo e(route('affiliate.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <input type="hidden" name="type" value="user_registration_first_purchase">
                        <div class="col-lg-4">
                            <label class="control-label"><?php echo e(translate('User Registration & First Purchase')); ?></label>
                        </div>
                        <div class="col-lg-6">
                            <?php
                            if(\App\Models\AffiliateOption::where('type', 'user_registration_first_purchase')->first() != null){
                                $percentage = \App\Models\AffiliateOption::where('type', 'user_registration_first_purchase')->first()->percentage;
                                $status = \App\Models\AffiliateOption::where('type', 'user_registration_first_purchase')->first()->status;
                            }
                            else {
                                $percentage = null;
                            }
                            ?>
                            <input type="number" min="0" step="0.01" max="100" class="form-control" name="percentage" value="<?php echo e($percentage); ?>" placeholder="Percentage of Order Amount" required>
                        </div>
                        <div class="col-lg-2">
                            <label class="control-label">%</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label class="control-label"><?php echo e(translate('Status')); ?></label>
                        </div>
                        <div class="col-lg-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input value="1" name="status" type="checkbox" <?php if($status): ?>
                                       checked
                                       <?php endif; ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><?php echo e(translate('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6"><?php echo e(translate('Product Sharing Affiliate')); ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('affiliate.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <input type="hidden" name="type" value="product_sharing">
                        <label class="col-lg-3 col-from-label"><?php echo e(translate('Product Sharing and Purchasing')); ?></label>
                        <div class="col-lg-6">
                            <?php
                            if(\App\Models\AffiliateOption::where('type', 'product_sharing')->first() != null && \App\Models\AffiliateOption::where('type', 'product_sharing')->first()->details != null){
                                $commission_product_sharing = json_decode(\App\Models\AffiliateOption::where('type', 'product_sharing')->first()->details)->commission;
                                $commission_type_product_sharing = json_decode(\App\Models\AffiliateOption::where('type', 'product_sharing')->first()->details)->commission_type;
                                $status = \App\Models\AffiliateOption::where('type', 'product_sharing')->first()->status;
                            }
                            else {
                                $commission_product_sharing = null;
                                $commission_type_product_sharing = null;
                            }
                            ?>
                            <input type="number" min="0" step="0.01" max="100" class="form-control" name="amount" value="<?php echo e($commission_product_sharing); ?>" placeholder="Percentage of Order Amount" required>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control aiz-selectpicker" name="amount_type">
                                <option value="amount" <?php if($commission_type_product_sharing == "amount"): ?> selected <?php endif; ?>>$</option>
                                <option value="percent" <?php if($commission_type_product_sharing == "percent"): ?> selected <?php endif; ?>>%</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label class="control-label"><?php echo e(translate('Status')); ?></label>
                        </div>
                        <div class="col-lg-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input value="1" name="status" type="checkbox" <?php if($status): ?> checked <?php endif; ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><?php echo e(translate('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6"><?php echo e(translate('Distribution Configuration')); ?></h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="<?php echo e(route('affiliate.commission')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php
                        $commission_status = get_setting('commission_status');
                    ?>
                    
                    <div class="form-group row">
                        <label class="col-lg-4">一级佣金比例</label>
                        <div class="col-lg-6">
                            <input type="hidden" name="types[]" value="commission_ratio_level_1">
                            <input type="number" min="0" max="100" step="0.01" name="commission_ratio_level_1" class="form-control" value="<?php echo e(get_setting('commission_ratio_level_1')); ?>">
                        </div>
                        <div class="col-lg-2">
                            %
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4">二级佣金比例</label>
                        <div class="col-lg-6">
                            <input type="hidden" name="types[]" value="commission_ratio_level_2">
                            <input type="number" min="0" max="100" step="0.01" name="commission_ratio_level_2" class="form-control" value="<?php echo e(get_setting('commission_ratio_level_2')); ?>">
                        </div>
                        <div class="col-lg-2">
                            %
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4">三级佣金比例</label>
                        <div class="col-lg-6">
                            <input type="hidden" name="types[]" value="commission_ratio_level_3">
                            <input type="number" min="0" max="100" step="0.01" name="commission_ratio_level_3" class="form-control" value="<?php echo e(get_setting('commission_ratio_level_3')); ?>">
                        </div>
                        <div class="col-lg-2">
                            %
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><?php echo e(translate('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="card bg-gray-light">
            <div class="card-header">
                <h5 class="mb-0 h6">
                    <i><?php echo e(translate('N:B: You can not enable Single Product Sharing Affiliate and Category Wise Affiliate at a time.')); ?></i>
                </h5>
            </div>
        </div>
    </div>



   
   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#commission_status").on('click', function(){
                clickSwitch()
            });

            var clickSwitch = function() {
                if ($("#commission_status").is(':checked')) {
                    $("#commission_status").val(1)
                } else {
                    $("#commission_status").val(0)
                }
            };
        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/longkubz1/public_html/resources/views/affiliate/index.blade.php ENDPATH**/ ?>