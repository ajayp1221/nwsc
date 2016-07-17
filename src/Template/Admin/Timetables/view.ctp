<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Timetable'), ['action' => 'edit', $timetable->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Timetable'), ['action' => 'delete', $timetable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timetable->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Timetables'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="timetables view large-9 medium-8 columns content">
    <h3><?= h($timetable->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $timetable->has('school') ? $this->Html->link($timetable->school->name, ['controller' => 'Schools', 'action' => 'view', $timetable->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Classroom') ?></th>
            <td><?= $timetable->has('classroom') ? $this->Html->link($timetable->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $timetable->classroom->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Subject') ?></th>
            <td><?= $timetable->has('subject') ? $this->Html->link($timetable->subject->name, ['controller' => 'Subjects', 'action' => 'view', $timetable->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Teacher') ?></th>
            <td><?= $timetable->has('teacher') ? $this->Html->link($timetable->teacher->id, ['controller' => 'Teachers', 'action' => 'view', $timetable->teacher->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Period Time') ?></th>
            <td><?= h($timetable->period_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Days') ?></th>
            <td><?= h($timetable->days) ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($timetable->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($timetable->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Period No') ?></th>
            <td><?= $this->Number->format($timetable->period_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($timetable->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($timetable->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($timetable->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($timetable->modified) ?></td>
        </tr>
    </table>
</div>
