<?php echo $this->element('side');?>
<div class="resultcategories form large-9 medium-8 columns content">
    <?= $this->Form->create($resultcategory) ?>
    <fieldset>
        <legend><?= __('Edit Resultcategory') ?></legend>
        <?php
            echo $this->Form->input('school_id', ['options' => $schools]);
            echo $this->Form->input('session');
            echo $this->Form->input('name');
            $val = ['0' => 'Inactive', '1' => 'Active'];
            echo $this->Form->input('status', ['options' => $val]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
