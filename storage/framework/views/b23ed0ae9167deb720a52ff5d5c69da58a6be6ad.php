<?php if(Session::has('commonData')): ?>
<? $commonData=Session::get('commonData'); 
    $info=DB::table('about_company')->first();
?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="We provides complete solution packages 
                 for building website and online advertising.">

    <meta http-equiv=”X-UA-Compatible” content=”IE=EmulateIE9”>
    <meta http-equiv=”X-UA-Compatible” content=”IE=9”>

    
    <title>Dashboard | <?php echo e($commonData['primaryInfo']->company_name); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset($info->favicon)); ?>">
    <!--Core CSS -->
    <link href="<?php echo e(asset('public/backend/bs3/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/backend/js/jquery-ui/jquery-ui-1.10.1.custom.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/backend/css/bootstrap-reset.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/backend/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/backend/js/jvector-map/jquery-jvectormap-1.2.2.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/backend/css/clndr.css')); ?>" rel="stylesheet">
    <!--dynamic table-->
    <link href="<?php echo e(asset('public/backend/js/advanced-datatable/css/demo_page.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/backend/js/advanced-datatable/css/demo_table.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backend/js/data-tables/DT_bootstrap.css')); ?>" />
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!--clock css-->
    <link href="<?php echo e(asset('public/backend/css/chosen.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('public/backend/js/css3clock/css/style.css')); ?>" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/backend/js/morris-chart/morris.css')); ?>">
    <!-- Custom styles for this template -->
    <link href="<?php echo e(asset('public/backend/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/backend/css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/backend/css/style-responsive.css')); ?>" rel="stylesheet"/>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>