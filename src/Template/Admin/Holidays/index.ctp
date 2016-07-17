<?php echo $this->element('side');?>
<div class="holidays index large-9 medium-8 columns content">
    <h3><?= __('Holidays') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('school_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('session') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($holidays as $holiday): ?>
            <tr>
                <td><?= $this->Number->format($holiday->id) ?></td>
                <td><?= $holiday->has('school') ? $this->Html->link($holiday->school->name, ['controller' => 'Schools', 'action' => 'view', $holiday->school->id]) : '' ?></td>
                <td><?= h($holiday->title) ?></td>
                <td><?= h($holiday->date) ?></td>
                <td><?= h($holiday->session) ?></td>
                <td><?php if($holiday->status){echo "Active";}else{echo "Deactive";} ?></td>
                <td class="actions">
                    <?php // $this->Html->link(__('View'), ['action' => 'view', $holiday->slug]) ?>
                    <?php //  $this->Html->link(__('Edit'), ['action' => 'edit', $holiday->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $holiday->id], ['confirm' => __('Are you sure you want to delete # {0}?', $holiday->id)]) ?>
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
