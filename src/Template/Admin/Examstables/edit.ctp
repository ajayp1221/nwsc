<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $examstable->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $examstable->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Examstables'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="examstables form large-9 medium-8 columns content">
    <?= $this->Form->create($examstable) ?>
    <fieldset>
        <legend><?= __('Edit Examstable') ?></legend>
        <?php
            echo $this->Form->input('school_id', ['options' => $schools]);
            echo $this->Form->input('classroom_id', ['options' => $classrooms]);
            echo $this->Form->input('subject_id', ['options' => $subjects]);
            echo $this->Form->input('session');
            echo $this->Form->input('Exam_name');
            echo $this->Form->input('on_date');
            echo $this->Form->input('time');
            echo $this->Form->input('status');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
