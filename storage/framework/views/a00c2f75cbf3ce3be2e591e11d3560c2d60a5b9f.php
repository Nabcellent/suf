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
    <tr><td>&nbsp;</td></tr>
    <tr>
        <th>Welcome to SU-Fashion Store.✔<br> Please Click on the link below to activate your account:</th>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
            <a href="<?php echo e(url('confirm/' . $code)); ?>">Confirm & Activate ✔</a>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Kind Regards!<?php if($gender === "Male"): ?> 💪🏾 <?php else: ?> 🤗 <?php endif; ?> </td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><th>SU-FASHION STORE 👚</th></tr>
    </tbody>
</table>
</body>
</html>
<?php /**PATH /home/nabcellent-7/Desktop/PHP/My Projects/suf-laravel/resources/views/emails/confirmation.blade.php ENDPATH**/ ?>