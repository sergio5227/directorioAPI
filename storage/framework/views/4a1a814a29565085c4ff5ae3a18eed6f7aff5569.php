<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <body class="antialiased">
    <h1><?php echo e($titulo); ?>.</h1>
    <br>
    <?php echo $html; ?>

    <br>
    </body>
</html>
<?php /**PATH C:\wamp64\www\API_FX\resources\views/mail.blade.php ENDPATH**/ ?>