<?php echo $this->element('side');?>
<div class="students index large-9 medium-8 columns content">
    <h3><?= __('Students') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('studentid') ?></th>
                <th><?= $this->Paginator->sort('classroom_id') ?></th>
                <th><?= $this->Paginator->sort('first_name','Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <?php $student->slug;?>
            <tr>
                <td><?= $this->Number->format($student->id) ?></td>
                <td><?= h($student->studentid) ?></td>
                <td><?= $student->classroom->class_name ?></td>
                <td><?= h($student->full_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $student->slug]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
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
