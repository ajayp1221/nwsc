<?php echo $this->element('side');?>
<div class="schoolfees view large-9 medium-8 columns content">
    <h3><?= h($schoolfee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Classroom') ?></th>
            <td><?= $schoolfee->has('classroom') ? $this->Html->link($schoolfee->classroom->class_name, ['controller' => 'Classrooms', 'action' => 'view', $schoolfee->classroom->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Month') ?></th>
            <td><?php $dateObj = DateTime::createFromFormat('!m', $schoolfee->month); echo $dateObj->format('F');?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($schoolfee->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($schoolfee->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fee') ?></th>
            <td><?= $this->Number->format($schoolfee->fee) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($schoolfee->status){echo "Active";}else{echo "Inactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date('d-M-Y',($schoolfee->created)) ?></td>
        </tr>
    </table>
    <div class="related">
        <h5 class="right"><a href="/admin/schoolfeeothercharges/add/<?= $schoolfee->id;?>">Add New Other Charges</a></h5>
        <h4><?= __('Related Schoolfeeothercharges') ?></h4>
        <?php if (!empty($schoolfee->schoolfeeothercharges)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Extra Charges') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($schoolfee->schoolfeeothercharges as $schoolfeeothercharges): ?>
            <tr>
                <td><?= h($schoolfeeothercharges->id) ?></td>
                <td><?= h($schoolfeeothercharges->extra_charges) ?></td>
                <td><?= h($schoolfeeothercharges->description) ?></td>
                <td><?php if($schoolfeeothercharges->status){echo "Active";}else{echo "Inactive";} ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Schoolfeeothercharges', 'action' => 'edit', $schoolfeeothercharges->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
