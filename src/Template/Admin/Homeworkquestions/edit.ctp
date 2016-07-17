<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $homeworkquestion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $homeworkquestion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Homeworkquestions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Homeworks'), ['controller' => 'Homeworks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Homework'), ['controller' => 'Homeworks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="homeworkquestions form large-9 medium-8 columns content">
    <?= $this->Form->create($homeworkquestion) ?>
    <fieldset>
        <legend><?= __('Edit Homeworkquestion') ?></legend>
        <?php
            echo $this->Form->input('homework_id', ['options' => $homeworks]);
            echo $this->Form->input('question');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
