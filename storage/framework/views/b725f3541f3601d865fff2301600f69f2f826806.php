<?php if(session('alert')): ?>
    <div id="global_alert" class="alert alert-<?php echo e(session('alert')['type']); ?> alert-dismissible fade show shadow-lg" role="alert"
         data-duration="<?php echo e(session('alert')['duration']); ?>">
        <strong><?php echo e(session('alert')['intro']); ?></strong> <?php echo e(session('alert')['message']); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!--<div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert" data-duration="7">
    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>-->
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/Admin/include/alert.blade.php ENDPATH**/ ?>