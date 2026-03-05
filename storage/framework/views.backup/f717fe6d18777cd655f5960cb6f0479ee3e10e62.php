

<?php $__env->startSection('content'); ?>
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 mx-auto">
                    <div class="card">
                        <div class="text-center pt-5">
                            <h1 class="h2 fw-600">
                                <?php echo e(translate('Phone Verification')); ?>

                            </h1>
                            <p>Verification code has been sent. Please wait a few minutes.</p>
                            <a href="<?php echo e(route('verification.phone.resend')); ?>" class="btn btn-link"><?php echo e(translate('Resend Code')); ?></a>
                        </div>
                        <div class="px-5 py-lg-5">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg">
                                    <form class="form-default" role="form" action="<?php echo e(route('verification.submit')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="form-control" name="verification_code">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(translate('Verify')); ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/longkubz1/public_html/resources/views/otp_systems/frontend/user_verification.blade.php ENDPATH**/ ?>