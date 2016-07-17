<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Teacherleave'), ['action' => 'edit', $teacherleave->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Teacherleave'), ['action' => 'delete', $teacherleave->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacherleave->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teacherleaves'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacherleave'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teacherleaves view large-9 medium-8 columns content">
    <h3><?= h($teacherleave->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Teacher') ?></th>
            <td><?= $teacherleave->has('teacher') ? $this->Html->link($teacherleave->teacher->id, ['controller' => 'Teachers', 'action' => 'view', $teacherleave->teacher->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($teacherleave->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($teacherleave->title) ?></td>
        </tr>
        <tr>
            <th><?= __('From') ?></th>
            <td><?= h($teacherleave->from) ?></td>
        </tr>
        <tr>
            <th><?= __('To') ?></th>
            <td><?= h($teacherleave->to) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($teacherleave->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Approved') ?></th>
            <td><?= $this->Number->format($teacherleave->is_approved) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($teacherleave->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($teacherleave->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($teacherleave->deleted) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Reason') ?></h4>
        <?= $this->Text->autoParagraph(h($teacherleave->reason)); ?>
    </div>
</div>
