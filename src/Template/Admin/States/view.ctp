<?php echo $this->element('side'); ?>
<div class="states view large-9 medium-8 columns content">
    <h3><?= h($state->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $state->has('country') ? $this->Html->link($state->country->name, ['controller' => 'Countries', 'action' => 'view', $state->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($state->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Title') ?></th>
            <td><?= h($state->meta_title) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Keywords') ?></th>
            <td><?= h($state->meta_keywords) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Description') ?></th>
            <td><?= h($state->meta_description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($state->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($state->status){echo "Active";}else{echo "Inactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-Y H:i",$state->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Modified') ?></th>
            <td><?= date("d-m-Y H:i",$state->modified) ?></td>
        </tr>
    </table>
</div>
