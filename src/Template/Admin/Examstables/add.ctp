<?php echo $this->element('side');?>
<div class="examstables form large-9 medium-8 columns content">
    <?= $this->Form->create(NULL,['url' => "/admin/examstables/add/".$classrooms->slug]) ?>
    <fieldset>
        <legend><?= __('Add Examstable') ?></legend>
        <?php
            echo $this->Form->input('exam_name',['required']);
            for($i = 1;$i<=count($subjects->toArray());$i++){
                echo $this->Form->input("subject_id[$i]", ['options' => $subjects,'label'=>"Select Subject - $i"]);
                echo $this->Form->input("on_date[$i]",['label' => 'On Date','required']);
                echo $this->Form->input("time[$i]",['label' => 'Time','required']);
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
