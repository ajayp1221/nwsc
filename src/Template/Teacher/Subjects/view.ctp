<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subject'), ['action' => 'edit', $subject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subject'), ['action' => 'delete', $subject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Results'), ['controller' => 'Results', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result'), ['controller' => 'Results', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Timetables'), ['controller' => 'Timetables', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetables', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subjects view large-9 medium-8 columns content">
    <h3><?= h($subject->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $subject->has('school') ? $this->Html->link($subject->school->name, ['controller' => 'Schools', 'action' => 'view', $subject->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($subject->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Total Mark') ?></th>
            <td><?= h($subject->total_mark) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($subject->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($subject->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($subject->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($subject->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($subject->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->Number->format($subject->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Results') ?></h4>
        <?php if (!empty($subject->results)): ?>
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
            <?php foreach ($subject->results as $results): ?>
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
    <div class="related">
        <h4><?= __('Related Timetables') ?></h4>
        <?php if (!empty($subject->timetables)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Subject Id') ?></th>
                <th><?= __('Teacher Id') ?></th>
                <th><?= __('Period No') ?></th>
                <th><?= __('Period Time') ?></th>
                <th><?= __('Days') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subject->timetables as $timetables): ?>
            <tr>
                <td><?= h($timetables->id) ?></td>
                <td><?= h($timetables->school_id) ?></td>
                <td><?= h($timetables->classroom_id) ?></td>
                <td><?= h($timetables->subject_id) ?></td>
                <td><?= h($timetables->teacher_id) ?></td>
                <td><?= h($timetables->period_no) ?></td>
                <td><?= h($timetables->period_time) ?></td>
                <td><?= h($timetables->days) ?></td>
                <td><?= h($timetables->session) ?></td>
                <td><?= h($timetables->status) ?></td>
                <td><?= h($timetables->deleted) ?></td>
                <td><?= h($timetables->created) ?></td>
                <td><?= h($timetables->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Timetables', 'action' => 'view', $timetables->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Timetables', 'action' => 'edit', $timetables->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Timetables', 'action' => 'delete', $timetables->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timetables->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
