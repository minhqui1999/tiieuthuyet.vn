<div class="container" id="truyen-slide">
    <div class="list list-thumbnail col-xs-12">
        <div class="title-list"><h2><a href="<?php echo e(route('danhsach.truyenaudio')); ?>" title="Truyện Audio">Truyện Audio</a></h2><span class="glyphicon glyphicon-headphones"></span></a></div>
        <div class="row">
            <?php if($stories): ?>
                <?php foreach($stories as $story): ?>
                    <?php
                    $chapter = $story->chapters()->orderBy('created_at', 'DESC')->first();
                    ?>
                    <div class="col-xs-4 col-sm-3 col-md-2">
                        <a href="<?php echo e(route('audio.show', $story->alias)); ?>" title="<?php echo e($story->name); ?>">
                            <img src="<?php echo e(url($story->image)); ?>" alt="<?php echo e($story->name); ?>">
                            <?php if($story->view >= 1000): ?>
                            <span class="icon icon-hot" style="top:6px; right:8%;"></span>
                            <?php endif; ?>
                            <div class="caption">
                                <h3><?php echo e($story->name); ?></h3>
                                <small class="btn-xs label-primary">Hoàn thành - <?php echo e($story->chapters()->count()); ?> chương</small>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có bài viết nào ở đây !</p>
            <?php endif; ?>
        </div>

    </div>
</div>