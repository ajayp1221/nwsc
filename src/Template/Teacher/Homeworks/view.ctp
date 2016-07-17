<?php echo $this->element('side');?>
<div class="homeworks view large-9 medium-8 columns content">
    <h3><?= h($homework->title) ?></h3>
    <table class="vertical-table">
        
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($homework->title) ?></td>
        </tr>
        <tr>
            <th><?= __('File') ?></th>
            <td><?= h($homework->file) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($homework->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-M-Y",$homework->created) ?></td>
        </tr>
       
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($homework->status){echo "Active";}else{echo "Deactive";} ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($homework->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Question') ?></h4>
        <?php if (!empty($homework->homeworkquestions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Question') ?></th>
                <th><?= __('Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($homework->homeworkquestions as $homeworkquestions): ?>
            <?php $homeworkquestions->slug;?>
            <tr>
                <td><?= h($homeworkquestions->question) ?></td>
                <td><?= date('d-M-Y',$homeworkquestions->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Homeworkquestions', 'action' => 'view', $homeworkquestions->slug]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Homeworkquestions', 'action' => 'edit', $homeworkquestions->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Homeworkquestions', 'action' => 'delete', $homeworkquestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $homeworkquestions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
