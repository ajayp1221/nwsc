<?php echo $this->element('side')?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('mobile');
            echo $this->Form->input('img',['type' => 'file']);
            if($authUser['role']=="ADMIN"){
                $val = ['USER'=>'USER','HELPER' => 'HELPER','ADMIN' => 'ADMIN'];
                echo $this->Form->input('role', ['options' => $val]);
            }else{
                $val = ['USER'=>'USER','HELPER' => 'HELPER'];
                echo $this->Form->input('role', ['options' => $val]);
            }
            echo $this->Form->input('address');
            echo $this->Form->input('area_id', ['options' => $areas]);
            echo $this->Form->input('city_id', ['options' => $cities]);
            echo $this->Form->input('state_id', ['options' => $states]);
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('pincode');
            $val = ['0' => 'Inactive', '1' => 'Active'];
            echo $this->Form->input('status', ['options' => $val]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
