<?php echo $this->element('side');?>
<div class="schoolfees index large-9 medium-8 columns content">
    <h3><?= __('Schoolfees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('classroom_id') ?></th>
                <th><?= $this->Paginator->sort('month') ?></th>
                <th><?= $this->Paginator->sort('fee') ?></th>
                <th><?= $this->Paginator->sort('session') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schoolfees as $schoolfee): ?>
            <tr>
                <td><?= $this->Number->format($schoolfee->id) ?></td>
                <td><?= $schoolfee->has('classroom') ? $this->Html->link($schoolfee->classroom->class_name, ['controller' => 'Classrooms', 'action' => 'view', $schoolfee->classroom->id]) : '' ?></td>
                <td><?php $dateObj = DateTime::createFromFormat('!m', $schoolfee->month); echo $dateObj->format('F');?></td>
                <td><?= $this->Number->format($schoolfee->fee) ?></td>
                <td><?= h($schoolfee->session) ?></td>
                <td><?php if($schoolfee->status){echo "Active";}else{echo "Deactive";} ?></td>
                <td><?= date('d-M-Y',($schoolfee->created)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $schoolfee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $schoolfee->id]) ?>
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
