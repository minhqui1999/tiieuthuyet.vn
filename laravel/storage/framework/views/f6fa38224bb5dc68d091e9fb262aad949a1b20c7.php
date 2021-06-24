<?php $__env->startSection('title', 'Danh sách truyện'); ?>
<?php $__env->startSection('smallTitle', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="box box-primary"><div class="box-body">
<p class="pull-left"><a href="<?php echo e(URL::route('dashboard.story.create')); ?>" class="btn btn-primary">Thêm truyện mới</a></p>
<?php echo $__env->make('admin.block.searchbox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<table class="table table-striped table-bordered table-hover" id="dataTableLists">
    <thead>
        <tr align="center">
            <th>Tên truyện</th>
            <th>Chuyên mục</th>
            <th>Tác giả</th>
            <?php if(Auth::user()->isAdmin()): ?>
            <th>Người Đăng</th>
            <?php endif; ?>
            <th>Số Chương</th>
            <th>Công cụ</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($data as $item): ?>
        <tr class="odd gradeX" align="left">
            <td><?php echo dqhStatusStoryShow($item->status); ?> <a href="<?php echo e(route('story.show', $item->alias)); ?>"><?php echo e($item->name); ?></a></td>
            <td>
            <?php echo the_category($item->categories); ?>

            </td>
            <td>
            <?php echo the_author($item->authors); ?>

            </td>
            <?php if(Auth::user()->isAdmin()): ?>
            <td>
                <?php echo e($item->user->name); ?>

            </td>
            <?php endif; ?>
            <td>
                <?php echo e($item->chapters->count()); ?>

            </td>
            <td>

                <form action="<?php echo e(route('dashboard.story.destroy', $item->id)); ?>" method="POST" class="form-inline">
                    <a class="btn btn-info btn-xs" href="<?php echo e(URL::route('dashboard.chapter.list', $item->id)); ?>">
                        <i class="fa fa-book fa-fw"></i> Quản lý chương
                    </a>
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <a class="btn btn-primary btn-xs" href="<?php echo e(URL::route('dashboard.story.edit', $item->id)); ?>">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                    <button type="submit" name="submitF" value="X" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn xóa nó không ?');">
                        <i class="fa fa-trash-o  fa-fw"></i> Xóa
                    </button>
                    <?php if(Auth::user()->isAdmin() && $title=='Chưa phê duyệt'): ?>
                    <button type="submit" name="submitF" value="HT" class="btn btn-success btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn nó hiển thị không ?');">
                        <i class="fa fa-check fa-fw"></i> Cho phép hiển thị
                    </button>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php if(Request::has('q')): ?>
    <?php echo $data->appends(
    ['type' => Request::get('type'),
     'q'    => Request::get('q')]
    )->links(); ?>

<?php else: ?>
    <?php echo $data->links(); ?>

<?php endif; ?>
</div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>