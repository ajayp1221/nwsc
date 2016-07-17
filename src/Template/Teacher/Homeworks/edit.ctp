<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $homework->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $homework->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Homeworks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Homeworkquestions'), ['controller' => 'Homeworkquestions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Homeworkquestion'), ['controller' => 'Homeworkquestions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="homeworks form large-9 medium-8 columns content">
    <?= $this->Form->create($homework) ?>
    <fieldset>
        <legend><?= __('Edit Homework') ?></legend>
        <?php
            echo $this->Form->input('school_id', ['options' => $schools]);
            echo $this->Form->input('subject_id', ['options' => $subjects]);
            echo $this->Form->input('classroom_id', ['options' => $classrooms]);
            echo $this->Form->input('teacher_id', ['options' => $teachers]);
            echo $this->Form->input('session');
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('file');
            echo $this->Form->input('status');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
