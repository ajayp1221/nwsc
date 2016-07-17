<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Studentleaves'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studentleaves form large-9 medium-8 columns content">
    <?= $this->Form->create($studentleave) ?>
    <fieldset>
        <legend><?= __('Add Studentleave') ?></legend>
        <?php
            echo $this->Form->input('school_id');
            echo $this->Form->input('classroom_id', ['options' => $classrooms]);
            echo $this->Form->input('student_id', ['options' => $students]);
            echo $this->Form->input('session');
            echo $this->Form->input('title');
            echo $this->Form->input('reason');
            echo $this->Form->input('from_date');
            echo $this->Form->input('to_date');
            echo $this->Form->input('is_approved');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
