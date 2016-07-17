<?php echo $this->element('side');?>
<div class="holidays form large-9 medium-8 columns content">
    <?= $this->Form->create($holiday) ?>
    <fieldset>
        <legend><?= __('Edit Holiday') ?></legend>
        <?php
            echo $this->Form->input('school_id', ['options' => $schools]);
            echo $this->Form->input('title');
            echo $this->Form->input('reason');
            echo $this->Form->input('date');
            $val = ['0' => 'Inactive', '1' => 'Active'];
            echo $this->Form->input('status', ['options' => $val]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
