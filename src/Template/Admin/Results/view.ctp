<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Result'), ['action' => 'edit', $result->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Result'), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Results'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Resultcategories'), ['controller' => 'Resultcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Resultcategory'), ['controller' => 'Resultcategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="results view large-9 medium-8 columns content">
    <h3><?= h($result->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Resultcategory') ?></th>
            <td><?= $result->has('resultcategory') ? $this->Html->link($result->resultcategory->name, ['controller' => 'Resultcategories', 'action' => 'view', $result->resultcategory->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $result->has('school') ? $this->Html->link($result->school->name, ['controller' => 'Schools', 'action' => 'view', $result->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Classroom') ?></th>
            <td><?= $result->has('classroom') ? $this->Html->link($result->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $result->classroom->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Student') ?></th>
            <td><?= $result->has('student') ? $this->Html->link($result->student->id, ['controller' => 'Students', 'action' => 'view', $result->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Subject') ?></th>
            <td><?= $result->has('subject') ? $this->Html->link($result->subject->name, ['controller' => 'Subjects', 'action' => 'view', $result->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($result->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($result->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Get Marks') ?></th>
            <td><?= $this->Number->format($result->get_marks) ?></td>
        </tr>
        <tr>
            <th><?= __('Total Mark') ?></th>
            <td><?= $this->Number->format($result->total_mark) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($result->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($result->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($result->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($result->modified) ?></td>
        </tr>
    </table>
</div>
