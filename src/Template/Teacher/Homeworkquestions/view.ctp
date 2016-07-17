<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Homeworkquestion'), ['action' => 'edit', $homeworkquestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Homeworkquestion'), ['action' => 'delete', $homeworkquestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $homeworkquestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Homeworkquestions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Homeworkquestion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Homeworks'), ['controller' => 'Homeworks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Homework'), ['controller' => 'Homeworks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="homeworkquestions view large-9 medium-8 columns content">
    <h3><?= h($homeworkquestion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Homework') ?></th>
            <td><?= $homeworkquestion->has('homework') ? $this->Html->link($homeworkquestion->homework->title, ['controller' => 'Homeworks', 'action' => 'view', $homeworkquestion->homework->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($homeworkquestion->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($homeworkquestion->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($homeworkquestion->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Question') ?></h4>
        <?= $this->Text->autoParagraph(h($homeworkquestion->question)); ?>
    </div>
</div>
