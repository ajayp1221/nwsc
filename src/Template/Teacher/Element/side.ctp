<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $authuser->android_api_img_medium; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $authuser->full_name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php if($authuser->role=="ACCOUNT"){?>
                <li><?= $this->Html->link(__("<i class='fa fa-th'></i>Classroom"),['controller' => 'classrooms', 'action' => 'fee'],['escape' => false]) ?></li>
            <?php }else{?>
                <li><?= $this->Html->link(__("<i class='fa fa-dashboard'></i>Time-Table List"),['controller' => 'timetables', 'action' => 'index'],['escape' => false]) ?></li>
                <li><?= $this->Html->link(__("<i class='fa fa-calendar'></i>Holidays"),['controller' => 'holidays', 'action' => 'index'],['escape' => false]) ?></li>
                <li><?= $this->Html->link(__("<i class='fa fa-th'></i>Classrooms"),['controller' => 'classrooms', 'action' => 'index'],['escape' => false]) ?></li>
                <li><?= $this->Html->link(__("<i class='fa fa-folder'></i>Homeworks"),['controller' => 'homeworks', 'action' => 'index'],['escape' => false]) ?></li>
                <li><?= $this->Html->link(__("<i class='fa fa-book'></i>Results"),['controller' => 'results', 'action' => 'index'],['escape' => false]) ?></li>
            <?php }?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>