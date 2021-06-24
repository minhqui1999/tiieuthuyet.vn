<?php $__env->startSection('title', 'Tiểu Thuyết - ' . \App\Option::getvalue('sitename')); ?>
<?php $__env->startSection('seo'); ?>
    <meta name="description" content="<?php echo e(\App\Option::getvalue('description')); ?>" />
    <meta name="keywords" content="<?php echo e(\App\Option::getvalue('keyword')); ?>" />
    <meta name='ROBOTS' content='INDEX, FOLLOW' />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://tieuthuyet.vn/" />
    <meta property="og:site_name" content="Trang Chủ" />
    <meta property="og:title" content="Tiểu Thuyết -  <?php echo e(\App\Option::getvalue('sitename')); ?>" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:description" content="<?php echo e(\App\Option::getvalue('description')); ?>" />
    <meta property="og:image" content="https://tieuthuyet.vn/assets/css/img/logo200x200.png" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@TanVo1999" />
    <meta name="twitter:title" content="Tiểu Thuyết -  <?php echo e(\App\Option::getvalue('sitename')); ?>" />
    <meta name="twitter:description" content="<?php echo e(\App\Option::getvalue('description')); ?>" />
    <meta name="twitter:image" content="https://tieuthuyet.vn/assets/css/img/logo200x200.png" />
    <link rel="canonical" href="https://tieuthuyet.vn/" />
    <link href="https://tieuthuyet.vn/" hreflang="vi-vn" rel="alternate" />
    <link data-page-subject="true" href="https://tieuthuyet.vn/assets/css/img/logo200x200.png" rel="image_src" />
    <script type="application/ld+json"> 
    { 
        "@context":"https://schema.org", 
        "@type":"WebSite", 
        "name":"Tiểu Thuyết - <?php echo e(\App\Option::getvalue('sitename')); ?>", 
        "alternateName":"Tiểu Thuyết - <?php echo e(\App\Option::getvalue('sitename')); ?>", 
        "url":"https://tieuthuyet.vn/",
        "description" : "<?php echo e(\App\Option::getvalue('description')); ?>",
        "sameAs": [
            "https://www.facebook.com/www.phimtruyen.vn",
            "https://www.instagram.com/tanvo1999/",
            "https://www.linkedin.com/in/minh-tan-vo-a402ba196/",
            "https://twitter.com/TanVo1999"
        ]
    } 
    </script>
    <!-- <script>    (function(c,l,a,r,i,t,y){        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);    })(window, document, "clarity", "script", "5wakjtiaor");</script> -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb', showBreadcrumb()); ?>
<?php $__env->startSection('content'); ?>
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=764582287768925&autoLogAppEvents=1" nonce="GTeFt4c7"></script> -->
    <div class="container visible-md-block visible-lg-block" id="intro-index">
        <div class="title-list">
            <h2><a href="<?php echo e(route('danhsach.truyenhot')); ?>" title="Truyện hot">Truyện hot <span class="glyphicon glyphicon-fire"></span></a></h2>
            <select id="hot-select" class="form-control new-select">
                <option value="all">Tất cả</option>
                <?php echo e(category_parent(\App\Category::get())); ?>

            </select>
        </div>
        <div class="index-intro">
            <?php echo \App\Story::getListHotStories(); ?>

        </div>
        <?php echo \App\Story::getListAudioStories(); ?>

    </div>
    <div class="ads container">
        <?php echo $__env->make('widgets.asd_ngang', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="container" id="list-index">
      <?php echo $__env->make('partials.reading', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="list list-truyen list-new col-xs-12 col-sm-12 col-md-8 col-truyen-main">
            <div class="title-list">
                <h2><a href="<?php echo e(route('danhsach.truyenmoi')); ?>" title="Truyện mới">Truyện mới cập nhật <span class="glyphicon glyphicon-menu-right"></span></a></h2>
                <select id="new-select" class="form-control new-select">
                    <option value="all">Tất cả</option>
                    <?php echo e(category_parent(\App\Category::get())); ?>

                </select>
            </div>
                <?php echo \App\Story::getListNewStories(); ?>

        </div>

        <?php /*Sidebar*/ ?>
        <div class="visible-md-block visible-lg-block col-md-4 text-center col-truyen-side">
            <?php echo $__env->make('widgets.categories', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php /*<?php echo $__env->make('widgets.facebook', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
            <div class="list-truyen list-cat col-xs-12">
                <?php echo $__env->make('widgets.ads', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>

    <?php echo \App\Story::getListDoneStories(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>