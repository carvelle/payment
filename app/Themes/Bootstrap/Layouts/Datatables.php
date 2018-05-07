<?php
/**
 * Default Layout - a Layout similar with the classic Header and Footer files.
 */

// Generate the Language Changer menu.
$language = Language::code();

$languages = Config::get('languages');

//
ob_start();

foreach ($languages as $code => $info) {
?>
<li <?php if($language == $code) echo 'class="active"'; ?>>
    <a href='<?= site_url('language/' .$code); ?>' title='<?= $info['info']; ?>'><?= $info['name']; ?></a>
</li>
<?php
}

$langMenuLinks = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="<?= $language; ?>">
<head>
    <meta charset="utf-8">
    <title><?= $title .' - ' .Config::get('app.name', SITETITLE); ?></title>
    <meta charset="utf-8">
    <title>AFN</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
   

</head>
    
    
    
    
<?php
echo isset($meta) ? $meta : ''; // Place to pass data / plugable hook zone

Assets::css([
    vendor_url('dist/css/bootstrap.min.css', 'twbs/bootstrap'),
    vendor_url('dist/css/bootstrap-theme.min.css', 'twbs/bootstrap'),
    'http://fonts.googleapis.com/css?family=Open+Sans:400,700',
    theme_url('css/style.css', 'Bootstrap'),
    theme_url('lib/bootstrap/css/bootstrap.css', 'Bootstrap'),
    theme_url('lib/font-awesome/css/font-awesome.css', 'Bootstrap'),
    theme_url('css/theme.css', 'Bootstrap'),
    theme_url('css/premium.css', 'Bootstrap'),
    
]);
    
Assets::js([
    theme_url('lib/jquery-1.12.4.js', 'Bootstrap'),
    theme_url('lib/datatables/jquery.dataTables.min.js', 'Bootstrap'),
    theme_url('lib/datatables/dataTables.bootstrap.js', 'Bootstrap'),
    theme_url('lib/datatables/jquery.dataTables.min.js', 'Bootstrap'),
    theme_url('lib/jQuery-Knob/js/jquery.knob.js', 'Bootstrap'),
    theme_url('lib/bootstrap/js/bootstrap.min.js', 'Bootstrap'),
]);

    
    
echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone
?>
</head>
<body class=" theme-blue">


<?= isset($afterBody) ? $afterBody : ''; // Place to pass data / plugable hook zone ?>


    <?= $content; ?>


<footer class="footer">
    <div class="container-fluid">
        <div class="row" style="margin: 15px 0 0;">
            <div class="col-lg-4">
                <p class="text-muted">Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.novaframework.com/" target="_blank"><b>Nova Framework <?= $version; ?> / Kernel <?= VERSION; ?></b></a></p>
            </div>
            <div class="col-lg-8">
                <p class="text-muted pull-right">
                    <?php if(Config::get('app.debug')) { ?>
                    <small><!-- DO NOT DELETE! - Profiler --></small>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php

    

echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

echo isset($footer) ? $footer : ''; // Place to pass data / plugable hook zone
?>

<!-- DO NOT DELETE! - Forensics Profiler -->

</body>
</html>
