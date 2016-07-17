<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Timetable'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="timetables index large-9 medium-8 columns content">
    <h3><?= __('Timetables') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('school_id') ?></th>
                <th><?= $this->Paginator->sort('classroom_id') ?></th>
                <th><?= $this->Paginator->sort('subject_id') ?></th>
                <th><?= $this->Paginator->sort('teacher_id') ?></th>
                <th><?= $this->Paginator->sort('period_no') ?></th>
                <th><?= $this->Paginator->sort('period_time') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timetables as $timetable): ?>
            <tr>
                <td><?= $this->Number->format($timetable->id) ?></td>
                <td><?= $timetable->has('school') ? $this->Html->link($timetable->school->name, ['controller' => 'Schools', 'action' => 'view', $timetable->school->id]) : '' ?></td>
                <td><?= $timetable->has('classroom') ? $this->Html->link($timetable->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $timetable->classroom->id]) : '' ?></td>
                <td><?= $timetable->has('subject') ? $this->Html->link($timetable->subject->name, ['controller' => 'Subjects', 'action' => 'view', $timetable->subject->id]) : '' ?></td>
                <td><?= $timetable->has('teacher') ? $this->Html->link($timetable->teacher->id, ['controller' => 'Teachers', 'action' => 'view', $timetable->teacher->id]) : '' ?></td>
                <td><?= $this->Number->format($timetable->period_no) ?></td>
                <td><?= h($timetable->period_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $timetable->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $timetable->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timetable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timetable->id)]) ?>
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
