<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Homeworkquestion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Homeworks'), ['controller' => 'Homeworks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Homework'), ['controller' => 'Homeworks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="homeworkquestions index large-9 medium-8 columns content">
    <h3><?= __('Homeworkquestions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('homework_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($homeworkquestions as $homeworkquestion): ?>
            <tr>
                <td><?= $this->Number->format($homeworkquestion->id) ?></td>
                <td><?= $homeworkquestion->has('homework') ? $this->Html->link($homeworkquestion->homework->title, ['controller' => 'Homeworks', 'action' => 'view', $homeworkquestion->homework->id]) : '' ?></td>
                <td><?= $this->Number->format($homeworkquestion->created) ?></td>
                <td><?= $this->Number->format($homeworkquestion->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $homeworkquestion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $homeworkquestion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $homeworkquestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $homeworkquestion->id)]) ?>
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
