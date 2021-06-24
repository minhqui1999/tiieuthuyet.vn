<?php foreach($r_comments as $r_comment): ?>
    <li class="list-group-item" style="padding-bottom: 0px;">
        <article class="row">
            <div class="col-md-2 col-sm-2 col-xs-3 padding-mobile-cmt">
                <?php if($r_comment->user->avatar): ?>
                <img src="<?php echo $r_comment->user->avatar; ?>" class="img-responsive img-thumbnail" alt="User Image">
                <?php else: ?>
                <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $r_comment->user->email ) ) ); ?>?s=90&d=mp" class="img-responsive img-thumbnail" alt="User Image">
                <?php endif; ?>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-9 padding-mobile-cmt">
                <div class="panel panel-default arrow left">
                    <div class="panel-body">
                        <lable style="font-size: initial; font-weight: bold; color: blue;" for=""><?php echo e($r_comment->user->name); ?>&nbsp;</lable>
                        <span style="font-size: 11px; color: indianred;"> 
                            <span class="glyphicon glyphicon-time"></span> 
                            <?php echo Carbon\Carbon::setLocale('vi'); ?><?php echo $r_comment->created_at->diffForHumans(Carbon\Carbon::now()); ?> 
                        </span>
                        <div class="comment-post">
                            <span for=""><?php echo e($r_comment->content); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </li>
<?php endforeach; ?>
<?php if($r_comments->count()>4): ?>
<script>
    $('.more_r_comment<?php echo e($r_comments[0]->comment_chapter_id); ?>').css("display","flex");
    $('.more_r_comment<?php echo e($r_comments[0]->comment_story_id); ?>').css("display","flex");
</script>
<?php endif; ?>