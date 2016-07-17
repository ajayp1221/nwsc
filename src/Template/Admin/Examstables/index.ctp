<?php echo $this->element('side');?>
<div class="examstables index large-9 medium-8 columns content">
    <h3><?= __('Examstables') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('school_id') ?></th>
                <th><?= $this->Paginator->sort('classroom_id') ?></th>
                <th><?= $this->Paginator->sort('subject_id') ?></th>
                <th><?= $this->Paginator->sort('session') ?></th>
                <th><?= $this->Paginator->sort('Exam_name') ?></th>
                <th><?= $this->Paginator->sort('on_date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($examstables as $examstable): ?>
            <tr>
                <td><?= $this->Number->format($examstable->id) ?></td>
                <td><?= $examstable->has('school') ? $this->Html->link($examstable->school->name, ['controller' => 'Schools', 'action' => 'view', $examstable->school->id]) : '' ?></td>
                <td><?= $examstable->has('classroom') ? $this->Html->link($examstable->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $examstable->classroom->id]) : '' ?></td>
                <td><?= $examstable->has('subject') ? $this->Html->link($examstable->subject->name, ['controller' => 'Subjects', 'action' => 'view', $examstable->subject->id]) : '' ?></td>
                <td><?= h($examstable->session) ?></td>
                <td><?= h($examstable->Exam_name) ?></td>
                <td><?= h($examstable->on_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $examstable->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $examstable->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $examstable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $examstable->id)]) ?>
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
