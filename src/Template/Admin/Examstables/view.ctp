<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Examstable'), ['action' => 'edit', $examstable->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Examstable'), ['action' => 'delete', $examstable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $examstable->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Examstables'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Examstable'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="examstables view large-9 medium-8 columns content">
    <h3><?= h($examstable->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $examstable->has('school') ? $this->Html->link($examstable->school->name, ['controller' => 'Schools', 'action' => 'view', $examstable->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Classroom') ?></th>
            <td><?= $examstable->has('classroom') ? $this->Html->link($examstable->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $examstable->classroom->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Subject') ?></th>
            <td><?= $examstable->has('subject') ? $this->Html->link($examstable->subject->name, ['controller' => 'Subjects', 'action' => 'view', $examstable->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($examstable->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Exam Name') ?></th>
            <td><?= h($examstable->Exam_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Time') ?></th>
            <td><?= h($examstable->time) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($examstable->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($examstable->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($examstable->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($examstable->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($examstable->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('On Date') ?></th>
            <td><?= h($examstable->on_date) ?></td>
        </tr>
    </table>
</div>
