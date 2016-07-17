<?php echo $this->element('side');?>
<div class="classrooms form large-9 medium-8 columns content">
    <?= $this->Form->create($classroom) ?>
    <fieldset>
        <legend><?= __('Add Classroom') ?></legend>
        <?php
            echo $this->Form->input('school_id', ['options' => $schools]);
            echo $this->Form->input('name');
            echo $this->Form->input('section');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
