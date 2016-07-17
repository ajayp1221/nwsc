<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $event->has('school') ? $this->Html->link($event->school->name, ['controller' => 'Schools', 'action' => 'view', $event->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Teacher') ?></th>
            <td><?= $event->has('teacher') ? $this->Html->link($event->teacher->id, ['controller' => 'Teachers', 'action' => 'view', $event->teacher->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Classroom') ?></th>
            <td><?= $event->has('classroom') ? $this->Html->link($event->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $event->classroom->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($event->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Event Type') ?></th>
            <td><?= h($event->event_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Event Name') ?></th>
            <td><?= h($event->event_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Start Time') ?></th>
            <td><?= h($event->start_time) ?></td>
        </tr>
        <tr>
            <th><?= __('End Time') ?></th>
            <td><?= h($event->end_time) ?></td>
        </tr>
        <tr>
            <th><?= __('File') ?></th>
            <td><?= h($event->file) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($event->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($event->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($event->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($event->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($event->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($event->description)); ?>
    </div>
</div>
