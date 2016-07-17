<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Messagelog'), ['action' => 'edit', $messagelog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Messagelog'), ['action' => 'delete', $messagelog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messagelog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Messagelogs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Messagelog'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Messageapplogs'), ['controller' => 'Messageapplogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Messageapplog'), ['controller' => 'Messageapplogs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Messagesmslogs'), ['controller' => 'Messagesmslogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Messagesmslog'), ['controller' => 'Messagesmslogs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messagelogs view large-9 medium-8 columns content">
    <h3><?= h($messagelog->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Model Name') ?></th>
            <td><?= h($messagelog->model_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($messagelog->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Modelid') ?></th>
            <td><?= $this->Number->format($messagelog->modelid) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($messagelog->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($messagelog->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($messagelog->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($messagelog->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($messagelog->message)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Messageapplogs') ?></h4>
        <?php if (!empty($messagelog->messageapplogs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Messagelog Id') ?></th>
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
            <?php foreach ($messagelog->messageapplogs as $messageapplogs): ?>
            <tr>
                <td><?= h($messageapplogs->id) ?></td>
                <td><?= h($messageapplogs->messagelog_id) ?></td>
                <td><?= h($messageapplogs->guardian_id) ?></td>
                <td><?= h($messageapplogs->student_id) ?></td>
                <td><?= h($messageapplogs->teacher_id) ?></td>
                <td><?= h($messageapplogs->is_seen) ?></td>
                <td><?= h($messageapplogs->is_seen_date) ?></td>
                <td><?= h($messageapplogs->api_response) ?></td>
                <td><?= h($messageapplogs->created) ?></td>
                <td><?= h($messageapplogs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Messageapplogs', 'action' => 'view', $messageapplogs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Messageapplogs', 'action' => 'edit', $messageapplogs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Messageapplogs', 'action' => 'delete', $messageapplogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageapplogs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Messagesmslogs') ?></h4>
        <?php if (!empty($messagelog->messagesmslogs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Model Name') ?></th>
                <th><?= __('Modelid') ?></th>
                <th><?= __('Messagelog Id') ?></th>
                <th><?= __('Mobile Number') ?></th>
                <th><?= __('Api Response') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($messagelog->messagesmslogs as $messagesmslogs): ?>
            <tr>
                <td><?= h($messagesmslogs->id) ?></td>
                <td><?= h($messagesmslogs->model_name) ?></td>
                <td><?= h($messagesmslogs->modelid) ?></td>
                <td><?= h($messagesmslogs->messagelog_id) ?></td>
                <td><?= h($messagesmslogs->mobile_number) ?></td>
                <td><?= h($messagesmslogs->api_response) ?></td>
                <td><?= h($messagesmslogs->created) ?></td>
                <td><?= h($messagesmslogs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Messagesmslogs', 'action' => 'view', $messagesmslogs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Messagesmslogs', 'action' => 'edit', $messagesmslogs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Messagesmslogs', 'action' => 'delete', $messagesmslogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messagesmslogs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
