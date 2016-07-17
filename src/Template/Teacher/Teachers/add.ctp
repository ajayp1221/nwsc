<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Studentattendances'), ['controller' => 'Studentattendances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Studentattendance'), ['controller' => 'Studentattendances', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teacherattendances'), ['controller' => 'Teacherattendances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacherattendance'), ['controller' => 'Teacherattendances', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teachersalaries'), ['controller' => 'Teachersalaries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teachersalary'), ['controller' => 'Teachersalaries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Timetables'), ['controller' => 'Timetables', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetables', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teachers form large-9 medium-8 columns content">
    <?= $this->Form->create($teacher) ?>
    <fieldset>
        <legend><?= __('Add Teacher') ?></legend>
        <?php
            echo $this->Form->input('area_id', ['options' => $areas]);
            echo $this->Form->input('school_id', ['options' => $schools]);
            echo $this->Form->input('city_id', ['options' => $cities]);
            echo $this->Form->input('state_id', ['options' => $states]);
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('address');
            echo $this->Form->input('pincode');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('mobile');
            echo $this->Form->input('image');
            echo $this->Form->input('dob');
            echo $this->Form->input('salary');
            echo $this->Form->input('slug');
            echo $this->Form->input('lat');
            echo $this->Form->input('long');
            echo $this->Form->input('device_token');
            echo $this->Form->input('deviceid');
            echo $this->Form->input('status');
            echo $this->Form->input('deleted');
            echo $this->Form->input('classrooms._ids', ['options' => $classrooms]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
