<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Schoolfeeothercharge'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Schoolfees'), ['controller' => 'Schoolfees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Schoolfee'), ['controller' => 'Schoolfees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="schoolfeeothercharges index large-9 medium-8 columns content">
    <h3><?= __('Schoolfeeothercharges') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('schoolfee_id') ?></th>
                <th><?= $this->Paginator->sort('extra_charges') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schoolfeeothercharges as $schoolfeeothercharge): ?>
            <tr>
                <td><?= $this->Number->format($schoolfeeothercharge->id) ?></td>
                <td><?= $schoolfeeothercharge->has('schoolfee') ? $this->Html->link($schoolfeeothercharge->schoolfee->id, ['controller' => 'Schoolfees', 'action' => 'view', $schoolfeeothercharge->schoolfee->id]) : '' ?></td>
                <td><?= $this->Number->format($schoolfeeothercharge->extra_charges) ?></td>
                <td><?= h($schoolfeeothercharge->description) ?></td>
                <td><?= $this->Number->format($schoolfeeothercharge->status) ?></td>
                <td><?= $this->Number->format($schoolfeeothercharge->deleted) ?></td>
                <td><?= $this->Number->format($schoolfeeothercharge->created) ?></td>
                <td><?= $this->Number->format($schoolfeeothercharge->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $schoolfeeothercharge->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $schoolfeeothercharge->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $schoolfeeothercharge->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolfeeothercharge->id)]) ?>
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
