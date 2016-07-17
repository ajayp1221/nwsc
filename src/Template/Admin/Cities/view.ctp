<?php echo $this->element('side'); ?>
<div class="cities view large-9 medium-8 columns content">
    <h3><?= h($city->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $city->has('state') ? $this->Html->link($city->state->name, ['controller' => 'States', 'action' => 'view', $city->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($city->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Title') ?></th>
            <td><?= h($city->meta_title) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Keywords') ?></th>
            <td><?= h($city->meta_keywords) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Description') ?></th>
            <td><?= h($city->meta_description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($city->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($city->status){echo "Active";}else{echo "Inactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-Y H:i",$city->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Modified') ?></th>
            <td><?= date("d-m-Y H:i",$city->modified) ?></td>
        </tr>
    </table>
</div>
