<?php echo $this->element('side');?>
<div class="schools form large-9 medium-8 columns content">
    <?= $this->Form->create($school,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add School') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('name',['label' => 'School Name']);
            echo $this->Form->input('session');
            echo $this->Form->input('description');
            echo $this->Form->input('img',['type' => 'file']);
            echo $this->Form->input('address');
            echo $this->Form->input('area_id', ['options' => $areas]);
            echo $this->Form->input('city_id', ['options' => $cities]);
            echo $this->Form->input('state_id', ['options' => $states]);
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('pincode');
            echo $this->Form->input('meta_title');
            echo $this->Form->input('meta_keywords');
            echo $this->Form->input('meta_description');
            echo $this->Form->input('schoolspayments.month');
            echo $this->Form->input('schoolspayments.amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
