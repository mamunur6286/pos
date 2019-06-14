<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
            <li><a><i class="fa fa-book"></i> Relationship <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo e(url('customers')); ?>">Customers </a></li>
                    <li><a href="<?php echo e(url('suppliers')); ?>">Suppliers </a></li>
                </ul>
            </li>
            <li><a href="<?php echo e(url('items')); ?>"><i class="fa fa-product-hunt"></i> Products </a></li>
            <li><a><i class="fa fa-book"></i> Sales & Purchase<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo e(route('purchases.index')); ?>">Purchase
                    <li><a href="<?php echo e(route('invoices.index')); ?>">Invoice</a></li>

                </ul>
            </li>
            <li><a href="<?php echo e(url('users')); ?>"><i class="fa fa-user-circle"></i> Users</a></li>
            <li><a><i class="fa fa-book"></i> Setting <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo e(url('units')); ?>">Units</a></li>
                    <li><a href="<?php echo e(url('categories')); ?>">Categories</a></li>
                </ul>
            </li>
        </ul>
    </div>


</div>