<?php if(session('alert')): ?>
    <div id="global_alert" class="alert alert-<?php echo e(session('alert')['type']); ?> alert-dismissible fade show" role="alert">
        <strong><?php echo e(session('alert')['intro']); ?></strong> <?php echo e(session('alert')['message']); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/partials/alert.blade.php ENDPATH**/ ?>