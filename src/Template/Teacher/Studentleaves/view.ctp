<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Studentleave'), ['action' => 'edit', $studentleave->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Studentleave'), ['action' => 'delete', $studentleave->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentleave->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Studentleaves'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Studentleave'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentleaves view large-9 medium-8 columns content">
    <h3><?= h($studentleave->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Classroom') ?></th>
            <td><?= $studentleave->has('classroom') ? $this->Html->link($studentleave->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $studentleave->classroom->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Student') ?></th>
            <td><?= $studentleave->has('student') ? $this->Html->link($studentleave->student->id, ['controller' => 'Students', 'action' => 'view', $studentleave->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($studentleave->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($studentleave->title) ?></td>
        </tr>
        <tr>
            <th><?= __('From Date') ?></th>
            <td><?= h($studentleave->from_date) ?></td>
        </tr>
        <tr>
            <th><?= __('To Date') ?></th>
            <td><?= h($studentleave->to_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentleave->id) ?></td>
        </tr>
        <tr>
            <th><?= __('School Id') ?></th>
            <td><?= $this->Number->format($studentleave->school_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Approved') ?></th>
            <td><?= $this->Number->format($studentleave->is_approved) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($studentleave->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($studentleave->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($studentleave->deleted) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Reason') ?></h4>
        <?= $this->Text->autoParagraph(h($studentleave->reason)); ?>
    </div>
</div>
