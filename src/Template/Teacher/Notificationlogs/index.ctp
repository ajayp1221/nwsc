<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Notificationlog'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notificationapplogs'), ['controller' => 'Notificationapplogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notificationapplog'), ['controller' => 'Notificationapplogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notificationlogs index large-9 medium-8 columns content">
    <h3><?= __('Notificationlogs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('model_name') ?></th>
                <th><?= $this->Paginator->sort('modelid') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notificationlogs as $notificationlog): ?>
            <tr>
                <td><?= $this->Number->format($notificationlog->id) ?></td>
                <td><?= h($notificationlog->model_name) ?></td>
                <td><?= $this->Number->format($notificationlog->modelid) ?></td>
                <td><?= $this->Number->format($notificationlog->status) ?></td>
                <td><?= $this->Number->format($notificationlog->deleted) ?></td>
                <td><?= $this->Number->format($notificationlog->created) ?></td>
                <td><?= $this->Number->format($notificationlog->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $notificationlog->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notificationlog->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notificationlog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationlog->id)]) ?>
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
