<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notificationapplog'), ['action' => 'edit', $notificationapplog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notificationapplog'), ['action' => 'delete', $notificationapplog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationapplog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notificationapplogs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notificationapplog'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Messagelogs'), ['controller' => 'Messagelogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Messagelog'), ['controller' => 'Messagelogs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Guardians'), ['controller' => 'Guardians', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guardian'), ['controller' => 'Guardians', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notificationapplogs view large-9 medium-8 columns content">
    <h3><?= h($notificationapplog->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Guardian') ?></th>
            <td><?= $notificationapplog->has('guardian') ? $this->Html->link($notificationapplog->guardian->name, ['controller' => 'Guardians', 'action' => 'view', $notificationapplog->guardian->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Student') ?></th>
            <td><?= $notificationapplog->has('student') ? $this->Html->link($notificationapplog->student->id, ['controller' => 'Students', 'action' => 'view', $notificationapplog->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Teacher') ?></th>
            <td><?= $notificationapplog->has('teacher') ? $this->Html->link($notificationapplog->teacher->id, ['controller' => 'Teachers', 'action' => 'view', $notificationapplog->teacher->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Is Seen Date') ?></th>
            <td><?= h($notificationapplog->is_seen_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Api Response') ?></th>
            <td><?= h($notificationapplog->api_response) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($notificationapplog->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Notificationlog Id') ?></th>
            <td><?= $this->Number->format($notificationapplog->notificationlog_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Seen') ?></th>
            <td><?= $this->Number->format($notificationapplog->is_seen) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($notificationapplog->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($notificationapplog->modified) ?></td>
        </tr>
    </table>
</div>
