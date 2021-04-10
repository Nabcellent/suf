<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body>
<table class="table">
    <thead>
    <tr><th scope="col">Dear <?php echo e($firstName); ?><?php if($gender === "Male"): ?> ️💆🏽‍♂ <?php else: ?> 💆🏽‍♀ <?php endif; ?>,</th></tr>
    </thead>
    <tbody>
    <tr>
        <th>Welcome to SU-Fashion Store!</th>
        <th>Your account has been activated.✔<br> Below are your account details:</th>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Name: <?php echo e($firstName); ?> <?php echo e($lastName); ?></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Phone Number: +254 <?php echo e($phone); ?></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Gender: <?php echo e($gender); ?></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Email: <?php echo e($email); ?></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Password: ******* (As chosen by You.)</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thank you for joining us.<?php if($gender === "Male"): ?> 💪🏾 <?php else: ?> 🤗 <?php endif; ?> <br>Kind Regards!</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><th>SU-FASHION STORE 👚</th></tr>
    </tbody>
</table>
</body>
</html>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/emails/register.blade.php ENDPATH**/ ?>