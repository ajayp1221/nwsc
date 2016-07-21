<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Schoolbusfee'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="schoolbusfees index large-9 medium-8 columns content">
    <h3><?= __('Schoolbusfees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('school_id') ?></th>
                <th><?= $this->Paginator->sort('session') ?></th>
                <th><?= $this->Paginator->sort('fee') ?></th>
                <th><?= $this->Paginator->sort('distance') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schoolbusfees as $schoolbusfee): ?>
            <tr>
                <td><?= $this->Number->format($schoolbusfee->id) ?></td>
                <td><?= $schoolbusfee->has('school') ? $this->Html->link($schoolbusfee->school->name, ['controller' => 'Schools', 'action' => 'view', $schoolbusfee->school->id]) : '' ?></td>
                <td><?= h($schoolbusfee->session) ?></td>
                <td><?= $this->Number->format($schoolbusfee->fee) ?></td>
                <td><?= $this->Number->format($schoolbusfee->distance) ?></td>
                <td><?= $this->Number->format($schoolbusfee->status) ?></td>
                <td><?= $this->Number->format($schoolbusfee->deleted) ?></td>
                <td><?= $this->Number->format($schoolbusfee->created) ?></td>
                <td><?= $this->Number->format($schoolbusfee->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $schoolbusfee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $schoolbusfee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $schoolbusfee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolbusfee->id)]) ?>
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
