<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Notificationapplog'), ['action' => 'add']) ?></li>
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
<div class="notificationapplogs index large-9 medium-8 columns content">
    <h3><?= __('Notificationapplogs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('notificationlog_id') ?></th>
                <th><?= $this->Paginator->sort('guardian_id') ?></th>
                <th><?= $this->Paginator->sort('student_id') ?></th>
                <th><?= $this->Paginator->sort('teacher_id') ?></th>
                <th><?= $this->Paginator->sort('is_seen') ?></th>
                <th><?= $this->Paginator->sort('is_seen_date') ?></th>
                <th><?= $this->Paginator->sort('api_response') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notificationapplogs as $notificationapplog): ?>
            <tr>
                <td><?= $this->Number->format($notificationapplog->id) ?></td>
                <td><?= $this->Number->format($notificationapplog->notificationlog_id) ?></td>
                <td><?= $notificationapplog->has('guardian') ? $this->Html->link($notificationapplog->guardian->name, ['controller' => 'Guardians', 'action' => 'view', $notificationapplog->guardian->id]) : '' ?></td>
                <td><?= $notificationapplog->has('student') ? $this->Html->link($notificationapplog->student->id, ['controller' => 'Students', 'action' => 'view', $notificationapplog->student->id]) : '' ?></td>
                <td><?= $notificationapplog->has('teacher') ? $this->Html->link($notificationapplog->teacher->id, ['controller' => 'Teachers', 'action' => 'view', $notificationapplog->teacher->id]) : '' ?></td>
                <td><?= $this->Number->format($notificationapplog->is_seen) ?></td>
                <td><?= h($notificationapplog->is_seen_date) ?></td>
                <td><?= h($notificationapplog->api_response) ?></td>
                <td><?= $this->Number->format($notificationapplog->created) ?></td>
                <td><?= $this->Number->format($notificationapplog->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $notificationapplog->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notificationapplog->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notificationapplog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationapplog->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
