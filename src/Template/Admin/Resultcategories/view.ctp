<?php echo $this->element('side');?>
<div class="resultcategories view large-9 medium-8 columns content">
    <h3><?= h($resultcategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $resultcategory->has('school') ? $this->Html->link($resultcategory->school->name, ['controller' => 'Schools', 'action' => 'view', $resultcategory->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($resultcategory->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($resultcategory->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($resultcategory->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($resultcategory->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($resultcategory->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($resultcategory->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($resultcategory->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($resultcategory->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Results') ?></h4>
        <?php if (!empty($resultcategory->results)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Resultcategory Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Student Id') ?></th>
                <th><?= __('Subject Id') ?></th>
                <th><?= __('Get Marks') ?></th>
                <th><?= __('Total Mark') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($resultcategory->results as $results): ?>
            <tr>
                <td><?= h($results->id) ?></td>
                <td><?= h($results->resultcategory_id) ?></td>
                <td><?= h($results->school_id) ?></td>
                <td><?= h($results->classroom_id) ?></td>
                <td><?= h($results->student_id) ?></td>
                <td><?= h($results->subject_id) ?></td>
                <td><?= h($results->get_marks) ?></td>
                <td><?= h($results->total_mark) ?></td>
                <td><?= h($results->session) ?></td>
                <td><?= h($results->status) ?></td>
                <td><?= h($results->deleted) ?></td>
                <td><?= h($results->created) ?></td>
                <td><?= h($results->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Results', 'action' => 'view', $results->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Results', 'action' => 'edit', $results->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Results', 'action' => 'delete', $results->id], ['confirm' => __('Are you sure you want to delete # {0}?', $results->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
