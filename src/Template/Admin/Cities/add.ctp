<?php echo $this->element('side'); ?>
<div class="cities form large-9 medium-8 columns content">
    <?= $this->Form->create($city) ?>
    <fieldset>
        <legend><?= __('Add City') ?></legend>
        <?php
            echo $this->Form->input('state_id', ['options' => $states]);
            echo $this->Form->input('name');
            echo $this->Form->input('meta_title');
            echo $this->Form->input('meta_keywords');
            echo $this->Form->input('meta_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
