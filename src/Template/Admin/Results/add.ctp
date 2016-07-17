<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Results'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Resultcategories'), ['controller' => 'Resultcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Resultcategory'), ['controller' => 'Resultcategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="results form large-9 medium-8 columns content">
    <?= $this->Form->create($result) ?>
    <fieldset>
        <legend><?= __('Add Result') ?></legend>
        <?php
            echo $this->Form->input('resultcategory_id', ['options' => $resultcategories]);
            echo $this->Form->input('school_id', ['options' => $schools]);
            echo $this->Form->input('classroom_id', ['options' => $classrooms]);
            echo $this->Form->input('student_id', ['options' => $students]);
            echo $this->Form->input('subject_id', ['options' => $subjects]);
            echo $this->Form->input('get_marks');
            echo $this->Form->input('total_mark');
            echo $this->Form->input('session');
            echo $this->Form->input('status');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
