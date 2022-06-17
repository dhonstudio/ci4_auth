<!DOCTYPE html>

<head>
    <!-- templatemo 418 form pack -->
    <!-- 
    Form Pack
    http://www.templatemo.com/preview/templatemo_418_form_pack 
    -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url("/{$favicon}"); ?>" />
    <title><?= $title ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
    <link href="<?= base_url('/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('/css/bootstrap-theme.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('/css/bootstrap-social.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('/css/templatemo_style.css') ?>" rel="stylesheet" type="text/css">
</head>

<?= $this->renderSection('content'); ?>

</html>