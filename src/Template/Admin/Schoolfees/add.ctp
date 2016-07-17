<?php echo $this->element('side');?>
<div class="schoolfees form large-9 medium-8 columns content">
    <?= $this->Form->create($schoolfee) ?>
    <fieldset>
        <legend><?= __('Add Schoolfee') ?></legend>
        <?php
            echo $this->Form->input('classroom_id', ['options' => $classrooms]);
            $month = ['01' => 'January', '02' => 'Fabruary','03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07'=>'July',
                '08'=>'August', '09'=>'September','10'=> 'October','11'=>'November','12'=>'December'];
            echo $this->Form->input('month', ['options' => $month]);
            echo $this->Form->input('fee');
        ?>
        <?php for($i=1;$i<=5;$i++){?>
        <div class="col-md-12">
                <label>Extra Charges <?= $i;?></label>
                <?php echo $this->Form->input("schoolfeeothercharge.$i.extra_charges", [
                    'label' => FALSE
                    ]);?>
                <label>Description <?= $i;?></label>
                <?php echo $this->Form->input("schoolfeeothercharge.$i.description", [
                    'label' => FALSE,'type' => 'textarea'
                    ]);?>
        </div>
        <?php } ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
