<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $teacherleave->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $teacherleave->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Teacherleaves'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teacherleaves form large-9 medium-8 columns content">
    <?= $this->Form->create($teacherleave) ?>
    <fieldset>
        <legend><?= __('Edit Teacherleave') ?></legend>
        <?php
            echo $this->Form->input('teacher_id', ['options' => $teachers]);
            echo $this->Form->input('session');
            echo $this->Form->input('title');
            echo $this->Form->input('reason');
            echo $this->Form->input('from');
            echo $this->Form->input('to');
            echo $this->Form->input('is_approved');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
