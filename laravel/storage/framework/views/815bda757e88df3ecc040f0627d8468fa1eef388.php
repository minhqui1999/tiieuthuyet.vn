<?php $__env->startSection('title', $data['title'] . ' | TieuThuyet.VN'); ?>
<?php $__env->startSection('seo'); ?>
    <meta name="description" content="<?php echo e($data['description']); ?>">
    <meta name="keywords" content="<?php echo e($data['keyword']); ?>">
    <meta name='ROBOTS' content='INDEX, FOLLOW'/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e($data['alias']); ?>">
    <meta property="og:site_name" content="<?php echo e($data['title']); ?>">
    <meta property="og:title" content="<?php echo e($data['title']); ?>">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:description" content="<?php echo e($data['description']); ?>">
    <link href="<?php echo e($data['alias']); ?>" hreflang="vi-vn" rel="alternate" />
    <link rel="canonical" href="<?php echo e($data['alias']); ?>"/>
    <script type="application/ld+json"> 
    { 
        "@context":"https://schema.org", 
        "@type":"WebSite", 
        "name":"<?php echo e($data['title']); ?>", 
        "alternateName":"<?php echo e($data['title']); ?>", 
        "url":"<?php echo e($data['alias']); ?>",
        "description":"<?php echo e($data['description']); ?>",
        "sameAs": [
            "https://www.facebook.com/www.phimtruyen.vn",
            "https://www.instagram.com/tanvo1999/",
            "https://www.linkedin.com/in/minh-tan-vo-a402ba196/",
            "https://twitter.com/TanVo1999"
        ]
    } 
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb', showBreadcrumb($breadcrumb)); ?>
<?php $__env->startSection('content'); ?>
<?php /*<?php echo $__env->make('widgets.asd_ngang', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
    <div class="container" id="list-page">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="list list-truyen col-xs-12">
                <div class="title-list">
                    <h2><?php echo e($data['title']); ?></h2>

                    <?php if($data['alias'] != route('danhsach.truyenfull')): ?>
                        <div class="filter"><a href="?filter=full">Chỉ hiện truyện đã hoàn (full)</a></div>
                    <?php endif; ?>
                </div>
                <?php foreach( $data['stories'] as $story): ?>
                    <div class="row" itemscope="" itemtype="http://schema.org/Book">
                        <div class="col-xs-3">
                            <div>
                                <img itemprop="image" class="visible-sm-block visible-md-block visible-lg-block" src="<?php echo e(url(dqhImageThumb($story->image, true))); ?>" alt="<?php echo e($story->name); ?>">
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div>
                                <span class="glyphicon glyphicon-book"></span>
                                <h3 class="truyen-title" itemprop="name">
                                    <a href="<?php echo e(route('story.show', $story->alias)); ?>" itemprop="url" title="<?php echo e($story->name); ?>"><?php echo e($story->name); ?></a>
                                </h3>
                                <?php if($story->status == 1): ?>
                                    <span class="label-title label-full"></span>
                                <?php endif; ?>
                                <?php if((strtotime('now') - strtotime($story->created_at)) < 86400*2): ?>
                                    <span class="label-title label-new"></span>
                                <?php endif; ?>
                                <?php if($story->view >=1000): ?>
                                    <span class="label-title label-hot"></span>
                                <?php endif; ?>
                                <?php foreach($story->authors as $author): ?>
                                    <span class="author" itemprop="author">
                                        <span class="glyphicon glyphicon-pencil"></span><a itemprop="url" href="<?php echo e(route('author.list.index', $author->alias)); ?>"><?php echo e($author->name); ?></a>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php $chapter = $story->chapters()->orderBy('id', 'DESC')->first(); ?>
                        <?php if($chapter): ?>
                        <div class="col-xs-2 text-info">
                            <div>
                                <a href="<?php echo e(route('chapter.show', [$story->alias, $chapter->alias])); ?>" title="<?php echo e($chapter->name); ?>"><span class="chapter-text"><?php echo e($chapter->subname); ?></span></a>
                            </div>
                        </div>
                        <?php else: ?>
                        ......
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="container text-center pagination-container">
                <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                    <?php echo e($data['stories']->links()); ?>

                </div>
            </div>
        </div>

        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            <?php if(isset($data['description'])): ?>
                <div class="panel cat-desc text-left visible-lg">
                    <div class="panel-body">
                       <?php echo nl2br($data['description']); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php echo $__env->make('widgets.categories', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('widgets.hotstory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <?php /* <?php echo $__env->make('widgets.ads', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>