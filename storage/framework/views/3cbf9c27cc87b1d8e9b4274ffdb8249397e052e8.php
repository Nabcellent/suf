<?php $__env->startSection('title', 'Contact'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="contact_us">
<!--    Start Content Area    -->

    <div id="content">
        <div class="container contact_page_container">

            <!--    Start Page Header    -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 px-0">
                        <div class="card-header contact_header">
                            <h2>Contact Us</h2>
                            <div class="underline"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--    End Page Header    -->

            <div class="row justify-content-center py-2">

                <!--    Start Contact Section    -->
                <div class="col-lg-5 col-md-12">
                    <div class="card info_card">
                        <div class="row">
                            <div class="col">
                                <p>If you have any queries, Please write to us. <br> We shall help.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row info_row">
                                <div class="col-auto">
                                    <div class="info_icon">
                                        <a href="tel:+254-110-039-317"><i class="fas fa-location-arrow"></i></a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col info_text">Lokeshenn</div>
                                    </div>
                                    <div class="row">
                                        <div class="col info_link">
                                            <a href="tel:+254-110-039-317">Madaraka University, <br> Nairobi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row info_row">
                                <div class="col-auto">
                                    <div class="info_icon">
                                        <a href="tel:+254-110-039-317"><i class="fas fa-phone"></i></a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col info_text">Phone</div>
                                    </div>
                                    <div class="row">
                                        <div class="col info_link">
                                            <a href="tel:+254-110-039-317">+254-110-039-317</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row info_row">
                                <div class="col-auto">
                                    <div class="info_icon">
                                        <a href="mailto:su.fashion10@gmail.com" target="_blank">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col info_text">Email</div>
                                    </div>
                                    <div class="row">
                                        <div class="col info_link">
                                            <a href="mailto:su.fashion10@gmail.com" target="_blank">su.fashion10@gmail.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="social_icons">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="card">
                        <div class="card-body anime_card">
                            <form id="contact_form" class="anime_form" action="<?php echo e(route('contact-us')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="first_name">First name *</label>
                                        <input type="text" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="first_name" name="first_name" placeholder="First name" required>
                                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="last_name">Last name *</label>
                                        <input type="text" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="last_name" name="last_name" placeholder="Last name" required>
                                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" placeholder="Your email address">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject *</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="subject" name="subject" placeholder="Your subject">
                                    <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message *</label>
                                    <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="message" rows="3" name="message" placeholder="Your message..." required></textarea>
                                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="morphic_btn morphic_btn_primary">
                                        <span><i class="far fa-envelope"></i> Send Message</span>
                                    </button>
                                    <img id="change_pass_gif" class="d-none loader_gif" src="<?php echo e(asset('images/loaders/Infinity-1s-197px.gif')); ?>" alt="loader.gif">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--    End Contact Section    -->

            </div>
        </div>
    </div>
    <!--    End Content Area    -->

</div>
<!--    End Sticky Header Jumbotron    -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/contact_us.blade.php ENDPATH**/ ?>