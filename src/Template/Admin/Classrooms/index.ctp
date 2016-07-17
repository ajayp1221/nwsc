<?php echo $this->element('side');?>
<div class="classrooms index large-9 medium-8 columns content">
    <h3><?= __('Classrooms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classrooms as $classroom): ?>
            <?php ($classroom->slug) ?>
            <tr>
                <td><?= $this->Number->format($classroom->id) ?></td>
                <td><?= $classroom->name." - ".$classroom->section ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Add Timetable'), ['action' => 'addtimetables', $classroom->slug]) ?><br/>
                    <?= $this->Html->link(__('Add Exam Table'), ['controller' => 'examstables','action' => 'add', $classroom->slug]) ?><br/>                    
                    <?= $this->Html->link(__('List Timetable'), ['action' => 'timetablelist', $classroom->slug]) ?><br/>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $classroom->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $classroom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classroom->id)]) ?>
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
