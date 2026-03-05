    

    <?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('Paypal Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <input type="hidden" name="payment_method" value="paypal">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYPAL_CLIENT_ID">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Paypal Client Id')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYPAL_CLIENT_ID" value="<?php echo e(env('PAYPAL_CLIENT_ID')); ?>" placeholder="<?php echo e(translate('Paypal Client ID')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYPAL_CLIENT_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Paypal Client Secret')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYPAL_CLIENT_SECRET" value="<?php echo e(env('PAYPAL_CLIENT_SECRET')); ?>" placeholder="<?php echo e(translate('Paypal Client Secret')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Paypal Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="paypal_sandbox" type="checkbox" <?php if(get_setting('paypal_sandbox') == 1): ?>
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('Stripe Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="stripe">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="STRIPE_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Stripe Key')); ?></label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="STRIPE_KEY" value="<?php echo e(env('STRIPE_KEY')); ?>" placeholder="<?php echo e(translate('STRIPE KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="STRIPE_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Stripe Secret')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="STRIPE_SECRET" value="<?php echo e(env('STRIPE_SECRET')); ?>" placeholder="<?php echo e(translate('STRIPE SECRET')); ?>" required>
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
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('Mercadopago Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <input type="hidden" name="payment_method" value="paypal">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MERCADOPAGO_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Mercadopago Key')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MERCADOPAGO_KEY" value="<?php echo e(env('MERCADOPAGO_KEY')); ?>" placeholder="<?php echo e(translate('Mercadopago Key')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MERCADOPAGO_ACCESS">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Mercadopago Access')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MERCADOPAGO_ACCESS" value="<?php echo e(env('MERCADOPAGO_ACCESS')); ?>" placeholder="<?php echo e(translate('Mercadopago Access')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MERCADOPAGO_CURRENCY">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('MERCADOPAGO CURRENCY')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="MERCADOPAGO_CURRENCY" value="<?php echo e(env('MERCADOPAGO_CURRENCY')); ?>" placeholder="<?php echo e(translate('MERCADOPAGO CURRENCY')); ?>" required>
                                <br>
                                <div class="alert alert-primary" role="alert">
                                    Currency must be <b>es-AR</b> or <b>es-CL</b> or <b>es-CO</b> or <b>es-MX</b> or <b>es-VE</b> or <b>es-UY</b> or <b>es-PE</b> or <b>pt-BR</b><br>
                                    If kept empty, <b>en-US</b> will be used automatically
                                </div>
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
            <div class="card">
                <div class="card-header ">
                    <h5 class="mb-0 h6"><?php echo e(translate('Bkash Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="bkash">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_APP_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('BKASH CHECKOUT APP KEY')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="BKASH_CHECKOUT_APP_KEY" value="<?php echo e(env('BKASH_CHECKOUT_APP_KEY')); ?>" placeholder="<?php echo e(translate('BKASH CHECKOUT APP KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_APP_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('BKASH CHECKOUT APP SECRET')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="BKASH_CHECKOUT_APP_SECRET" value="<?php echo e(env('BKASH_CHECKOUT_APP_SECRET')); ?>" placeholder="<?php echo e(translate('BKASH CHECKOUT APP SECRET')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_USER_NAME">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('BKASH CHECKOUT USER NAME')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="BKASH_CHECKOUT_USER_NAME" value="<?php echo e(env('BKASH_CHECKOUT_USER_NAME')); ?>" placeholder="<?php echo e(translate('BKASH CHECKOUT USER NAME')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_PASSWORD">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('BKASH CHECKOUT PASSWORD')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="BKASH_CHECKOUT_PASSWORD" value="<?php echo e(env('BKASH_CHECKOUT_PASSWORD')); ?>" placeholder="<?php echo e(translate('BKASH CHECKOUT PASSWORD')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Bkash Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="bkash_sandbox" type="checkbox" <?php if(get_setting('bkash_sandbox') == 1): ?>
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('Nagad Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="nagad">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_MODE">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('NAGAD MODE')); ?></label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="NAGAD_MODE" value="<?php echo e(env('NAGAD_MODE')); ?>" placeholder="<?php echo e(translate('NAGAD MODE')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_ID">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('NAGAD MERCHANT ID')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NAGAD_MERCHANT_ID" value="<?php echo e(env('NAGAD_MERCHANT_ID')); ?>" placeholder="<?php echo e(translate('NAGAD MERCHANT ID')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_NUMBER">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('NAGAD MERCHANT NUMBER')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NAGAD_MERCHANT_NUMBER" value="<?php echo e(env('NAGAD_MERCHANT_NUMBER')); ?>" placeholder="<?php echo e(translate('NAGAD MERCHANT NUMBER')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_PG_PUBLIC_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('NAGAD PG PUBLIC KEY')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NAGAD_PG_PUBLIC_KEY" value="<?php echo e(env('NAGAD_PG_PUBLIC_KEY')); ?>" placeholder="<?php echo e(translate('NAGAD PG PUBLIC KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_PRIVATE_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('NAGAD MERCHANT PRIVATE KEY')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="NAGAD_MERCHANT_PRIVATE_KEY" value="<?php echo e(env('NAGAD_MERCHANT_PRIVATE_KEY')); ?>" placeholder="<?php echo e(translate('NAGAD MERCHANT PRIVATE KEY')); ?>" required>
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
            <div class="card">
                <div class="card-header ">
                    <h5 class="mb-0 h6"><?php echo e(translate('Sslcommerz Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="sslcommerz">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="SSLCZ_STORE_ID">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Sslcz Store Id')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="SSLCZ_STORE_ID" value="<?php echo e(env('SSLCZ_STORE_ID')); ?>" placeholder="<?php echo e(translate('Sslcz Store Id')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="SSLCZ_STORE_PASSWD">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Sslcz store password')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="SSLCZ_STORE_PASSWD" value="<?php echo e(env('SSLCZ_STORE_PASSWD')); ?>" placeholder="<?php echo e(translate('Sslcz store password')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Sslcommerz Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="sslcommerz_sandbox" type="checkbox" <?php if(get_setting('sslcommerz_sandbox') == 1): ?>
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header ">
                    <h5 class="mb-0 h6"><?php echo e(translate('Aamarpay Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="aamarpay">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="AAMARPAY_STORE_ID">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Aamarpay Store Id')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="AAMARPAY_STORE_ID" value="<?php echo e(env('AAMARPAY_STORE_ID')); ?>" placeholder="<?php echo e(translate('Aamarpay Store Id')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="AAMARPAY_SIGNATURE_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Aamarpay signature key')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="AAMARPAY_SIGNATURE_KEY" value="<?php echo e(env('AAMARPAY_SIGNATURE_KEY')); ?>" placeholder="<?php echo e(translate('Aamarpay signature key')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Aamarpay Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="aamarpay_sandbox" type="checkbox" <?php if(get_setting('aamarpay_sandbox') == 1): ?>
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
                    <h5 class="mb-0 h6"><?php echo e(translate('Iyzico Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="iyzico">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="IYZICO_API_KEY">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('IYZICO_API_KEY')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="IYZICO_API_KEY" value="<?php echo e(env('IYZICO_API_KEY')); ?>" placeholder="<?php echo e(translate('IYZICO API KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="IYZICO_SECRET_KEY">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('IYZICO_SECRET_KEY')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="IYZICO_SECRET_KEY" value="<?php echo e(env('IYZICO_SECRET_KEY')); ?>" placeholder="<?php echo e(translate('IYZICO SECRET KEY')); ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('IYZICO Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="iyzico_sandbox" type="checkbox" <?php if(get_setting('iyzico_sandbox') == 1): ?>
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('Instamojo Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="instamojo">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="IM_API_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('API KEY')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="IM_API_KEY" value="<?php echo e(env('IM_API_KEY')); ?>" placeholder="<?php echo e(translate('IM API KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="IM_AUTH_TOKEN">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('AUTH TOKEN')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="IM_AUTH_TOKEN" value="<?php echo e(env('IM_AUTH_TOKEN')); ?>" placeholder="<?php echo e(translate('IM AUTH TOKEN')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Instamojo Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="instamojo_sandbox" type="checkbox" <?php if(get_setting('instamojo_sandbox') == 1): ?>
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('PayStack Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="paystack">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYSTACK_PUBLIC_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('PUBLIC KEY')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYSTACK_PUBLIC_KEY" value="<?php echo e(env('PAYSTACK_PUBLIC_KEY')); ?>" placeholder="<?php echo e(translate('PUBLIC KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYSTACK_SECRET_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('SECRET KEY')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYSTACK_SECRET_KEY" value="<?php echo e(env('PAYSTACK_SECRET_KEY')); ?>" placeholder="<?php echo e(translate('SECRET KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MERCHANT_EMAIL">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('MERCHANT EMAIL')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MERCHANT_EMAIL" value="<?php echo e(env('MERCHANT_EMAIL')); ?>" placeholder="<?php echo e(translate('MERCHANT EMAIL')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYSTACK_CURRENCY_CODE">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('PAYSTACK CURRENCY CODE')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYSTACK_CURRENCY_CODE" value="<?php echo e(env('PAYSTACK_CURRENCY_CODE')); ?>" placeholder="<?php echo e(translate('PAYSTACK CURRENCY CODE')); ?>" required>
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
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('Payhere Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="payhere">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYHERE_MERCHANT_ID">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('PAYHERE MERCHANT ID')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYHERE_MERCHANT_ID" value="<?php echo e(env('PAYHERE_MERCHANT_ID')); ?>" placeholder="<?php echo e(translate('PAYHERE MERCHANT ID')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYHERE_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('PAYHERE SECRET')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYHERE_SECRET" value="<?php echo e(env('PAYHERE_SECRET')); ?>" placeholder="<?php echo e(translate('PAYHERE SECRET')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYHERE_CURRENCY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('PAYHERE CURRENCY')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="PAYHERE_CURRENCY" value="<?php echo e(env('PAYHERE_CURRENCY')); ?>" placeholder="<?php echo e(translate('PAYHERE CURRENCY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Payhere Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="payhere_sandbox" type="checkbox" <?php if(get_setting('payhere_sandbox') == 1): ?>
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
                    <h5 class="mb-0 h6"><?php echo e(translate('Ngenius Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="ngenius">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NGENIUS_OUTLET_ID">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('NGENIUS OUTLET ID')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="NGENIUS_OUTLET_ID" value="<?php echo e(env('NGENIUS_OUTLET_ID')); ?>" placeholder="<?php echo e(translate('NGENIUS OUTLET ID')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NGENIUS_API_KEY">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('NGENIUS API KEY')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="NGENIUS_API_KEY" value="<?php echo e(env('NGENIUS_API_KEY')); ?>" placeholder="<?php echo e(translate('NGENIUS API KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NGENIUS_CURRENCY">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('NGENIUS CURRENCY')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="NGENIUS_CURRENCY" value="<?php echo e(env('NGENIUS_CURRENCY')); ?>" placeholder="<?php echo e(translate('NGENIUS CURRENCY')); ?>" required>
                                <br>
                                <div class="alert alert-primary" role="alert">
                                    Currency must be <b>AED</b> or <b>USD</b> or <b>EUR</b><br>
                                    If kept empty, <b>AED</b> will be used automatically
                                </div>
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
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('VoguePay Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="voguepay">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="VOGUE_MERCHANT_ID">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('MERCHANT ID')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="VOGUE_MERCHANT_ID" value="<?php echo e(env('VOGUE_MERCHANT_ID')); ?>" placeholder="<?php echo e(translate('MERCHANT ID')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="voguepay_sandbox" type="checkbox" <?php if(get_setting('voguepay_sandbox') == 1): ?>
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 "><?php echo e(translate('RazorPay Credential')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="razorpay">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="RAZOR_KEY">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('RAZOR KEY')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="RAZOR_KEY" value="<?php echo e(env('RAZOR_KEY')); ?>" placeholder="<?php echo e(translate('RAZOR KEY')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="RAZOR_SECRET">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('RAZOR SECRET')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="RAZOR_SECRET" value="<?php echo e(env('RAZOR_SECRET')); ?>" placeholder="<?php echo e(translate('RAZOR SECRET')); ?>" required>
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
                    <h5 class="mb-0 h6"><?php echo e(translate('Authorize Net')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="authorizenet">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MERCHANT_LOGIN_ID">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('MERCHANT_LOGIN_ID')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="MERCHANT_LOGIN_ID" value="<?php echo e(env('MERCHANT_LOGIN_ID')); ?>" placeholder="<?php echo e(translate('MERCHANT LOGIN ID')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MERCHANT_TRANSACTION_KEY">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('MERCHANT_TRANSACTION_KEY')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="MERCHANT_TRANSACTION_KEY" value="<?php echo e(env('MERCHANT_TRANSACTION_KEY')); ?>" placeholder="<?php echo e(translate('MERCHANT TRANSACTION KEY')); ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-from-label"><?php echo e(translate('Authorize Net Sandbox Mode')); ?></label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="authorizenet_sandbox" type="checkbox" <?php if(get_setting('authorizenet_sandbox') == 1): ?>
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
                    <h5 class="mb-0 h6"><?php echo e(translate('Payku')); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('payment_method.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="payment_method" value="payku">
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYKU_BASE_URL">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('PAYKU_BASE_URL')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="PAYKU_BASE_URL" value="<?php echo e(env('PAYKU_BASE_URL')); ?>" placeholder="<?php echo e(translate('PAYKU_BASE_URL')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYKU_PUBLIC_TOKEN">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('PAYKU_PUBLIC_TOKEN')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="PAYKU_PUBLIC_TOKEN" value="<?php echo e(env('PAYKU_PUBLIC_TOKEN')); ?>" placeholder="<?php echo e(translate('PAYKU_PUBLIC_TOKEN')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="PAYKU_PRIVATE_TOKEN">
                            <div class="col-lg-4">
                                <label class="col-from-label"><?php echo e(translate('PAYKU_PRIVATE_TOKEN')); ?></label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="PAYKU_PRIVATE_TOKEN" value="<?php echo e(env('PAYKU_PRIVATE_TOKEN')); ?>" placeholder="<?php echo e(translate('PAYKU_PRIVATE_TOKEN')); ?>" required>
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

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/longkubz1/public_html/resources/views/backend/setup_configurations/payment_method.blade.php ENDPATH**/ ?>