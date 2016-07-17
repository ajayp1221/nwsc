<?php echo $this->element('side');?>
<div class="areas view large-9 medium-8 columns content">
    <h3><?= h($area->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('City') ?></th>
            <td><?= $area->has('city') ? $this->Html->link($area->city->name, ['controller' => 'Cities', 'action' => 'view', $area->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($area->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Title') ?></th>
            <td><?= h($area->meta_title) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Keywords') ?></th>
            <td><?= h($area->meta_keywords) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Description') ?></th>
            <td><?= h($area->meta_description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($area->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($area->status){echo "Active";}else{echo "Inactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-Y H:i",$area->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Modified') ?></th>
            <td><?= date("d-m-Y H:i",$area->modified) ?></td>
        </tr>
    </table>
</div>
