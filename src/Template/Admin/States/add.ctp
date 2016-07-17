<?php echo $this->element('side'); ?>
<div class="states form large-9 medium-8 columns content">
    <?= $this->Form->create($state) ?>
    <fieldset>
        <legend><?= __('Add State') ?></legend>
        <?php
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('name');
            echo $this->Form->input('meta_title');
            echo $this->Form->input('meta_keywords');
            echo $this->Form->input('meta_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
