<?php echo $this->element('side');?>
<div class="resultcategories index large-9 medium-8 columns content">
    <h3><?= __('Resultcategories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('school_id') ?></th>
                <th><?= $this->Paginator->sort('session') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultcategories as $resultcategory): ?>
            <?php ($resultcategory->slug) ?>
            <tr>
                <td><?= $this->Number->format($resultcategory->id) ?></td>
                <td><?= $resultcategory->has('school') ? $this->Html->link($resultcategory->school->name, ['controller' => 'Schools', 'action' => 'view', $resultcategory->school->id]) : '' ?></td>
                <td><?= h($resultcategory->session) ?></td>
                <td><?= h($resultcategory->name) ?></td>
                <td><?php if($resultcategory->status){echo "active";}else{echo "inactive";} ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resultcategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resultcategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resultcategory->id)]) ?>
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
