<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Add New'), ['action' => 'add']) ?></li>
        <?php if($authUser['role']=="USER"){ ?>
            <li><?= $this->Html->link(__('Settings'), ['controller' => 'settings', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Select School'), ['controller' => 'schools', 'action' => 'selectschool']) ?></li>
            <li><?= $this->Html->link(__('Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Students'), ['controller' => 'students', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Holidays'), ['controller' => 'holidays', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Classrooms'), ['controller' => 'classrooms', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Schoolfees'), ['controller' => 'schoolfees', 'action' => 'index']) ?></li>
            <!--<li><?= $this->Html->link(__('Exam Timetable'), ['controller' => 'examstables', 'action' => 'index']) ?></li>-->
            <li><?= $this->Html->link(__('Result Category'), ['controller' => 'resultcategories', 'action' => 'index']) ?></li>
        <?php }elseif($authUser['role']=="ADMIN" || $authUser['role']=="HELPER"){?>
            <li><?= $this->Html->link(__('Users'), ['controller' => 'users', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Schools'), ['controller' => 'schools', 'action' => 'lists']) ?></li>
            <li><?= $this->Html->link(__('Areas'), ['controller' => 'areas', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Cities'), ['controller' => 'cities', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('States'), ['controller' => 'states', 'action' => 'index']) ?></li>
        <?php }?>
    </ul>
</nav>