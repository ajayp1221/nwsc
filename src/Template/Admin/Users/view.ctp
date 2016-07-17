<?php echo $this->element('side')?>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Mobile') ?></th>
            <td><?= h($user->mobile) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td><img src="<?= h($user->api_img_medium) ?>" /></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Area') ?></th>
            <td><?= $user->has('area') ? $this->Html->link($user->area->name, ['controller' => 'Areas', 'action' => 'view', $user->area->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= $user->has('city') ? $this->Html->link($user->city->name, ['controller' => 'Cities', 'action' => 'view', $user->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $user->has('state') ? $this->Html->link($user->state->name, ['controller' => 'States', 'action' => 'view', $user->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $user->has('country') ? $this->Html->link($user->country->name, ['controller' => 'Countries', 'action' => 'view', $user->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Ownerid') ?></th>
            <td><?= $this->Number->format($user->ownerid) ?></td>
        </tr>
        <tr>
            <th><?= __('Pincode') ?></th>
            <td><?= $this->Number->format($user->pincode) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($user->status){echo  "Active";}else{echo "Inactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-y H:i",$user->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Schools') ?></h4>
        <?php if (!empty($user->schools)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Current Session') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('Pincode') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Created') ?></th>
            </tr>
            <?php foreach ($user->schools as $schools): ?>
            <tr>
                <td><?= h($schools->id) ?></td>
                <td><?= h($schools->name) ?></td>
                <td><?= h($schools->session) ?></td>
                <td><?= h($schools->address) ?></td>
                <td><?= h($schools->pincode) ?></td>
                <td><?php if($schools->status){echo "Active";}else{echo "Inactive";} ?></td>
                <td><?= date('d-m-Y H:s',$schools->created) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
