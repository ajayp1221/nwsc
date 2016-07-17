<?php echo $this->element('side');?>
<div class="results form large-9 medium-8 columns content">
    <?= $this->Form->create($result) ?>
    <fieldset>
        <legend><?= __('Add Result') ?></legend>
        <?php
            echo $this->Form->input('resultcategory_id', ['options' => $resultcategories]);
            echo $this->Form->input('student_id', ['options' => $students]);
            echo $this->Form->input('subject_id', ['options' => $subjects]);
            echo $this->Form->input('get_marks');
            echo $this->Form->input('total_mark');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
