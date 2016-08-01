<?php echo $this->element('side');?>
<div class="schoolfeeothercharges form large-9 medium-8 columns content">
    <?= $this->Form->create($schoolfeeothercharge) ?>
    <fieldset>
        <legend><?= __('Edit Schoolfeeothercharge') ?></legend>
        <?php
            echo $this->Form->input('extra_charges');
            echo $this->Form->input('description');
            $val = ['0' => 'Inactive', '1' => 'Active'];
            echo $this->Form->input('status', ['options' => $val]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
