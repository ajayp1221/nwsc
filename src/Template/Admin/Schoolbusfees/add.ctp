<?php echo $this->element('side');?>
<div class="schoolbusfees form large-9 medium-8 columns content">
    <?= $this->Form->create($schoolbusfee) ?>
    <fieldset>
        <legend><?= __('Add Schoolbusfee') ?></legend>
        <?php
            echo $this->Form->input('fee');
            echo $this->Form->input('distance');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
