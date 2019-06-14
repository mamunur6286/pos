<?php $__env->startSection('title', 'Customers List'); ?>
<?php $__env->startSection('content-head', 'Customers List'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="x_content table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-info"  href="<?php echo e(url('customer/import')); ?>"><i class="fa fa-upload"></i> Import Excel</a>
                            <a class="btn btn-info"  href="<?php echo e(url('customer/export')); ?>"><i class="fa fa-download"></i> Export Excel</a>
                            <br>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-info" href="<?php echo e(route('customers.create')); ?>"><i class="fa fa-plus"></i> Add Customer</a>
                            <br>
                        </div>

                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <?php ($i=1); ?>
                        <tbody>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e($customer->name); ?></td>
                                <td>
                                    <img src="<?php echo e(asset('/')); ?><?php echo e($customer->image); ?>" width="50px" height="50px" alt="">

                                </td>
                                <td><?php echo e($customer->mobile); ?></td>
                                <td><?php echo e($customer->email); ?></td>
                                <td><?php echo e($customer->city); ?></td>
                                <td><?php echo e($customer->country); ?></td>
                                <td><?php echo e($customer->address); ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?php echo e(route('customers.edit',$customer->id)); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo Form::open([ 'method'=>'delete','route'=>['customers.destroy',$customer->id],'onclick'=>" return confirm('Are you sure to delete this customer?')"]); ?>

                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
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