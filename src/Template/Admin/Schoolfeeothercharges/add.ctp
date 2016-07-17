<?php echo $this->element('side');?>
<div class="schoolfeeothercharges form large-9 medium-8 columns content">
    <?= $this->Form->create($schoolfeeothercharge) ?>
    <fieldset>
        <legend><?= __('Add Schoolfeeothercharge') ?></legend>
        <?php
            echo $this->Form->input('schoolfee_id', ['value' => $id,'type' => 'hidden']);
            echo $this->Form->input('extra_charges');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
