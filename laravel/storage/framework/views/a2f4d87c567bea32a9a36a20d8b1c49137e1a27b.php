<?php if($stories): ?>
    <?php $count = 1;?>
    <?php foreach($stories as $story): ?>
        <div class="item top-<?php echo e($count); ?>" itemscope="" itemtype="http://schema.org/Book">
            <a href="<?php echo e(route('story.show', $story->alias)); ?>" itemprop="url">
                <?php if($story->status == 1): ?>
                <span class="full-label"></span>
                <?php endif; ?>
                <img src="<?php echo e(url($story->image)); ?>" alt="<?php echo e($story->name); ?>" class="img-responsive" itemprop="image">
                <?php if($story->view >= 1000): ?>
                <span class="icon icon-hot"></span>
                <?php endif; ?>
                <div class="title">
                    <h3 itemprop="name"><?php echo e($story->name); ?></h3>
                </div>
                <div class="title view-hot-story">
                    <h3 style="margin-left: 6%;"><span class="glyphicon glyphicon-eye-open"> </span> <?php echo e(number_format($story->view)); ?> </h3>
                </div>
            </a>
        </div>
        <?php $count++;?>
    <?php endforeach; ?>
<?php else: ?>
    <p>Không có bài viết nào ở đây !</p>
<?php endif; ?>