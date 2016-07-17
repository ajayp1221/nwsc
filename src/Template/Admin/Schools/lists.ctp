<?php echo $this->element('side');?>
<div class="schools index large-9 medium-8 columns content">
    <h3><?= __('Schools') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('current_session') ?></th>
                <th><?= $this->Paginator->sort('image') ?></th>
                <th><?= $this->Paginator->sort('area_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schools as $school): ?>
            <?php ($school->slug) ?>
            <tr>
                <td><?= $this->Number->format($school->id) ?></td>
                <td><?= h($school->name) ?></td>
                <td><?= h($school->session) ?></td>
                <td>
                    <?php echo $this->Html->image("../upload/schools/80-$school->image",['alt' => $school->name]);?>
                </td>
                <td><?= $school->has('area') ? $this->Html->link($school->area->name, ['controller' => 'Areas', 'action' => 'view', $school->area->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $school->slug]) ?>
                    <?php //echo $this->Html->link(__('Edit'), ['action' => 'edit', $school->slug]) ?>
                    <?php //echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $school->id], ['confirm' => __('Are you sure you want to delete # {0}?', $school->id)]) ?>
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
