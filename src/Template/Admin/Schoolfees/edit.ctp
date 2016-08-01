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
            echo $this->Form->input('fee',['label' => 'Total Fee']);
            $val = ['0' => 'Inactive', '1' => 'Active'];
            $i = 1;
            echo "<b>Fee Charges Description</b>";
            foreach($schoolfee->schoolfeeothercharges as $schoolfeeothercharge){?>
                <label>Fee Charge <?= $i;?></label>
                <?php echo $this->Form->input("schoolfeeothercharges.$i.extra_charges", [
                    'label' => FALSE,'value' => $schoolfeeothercharge->extra_charges
                    ]);
                echo $this->Form->input("schoolfeeothercharges.$i.id",['type' => 'hidden','value' => $schoolfeeothercharge->id]);
                ?>
                <label>Description <?= $i;?></label>
                <?php echo $this->Form->input("schoolfeeothercharges.$i.description", [
                    'label' => FALSE,'type' => 'textarea','value' => $schoolfeeothercharge->description
                ]);
                $i++;
            }
            echo $this->Form->input('status', ['options' => $val]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
