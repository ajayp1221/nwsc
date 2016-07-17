<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $notificationapplog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $notificationapplog->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Notificationapplogs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Messagelogs'), ['controller' => 'Messagelogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Messagelog'), ['controller' => 'Messagelogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Guardians'), ['controller' => 'Guardians', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guardian'), ['controller' => 'Guardians', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notificationapplogs form large-9 medium-8 columns content">
    <?= $this->Form->create($notificationapplog) ?>
    <fieldset>
        <legend><?= __('Edit Notificationapplog') ?></legend>
        <?php
            echo $this->Form->input('notificationlog_id');
            echo $this->Form->input('guardian_id', ['options' => $guardians]);
            echo $this->Form->input('student_id', ['options' => $students]);
            echo $this->Form->input('teacher_id', ['options' => $teachers]);
            echo $this->Form->input('is_seen');
            echo $this->Form->input('is_seen_date');
            echo $this->Form->input('api_response');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
