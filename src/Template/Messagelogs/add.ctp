<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Messagelogs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Messageapplogs'), ['controller' => 'Messageapplogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Messageapplog'), ['controller' => 'Messageapplogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Messagesmslogs'), ['controller' => 'Messagesmslogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Messagesmslog'), ['controller' => 'Messagesmslogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messagelogs form large-9 medium-8 columns content">
    <?= $this->Form->create($messagelog) ?>
    <fieldset>
        <legend><?= __('Add Messagelog') ?></legend>
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
