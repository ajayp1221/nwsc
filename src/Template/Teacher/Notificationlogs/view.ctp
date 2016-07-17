<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notificationlog'), ['action' => 'edit', $notificationlog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notificationlog'), ['action' => 'delete', $notificationlog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationlog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notificationlogs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notificationlog'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notificationapplogs'), ['controller' => 'Notificationapplogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notificationapplog'), ['controller' => 'Notificationapplogs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notificationlogs view large-9 medium-8 columns content">
    <h3><?= h($notificationlog->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Model Name') ?></th>
            <td><?= h($notificationlog->model_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($notificationlog->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Modelid') ?></th>
            <td><?= $this->Number->format($notificationlog->modelid) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($notificationlog->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($notificationlog->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($notificationlog->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($notificationlog->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($notificationlog->message)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Notificationapplogs') ?></h4>
        <?php if (!empty($notificationlog->notificationapplogs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Notificationlog Id') ?></th>
                <th><?= __('Guardian Id') ?></th>
                <th><?= __('Student Id') ?></th>
                <th><?= __('Teacher Id') ?></th>
                <th><?= __('Is Seen') ?></th>
                <th><?= __('Is Seen Date') ?></th>
                <th><?= __('Api Response') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($notificationlog->notificationapplogs as $notificationapplogs): ?>
            <tr>
                <td><?= h($notificationapplogs->id) ?></td>
                <td><?= h($notificationapplogs->notificationlog_id) ?></td>
                <td><?= h($notificationapplogs->guardian_id) ?></td>
                <td><?= h($notificationapplogs->student_id) ?></td>
                <td><?= h($notificationapplogs->teacher_id) ?></td>
                <td><?= h($notificationapplogs->is_seen) ?></td>
                <td><?= h($notificationapplogs->is_seen_date) ?></td>
                <td><?= h($notificationapplogs->api_response) ?></td>
                <td><?= h($notificationapplogs->created) ?></td>
                <td><?= h($notificationapplogs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notificationapplogs', 'action' => 'view', $notificationapplogs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Notificationapplogs', 'action' => 'edit', $notificationapplogs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notificationapplogs', 'action' => 'delete', $notificationapplogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationapplogs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
