<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Classroom'), ['action' => 'edit', $classroom->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Classroom'), ['action' => 'delete', $classroom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classroom->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Classrooms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classroom'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Results'), ['controller' => 'Results', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result'), ['controller' => 'Results', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schoolfees'), ['controller' => 'Schoolfees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schoolfee'), ['controller' => 'Schoolfees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Studentfees'), ['controller' => 'Studentfees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Studentfee'), ['controller' => 'Studentfees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students Schoolfees'), ['controller' => 'StudentsSchoolfees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Students Schoolfee'), ['controller' => 'StudentsSchoolfees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Timetables'), ['controller' => 'Timetables', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetables', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="classrooms view large-9 medium-8 columns content">
    <h3><?= h($classroom->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $classroom->has('school') ? $this->Html->link($classroom->school->name, ['controller' => 'Schools', 'action' => 'view', $classroom->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($classroom->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Section') ?></th>
            <td><?= h($classroom->section) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($classroom->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($classroom->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($classroom->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($classroom->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($classroom->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($classroom->deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Results') ?></h4>
        <?php if (!empty($classroom->results)): ?>
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
            <?php foreach ($classroom->results as $results): ?>
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
        <h4><?= __('Related Schoolfees') ?></h4>
        <?php if (!empty($classroom->schoolfees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Fee') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($classroom->schoolfees as $schoolfees): ?>
            <tr>
                <td><?= h($schoolfees->id) ?></td>
                <td><?= h($schoolfees->school_id) ?></td>
                <td><?= h($schoolfees->classroom_id) ?></td>
                <td><?= h($schoolfees->fee) ?></td>
                <td><?= h($schoolfees->session) ?></td>
                <td><?= h($schoolfees->status) ?></td>
                <td><?= h($schoolfees->deleted) ?></td>
                <td><?= h($schoolfees->created) ?></td>
                <td><?= h($schoolfees->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Schoolfees', 'action' => 'view', $schoolfees->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Schoolfees', 'action' => 'edit', $schoolfees->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schoolfees', 'action' => 'delete', $schoolfees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolfees->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Studentfees') ?></h4>
        <?php if (!empty($classroom->studentfees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Student Id') ?></th>
                <th><?= __('Schoolfee Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Fee') ?></th>
                <th><?= __('Discount') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($classroom->studentfees as $studentfees): ?>
            <tr>
                <td><?= h($studentfees->id) ?></td>
                <td><?= h($studentfees->school_id) ?></td>
                <td><?= h($studentfees->student_id) ?></td>
                <td><?= h($studentfees->schoolfee_id) ?></td>
                <td><?= h($studentfees->classroom_id) ?></td>
                <td><?= h($studentfees->fee) ?></td>
                <td><?= h($studentfees->discount) ?></td>
                <td><?= h($studentfees->date) ?></td>
                <td><?= h($studentfees->session) ?></td>
                <td><?= h($studentfees->status) ?></td>
                <td><?= h($studentfees->deleted) ?></td>
                <td><?= h($studentfees->created) ?></td>
                <td><?= h($studentfees->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Studentfees', 'action' => 'view', $studentfees->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Studentfees', 'action' => 'edit', $studentfees->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Studentfees', 'action' => 'delete', $studentfees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentfees->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Students') ?></h4>
        <?php if (!empty($classroom->students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Teacher Id') ?></th>
                <th><?= __('Guardian Id') ?></th>
                <th><?= __('Studentid') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Password') ?></th>
                <th><?= __('Image') ?></th>
                <th><?= __('Mobile') ?></th>
                <th><?= __('Dob') ?></th>
                <th><?= __('Slug') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('Area Id') ?></th>
                <th><?= __('City Id') ?></th>
                <th><?= __('State Id') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Pincode') ?></th>
                <th><?= __('Device Token') ?></th>
                <th><?= __('Deviceid') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($classroom->students as $students): ?>
            <tr>
                <td><?= h($students->id) ?></td>
                <td><?= h($students->school_id) ?></td>
                <td><?= h($students->classroom_id) ?></td>
                <td><?= h($students->teacher_id) ?></td>
                <td><?= h($students->guardian_id) ?></td>
                <td><?= h($students->studentid) ?></td>
                <td><?= h($students->first_name) ?></td>
                <td><?= h($students->last_name) ?></td>
                <td><?= h($students->email) ?></td>
                <td><?= h($students->password) ?></td>
                <td><?= h($students->image) ?></td>
                <td><?= h($students->mobile) ?></td>
                <td><?= h($students->dob) ?></td>
                <td><?= h($students->slug) ?></td>
                <td><?= h($students->address) ?></td>
                <td><?= h($students->area_id) ?></td>
                <td><?= h($students->city_id) ?></td>
                <td><?= h($students->state_id) ?></td>
                <td><?= h($students->country_id) ?></td>
                <td><?= h($students->pincode) ?></td>
                <td><?= h($students->device_token) ?></td>
                <td><?= h($students->deviceid) ?></td>
                <td><?= h($students->status) ?></td>
                <td><?= h($students->deleted) ?></td>
                <td><?= h($students->created) ?></td>
                <td><?= h($students->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Students Schoolfees') ?></h4>
        <?php if (!empty($classroom->students_schoolfees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Student Id') ?></th>
                <th><?= __('Schoolfee Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Fee') ?></th>
                <th><?= __('Discount') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($classroom->students_schoolfees as $studentsSchoolfees): ?>
            <tr>
                <td><?= h($studentsSchoolfees->id) ?></td>
                <td><?= h($studentsSchoolfees->school_id) ?></td>
                <td><?= h($studentsSchoolfees->student_id) ?></td>
                <td><?= h($studentsSchoolfees->schoolfee_id) ?></td>
                <td><?= h($studentsSchoolfees->classroom_id) ?></td>
                <td><?= h($studentsSchoolfees->fee) ?></td>
                <td><?= h($studentsSchoolfees->discount) ?></td>
                <td><?= h($studentsSchoolfees->date) ?></td>
                <td><?= h($studentsSchoolfees->session) ?></td>
                <td><?= h($studentsSchoolfees->status) ?></td>
                <td><?= h($studentsSchoolfees->created) ?></td>
                <td><?= h($studentsSchoolfees->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentsSchoolfees', 'action' => 'view', $studentsSchoolfees->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentsSchoolfees', 'action' => 'edit', $studentsSchoolfees->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentsSchoolfees', 'action' => 'delete', $studentsSchoolfees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentsSchoolfees->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Timetables') ?></h4>
        <?php if (!empty($classroom->timetables)): ?>
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
            <?php foreach ($classroom->timetables as $timetables): ?>
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
    <div class="related">
        <h4><?= __('Related Teachers') ?></h4>
        <?php if (!empty($classroom->teachers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('City Id') ?></th>
                <th><?= __('State Id') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('Pincode') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Password') ?></th>
                <th><?= __('Mobile') ?></th>
                <th><?= __('Image') ?></th>
                <th><?= __('Dob') ?></th>
                <th><?= __('Salary') ?></th>
                <th><?= __('Slug') ?></th>
                <th><?= __('Lat') ?></th>
                <th><?= __('Long') ?></th>
                <th><?= __('Device Token') ?></th>
                <th><?= __('Deviceid') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($classroom->teachers as $teachers): ?>
            <tr>
                <td><?= h($teachers->id) ?></td>
                <td><?= h($teachers->school_id) ?></td>
                <td><?= h($teachers->city_id) ?></td>
                <td><?= h($teachers->state_id) ?></td>
                <td><?= h($teachers->country_id) ?></td>
                <td><?= h($teachers->address) ?></td>
                <td><?= h($teachers->pincode) ?></td>
                <td><?= h($teachers->first_name) ?></td>
                <td><?= h($teachers->last_name) ?></td>
                <td><?= h($teachers->email) ?></td>
                <td><?= h($teachers->password) ?></td>
                <td><?= h($teachers->mobile) ?></td>
                <td><?= h($teachers->image) ?></td>
                <td><?= h($teachers->dob) ?></td>
                <td><?= h($teachers->salary) ?></td>
                <td><?= h($teachers->slug) ?></td>
                <td><?= h($teachers->lat) ?></td>
                <td><?= h($teachers->long) ?></td>
                <td><?= h($teachers->device_token) ?></td>
                <td><?= h($teachers->deviceid) ?></td>
                <td><?= h($teachers->status) ?></td>
                <td><?= h($teachers->deleted) ?></td>
                <td><?= h($teachers->created) ?></td>
                <td><?= h($teachers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Teachers', 'action' => 'view', $teachers->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Teachers', 'action' => 'edit', $teachers->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teachers', 'action' => 'delete', $teachers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teachers->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
