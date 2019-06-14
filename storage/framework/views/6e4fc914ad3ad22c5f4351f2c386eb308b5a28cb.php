<?php $__env->startSection('title', 'Users List'); ?>
<?php $__env->startSection('content-head', 'Users List'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="<?php echo e(route('permissions.index')); ?>"><i class="fa fa-life-saver"></i> Permissions</a>
                            <a class="btn btn-info"  href="<?php echo e(route('roles.index')); ?>"><i class="fa fa-list-alt"></i> Roles</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="<?php echo e(route('users.create')); ?>"><i class="fa fa-plus"></i> Add User</a>
                        </div>
                        <br>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date/Time Added</th>
                                <th>User Roles</th>
                                <th>Operations</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->created_at->format('F d, Y h:ia')); ?></td>
                                    <td><?php echo e($user->roles()->pluck('name')->implode(' ')); ?></td>
                                    <td class="">
                                        <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-sm btn-info pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i> </a>

                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]); ?>

                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        <?php echo Form::close(); ?>

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