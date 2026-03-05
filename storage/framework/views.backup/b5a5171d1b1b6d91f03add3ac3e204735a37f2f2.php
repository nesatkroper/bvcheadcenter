

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header row gutters-5">
         <div class="col text-center text-md-left">
           <h5 class="mb-md-0 h6"><?php echo e($language->name); ?></h5>
         </div>
         <div class="col-md-4">
           <form class="" id="sort_keys" action="" method="GET">
             <div class="input-group input-group-sm">
                 <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type key & Enter')); ?>">
             </div>
           </form>
         </div>
       </div>
        <form class="form-horizontal" action="<?php echo e(route('languages.key_value_store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo e($language->id); ?>">
            <div class="card-body">
                <table class="table table-striped table-bordered demo-dt-basic" id="tranlation-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="45%"><?php echo e(translate('Key')); ?></th>
                            <th width="45%"><?php echo e(translate('Value')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $lang_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(($key+1) + ($lang_keys->currentPage() - 1)*$lang_keys->perPage()); ?></td>
                                <td class="key"><?php echo e($translation->lang_value); ?></td>
                                <td>
                                    <input type="text" class="form-control value" style="width:100%" name="values[<?php echo e($translation->lang_key); ?>]" <?php if(($traslate_lang = \App\Models\Translation::where('lang', $language->code)->where('lang_key', $translation->lang_key)->latest()->first()) != null): ?>
                                        value="<?php echo e($traslate_lang->lang_value); ?>"
                                    <?php endif; ?>>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="aiz-pagination">
                   <?php echo e($lang_keys->appends(request()->input())->links()); ?>

                </div>

                <div class="form-group mb-0 text-right">
                    <button type="button" class="btn btn-primary" onclick="copyTranslation()"><?php echo e(translate('Copy Translations')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(translate('Save')); ?></button>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        //translate in one click
        function copyTranslation() {
            $('#tranlation-table > tbody  > tr').each(function (index, tr) {
                $(tr).find('.value').val($(tr).find('.key').text());
            });
        }

        function sort_keys(el){
            $('#sort_keys').submit();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/longkubz1/public_html/resources/views/backend/setup_configurations/languages/language_view.blade.php ENDPATH**/ ?>