<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Schoolfeeothercharge'), ['action' => 'edit', $schoolfeeothercharge->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Schoolfeeothercharge'), ['action' => 'delete', $schoolfeeothercharge->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolfeeothercharge->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Schoolfeeothercharges'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schoolfeeothercharge'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schoolfees'), ['controller' => 'Schoolfees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schoolfee'), ['controller' => 'Schoolfees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="schoolfeeothercharges view large-9 medium-8 columns content">
    <h3><?= h($schoolfeeothercharge->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Schoolfee') ?></th>
            <td><?= $schoolfeeothercharge->has('schoolfee') ? $this->Html->link($schoolfeeothercharge->schoolfee->id, ['controller' => 'Schoolfees', 'action' => 'view', $schoolfeeothercharge->schoolfee->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($schoolfeeothercharge->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($schoolfeeothercharge->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Extra Charges') ?></th>
            <td><?= $this->Number->format($schoolfeeothercharge->extra_charges) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($schoolfeeothercharge->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($schoolfeeothercharge->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($schoolfeeothercharge->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($schoolfeeothercharge->modified) ?></td>
        </tr>
    </table>
</div>
