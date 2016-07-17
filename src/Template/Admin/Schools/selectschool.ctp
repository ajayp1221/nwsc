<?php echo $this->element('side');?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Select School') ?></legend>
        <?php
            echo $this->Form->input('schoolname', ['options' => $school]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
