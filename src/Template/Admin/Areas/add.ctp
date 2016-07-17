<?php echo $this->element('side');?>
<div class="areas form large-9 medium-8 columns content">
    <?= $this->Form->create($area) ?>
    <fieldset>
        <legend><?= __('Add Area') ?></legend>
        <?php
            echo $this->Form->input('city_id', ['options' => $cities]);
            echo $this->Form->input('name');
            echo $this->Form->input('meta_title');
            echo $this->Form->input('meta_keywords');
            echo $this->Form->input('meta_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
