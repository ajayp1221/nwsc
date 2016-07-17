<?php echo $this->element('side');?>
<div class="teachers view large-9 medium-8 columns content">
    <h3><?= h($teacher->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $teacher->has('school') ? $this->Html->link($teacher->school->name, ['controller' => 'Schools', 'action' => 'view', $teacher->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= $teacher->has('city') ? $this->Html->link($teacher->city->name, ['controller' => 'Cities', 'action' => 'view', $teacher->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $teacher->has('state') ? $this->Html->link($teacher->state->name, ['controller' => 'States', 'action' => 'view', $teacher->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $teacher->has('country') ? $this->Html->link($teacher->country->name, ['controller' => 'Countries', 'action' => 'view', $teacher->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($teacher->first_name." ".$teacher->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($teacher->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Mobile') ?></th>
            <td><?= h($teacher->mobile) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td>
                <?php echo $this->Html->image("../upload/teachers/80-$teacher->image"); ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Dob') ?></th>
            <td><?= h($teacher->dob) ?></td>
        </tr>
        <tr>
            <th><?= __('Salary') ?></th>
            <td><?= h($teacher->salary) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-Y H:i",$teacher->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= date("d-m-Y H:i",$teacher->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($teacher->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Pincode') ?></th>
            <td><?= $this->Number->format($teacher->pincode) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($teacher->status){echo "Active";}else{echo "Inactive";} ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($teacher->address)); ?>
    </div>
</div>
