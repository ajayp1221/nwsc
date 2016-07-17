<?php echo $this->element('side');?>
<div class="schoolfees form large-9 medium-8 columns content">
    <?= $this->Form->create($schoolfee) ?>
    <fieldset>
        <legend><?= __('Edit Schoolfee') ?></legend>
        <?php
            echo $this->Form->input('classroom_id', ['options' => $classrooms]);
            $month = ['01' => 'January', '02' => 'Fabruary','03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07'=>'July',
                '08'=>'August', '09'=>'September','10'=> 'October','11'=>'November','12'=>'December'];
            echo $this->Form->input('month', ['options' => $month]);
            echo $this->Form->input('fee');
            $val = ['0' => 'Inactive', '1' => 'Active'];
            echo $this->Form->input('status', ['options' => $val]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
