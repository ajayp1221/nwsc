<?php echo $this->element('side');?>
<div class="holidays view large-9 medium-8 columns content">
    <h3><?= h($holiday->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $holiday->has('school') ? $this->Html->link($holiday->school->name, ['controller' => 'Schools', 'action' => 'view', $holiday->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($holiday->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($holiday->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($holiday->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($holiday->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($holiday->status){echo "Active";}else{echo "Deactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-Y H:i",$holiday->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= date("d-m-Y H:i",$holiday->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Reason') ?></h4>
        <?= $this->Text->autoParagraph(h($holiday->reason)); ?>
    </div>
</div>
