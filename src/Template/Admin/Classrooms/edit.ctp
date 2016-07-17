<?php echo $this->element('side');?>
<div class="classrooms form large-9 medium-8 columns content">
    <?= $this->Form->create($classroom) ?>
    <fieldset>
        <legend><?= __('Edit Classroom') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('section');
            $val = ['0' => 'Inactive', '1' => 'Active'];
            echo $this->Form->input('status', ['options' => $val]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
