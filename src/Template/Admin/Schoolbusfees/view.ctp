<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Schoolbusfee'), ['action' => 'edit', $schoolbusfee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Schoolbusfee'), ['action' => 'delete', $schoolbusfee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolbusfee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Schoolbusfees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schoolbusfee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="schoolbusfees view large-9 medium-8 columns content">
    <h3><?= h($schoolbusfee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $schoolbusfee->has('school') ? $this->Html->link($schoolbusfee->school->name, ['controller' => 'Schools', 'action' => 'view', $schoolbusfee->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($schoolbusfee->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($schoolbusfee->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fee') ?></th>
            <td><?= $this->Number->format($schoolbusfee->fee) ?></td>
        </tr>
        <tr>
            <th><?= __('Distance') ?></th>
            <td><?= $this->Number->format($schoolbusfee->distance) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($schoolbusfee->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($schoolbusfee->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($schoolbusfee->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($schoolbusfee->modified) ?></td>
        </tr>
    </table>
</div>
