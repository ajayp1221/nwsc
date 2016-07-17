<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Messagesmslog'), ['action' => 'add']) ?></li>
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
<div class="messagesmslogs index large-9 medium-8 columns content">
    <h3><?= __('Messagesmslogs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('model_name') ?></th>
                <th><?= $this->Paginator->sort('modelid') ?></th>
                <th><?= $this->Paginator->sort('messagelog_id') ?></th>
                <th><?= $this->Paginator->sort('mobile_number') ?></th>
                <th><?= $this->Paginator->sort('api_response') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messagesmslogs as $messagesmslog): ?>
            <tr>
                <td><?= $this->Number->format($messagesmslog->id) ?></td>
                <td><?= h($messagesmslog->model_name) ?></td>
                <td><?= $this->Number->format($messagesmslog->modelid) ?></td>
                <td><?= $messagesmslog->has('messagelog') ? $this->Html->link($messagesmslog->messagelog->id, ['controller' => 'Messagelogs', 'action' => 'view', $messagesmslog->messagelog->id]) : '' ?></td>
                <td><?= h($messagesmslog->mobile_number) ?></td>
                <td><?= h($messagesmslog->api_response) ?></td>
                <td><?= $this->Number->format($messagesmslog->created) ?></td>
                <td><?= $this->Number->format($messagesmslog->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $messagesmslog->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $messagesmslog->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $messagesmslog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messagesmslog->id)]) ?>
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
