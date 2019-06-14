<?php $__env->startSection('title', 'Items Lists Table'); ?>
<?php $__env->startSection('content-head', 'Items List'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="<?php echo e(url('item/import')); ?>"><i class="fa fa-upload"></i> Import Excel</a>
                            <a class="btn btn-info"  href="<?php echo e(url('item/export')); ?>"><i class="fa fa-download"></i> Export Excel</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="<?php echo e(route('items.create')); ?>"><i class="fa fa-plus"></i> Add Product</a>
                            <br>
                        </div>

                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Description</th>
                            <th>Photos</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php ($i=1); ?>
                        <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e($value->name); ?></td>
                                <td><?php echo e($value->category->name); ?></td>
                                <td><?php echo e($value->unit->name); ?></td>
                                <td><?php echo e($value->description); ?></td>
                                <td>
                                    <img src="<?php echo e(asset('/')); ?>files/<?php echo e($value->photo); ?>" width="50px" height="50px" alt="">
                                </td>
                                <td><?php echo e($value->comments); ?></td>
                                <td class="text-center">
                                    <div class="row">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit')): ?>
                                        <div class="col-md-4">
                                            <a href="<?php echo e(route('items.show',$value->id)); ?>" class="btn btn-sm btn-success"><i class="fa fa-eye-slash"></i> </a>
                                        </div>
                                            <div class="col-md-4">
                                            <a href="<?php echo e(route('items.edit',$value->id)); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                                            <div class="col-md-4">
                                                <?php echo Form::open([ 'method'=>'delete','route'=>['items.destroy',$value->id],'onclick'=>" return confirm('Are you sure to delete this image?')"]); ?>

                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>