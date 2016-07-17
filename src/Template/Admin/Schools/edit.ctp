<?php echo $this->element('side');?>
<div class="schools form large-9 medium-8 columns content">
    <?= $this->Form->create($school,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit School') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('session');
            echo $this->Form->input('description');
            echo $this->Form->input('img',['type' => 'file']);
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
