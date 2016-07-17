<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $notificationlog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $notificationlog->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Notificationlogs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Notificationapplogs'), ['controller' => 'Notificationapplogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notificationapplog'), ['controller' => 'Notificationapplogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notificationlogs form large-9 medium-8 columns content">
    <?= $this->Form->create($notificationlog) ?>
    <fieldset>
        <legend><?= __('Edit Notificationlog') ?></legend>
        <?php
            echo $this->Form->input('model_name');
            echo $this->Form->input('modelid');
            echo $this->Form->input('message');
            echo $this->Form->input('status');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
