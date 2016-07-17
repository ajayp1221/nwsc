<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Messagesmslog'), ['action' => 'edit', $messagesmslog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Messagesmslog'), ['action' => 'delete', $messagesmslog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messagesmslog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Messagesmslogs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Messagesmslog'), ['action' => 'add']) ?> </li>
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
<div class="messagesmslogs view large-9 medium-8 columns content">
    <h3><?= h($messagesmslog->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Model Name') ?></th>
            <td><?= h($messagesmslog->model_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Messagelog') ?></th>
            <td><?= $messagesmslog->has('messagelog') ? $this->Html->link($messagesmslog->messagelog->id, ['controller' => 'Messagelogs', 'action' => 'view', $messagesmslog->messagelog->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Mobile Number') ?></th>
            <td><?= h($messagesmslog->mobile_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Api Response') ?></th>
            <td><?= h($messagesmslog->api_response) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($messagesmslog->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Modelid') ?></th>
            <td><?= $this->Number->format($messagesmslog->modelid) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($messagesmslog->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($messagesmslog->modified) ?></td>
        </tr>
    </table>
</div>
