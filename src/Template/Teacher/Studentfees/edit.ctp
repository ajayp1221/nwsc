<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $studentfee->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $studentfee->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Studentfees'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="studentfees form large-9 medium-8 columns content">
    <?= $this->Form->create($studentfee) ?>
    <fieldset>
        <legend><?= __('Edit Studentfee') ?></legend>
        <?php
            echo $this->Form->input('school_id');
            echo $this->Form->input('student_id');
            echo $this->Form->input('schoolfee_id');
            echo $this->Form->input('classroom_id');
            echo $this->Form->input('fee');
            echo $this->Form->input('discount');
            echo $this->Form->input('date');
            echo $this->Form->input('session');
            echo $this->Form->input('status');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
