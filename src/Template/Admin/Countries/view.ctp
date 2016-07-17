<?php  echo $this->element('side');?>
<div class="countries view large-9 medium-8 columns content">
    <h3><?= h($country->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($country->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Title') ?></th>
            <td><?= h($country->meta_title) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Keywords') ?></th>
            <td><?= h($country->meta_keywords) ?></td>
        </tr>
        <tr>
            <th><?= __('Meta Description') ?></th>
            <td><?= h($country->meta_description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($country->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($country->status){echo "Active";}else{echo "Inactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-Y H:i",$country->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= date("d-m-Y H:i",$country->modified) ?></td>
        </tr>
    </table>
</div>
