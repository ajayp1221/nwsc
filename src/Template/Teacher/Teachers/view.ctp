<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Teacher'), ['action' => 'edit', $teacher->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Teacher'), ['action' => 'delete', $teacher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacher->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Areas'), ['controller' => 'Areas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Area'), ['controller' => 'Areas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Studentattendances'), ['controller' => 'Studentattendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Studentattendance'), ['controller' => 'Studentattendances', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teacherattendances'), ['controller' => 'Teacherattendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacherattendance'), ['controller' => 'Teacherattendances', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachersalaries'), ['controller' => 'Teachersalaries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teachersalary'), ['controller' => 'Teachersalaries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Timetables'), ['controller' => 'Timetables', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetables', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classrooms'), ['controller' => 'Classrooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classroom'), ['controller' => 'Classrooms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teachers view large-9 medium-8 columns content">
    <h3><?= h($teacher->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Area') ?></th>
            <td><?= $teacher->has('area') ? $this->Html->link($teacher->area->name, ['controller' => 'Areas', 'action' => 'view', $teacher->area->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $teacher->has('school') ? $this->Html->link($teacher->school->name, ['controller' => 'Schools', 'action' => 'view', $teacher->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= $teacher->has('city') ? $this->Html->link($teacher->city->name, ['controller' => 'Cities', 'action' => 'view', $teacher->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $teacher->has('state') ? $this->Html->link($teacher->state->name, ['controller' => 'States', 'action' => 'view', $teacher->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $teacher->has('country') ? $this->Html->link($teacher->country->name, ['controller' => 'Countries', 'action' => 'view', $teacher->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('First Name') ?></th>
            <td><?= h($teacher->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Name') ?></th>
            <td><?= h($teacher->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($teacher->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($teacher->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Mobile') ?></th>
            <td><?= h($teacher->mobile) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td><?= h($teacher->image) ?></td>
        </tr>
        <tr>
            <th><?= __('Dob') ?></th>
            <td><?= h($teacher->dob) ?></td>
        </tr>
        <tr>
            <th><?= __('Salary') ?></th>
            <td><?= h($teacher->salary) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($teacher->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Lat') ?></th>
            <td><?= h($teacher->lat) ?></td>
        </tr>
        <tr>
            <th><?= __('Long') ?></th>
            <td><?= h($teacher->long) ?></td>
        </tr>
        <tr>
            <th><?= __('Device Token') ?></th>
            <td><?= h($teacher->device_token) ?></td>
        </tr>
        <tr>
            <th><?= __('Deviceid') ?></th>
            <td><?= h($teacher->deviceid) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($teacher->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($teacher->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($teacher->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Pincode') ?></th>
            <td><?= $this->Number->format($teacher->pincode) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($teacher->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($teacher->deleted) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($teacher->address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Studentattendances') ?></h4>
        <?php if (!empty($teacher->studentattendances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Student Id') ?></th>
                <th><?= __('Teacher Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Attendance') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teacher->studentattendances as $studentattendances): ?>
            <tr>
                <td><?= h($studentattendances->id) ?></td>
                <td><?= h($studentattendances->school_id) ?></td>
                <td><?= h($studentattendances->student_id) ?></td>
                <td><?= h($studentattendances->teacher_id) ?></td>
                <td><?= h($studentattendances->classroom_id) ?></td>
                <td><?= h($studentattendances->attendance) ?></td>
                <td><?= h($studentattendances->session) ?></td>
                <td><?= h($studentattendances->status) ?></td>
                <td><?= h($studentattendances->deleted) ?></td>
                <td><?= h($studentattendances->date) ?></td>
                <td><?= h($studentattendances->created) ?></td>
                <td><?= h($studentattendances->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Studentattendances', 'action' => 'view', $studentattendances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Studentattendances', 'action' => 'edit', $studentattendances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Studentattendances', 'action' => 'delete', $studentattendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentattendances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Students') ?></h4>
        <?php if (!empty($teacher->students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Teacher Id') ?></th>
                <th><?= __('Guardian Id') ?></th>
                <th><?= __('Studentid') ?></th>
                <th><?= __('Session') ?></th>
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
                <th><?= __('Father Name') ?></th>
                <th><?= __('Mother Name') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teacher->students as $students): ?>
            <tr>
                <td><?= h($students->id) ?></td>
                <td><?= h($students->school_id) ?></td>
                <td><?= h($students->classroom_id) ?></td>
                <td><?= h($students->teacher_id) ?></td>
                <td><?= h($students->guardian_id) ?></td>
                <td><?= h($students->studentid) ?></td>
                <td><?= h($students->session) ?></td>
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
                <td><?= h($students->father_name) ?></td>
                <td><?= h($students->mother_name) ?></td>
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
        <h4><?= __('Related Teacherattendances') ?></h4>
        <?php if (!empty($teacher->teacherattendances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Teacher Id') ?></th>
                <th><?= __('In Time') ?></th>
                <th><?= __('Out Time') ?></th>
                <th><?= __('Attendance') ?></th>
                <th><?= __('Approvedby') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teacher->teacherattendances as $teacherattendances): ?>
            <tr>
                <td><?= h($teacherattendances->id) ?></td>
                <td><?= h($teacherattendances->school_id) ?></td>
                <td><?= h($teacherattendances->teacher_id) ?></td>
                <td><?= h($teacherattendances->in_time) ?></td>
                <td><?= h($teacherattendances->out_time) ?></td>
                <td><?= h($teacherattendances->attendance) ?></td>
                <td><?= h($teacherattendances->approvedby) ?></td>
                <td><?= h($teacherattendances->session) ?></td>
                <td><?= h($teacherattendances->status) ?></td>
                <td><?= h($teacherattendances->deleted) ?></td>
                <td><?= h($teacherattendances->created) ?></td>
                <td><?= h($teacherattendances->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Teacherattendances', 'action' => 'view', $teacherattendances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Teacherattendances', 'action' => 'edit', $teacherattendances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teacherattendances', 'action' => 'delete', $teacherattendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacherattendances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Teachersalaries') ?></h4>
        <?php if (!empty($teacher->teachersalaries)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Teacher Id') ?></th>
                <th><?= __('Salary') ?></th>
                <th><?= __('Salary Date') ?></th>
                <th><?= __('Month') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teacher->teachersalaries as $teachersalaries): ?>
            <tr>
                <td><?= h($teachersalaries->id) ?></td>
                <td><?= h($teachersalaries->school_id) ?></td>
                <td><?= h($teachersalaries->teacher_id) ?></td>
                <td><?= h($teachersalaries->salary) ?></td>
                <td><?= h($teachersalaries->salary_date) ?></td>
                <td><?= h($teachersalaries->month) ?></td>
                <td><?= h($teachersalaries->session) ?></td>
                <td><?= h($teachersalaries->status) ?></td>
                <td><?= h($teachersalaries->deleted) ?></td>
                <td><?= h($teachersalaries->created) ?></td>
                <td><?= h($teachersalaries->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Teachersalaries', 'action' => 'view', $teachersalaries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Teachersalaries', 'action' => 'edit', $teachersalaries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teachersalaries', 'action' => 'delete', $teachersalaries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teachersalaries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Timetables') ?></h4>
        <?php if (!empty($teacher->timetables)): ?>
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
            <?php foreach ($teacher->timetables as $timetables): ?>
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
        <h4><?= __('Related Events') ?></h4>
        <?php if (!empty($teacher->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Teacher Id') ?></th>
                <th><?= __('Classroom Id') ?></th>
                <th><?= __('Session') ?></th>
                <th><?= __('Event Type') ?></th>
                <th><?= __('Event Name') ?></th>
                <th><?= __('Start Time') ?></th>
                <th><?= __('End Time') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('File') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teacher->events as $events): ?>
            <tr>
                <td><?= h($events->id) ?></td>
                <td><?= h($events->school_id) ?></td>
                <td><?= h($events->teacher_id) ?></td>
                <td><?= h($events->classroom_id) ?></td>
                <td><?= h($events->session) ?></td>
                <td><?= h($events->event_type) ?></td>
                <td><?= h($events->event_name) ?></td>
                <td><?= h($events->start_time) ?></td>
                <td><?= h($events->end_time) ?></td>
                <td><?= h($events->description) ?></td>
                <td><?= h($events->file) ?></td>
                <td><?= h($events->status) ?></td>
                <td><?= h($events->deleted) ?></td>
                <td><?= h($events->created) ?></td>
                <td><?= h($events->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Classrooms') ?></h4>
        <?php if (!empty($teacher->classrooms)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Section') ?></th>
                <th><?= __('Slug') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teacher->classrooms as $classrooms): ?>
            <tr>
                <td><?= h($classrooms->id) ?></td>
                <td><?= h($classrooms->school_id) ?></td>
                <td><?= h($classrooms->name) ?></td>
                <td><?= h($classrooms->section) ?></td>
                <td><?= h($classrooms->slug) ?></td>
                <td><?= h($classrooms->status) ?></td>
                <td><?= h($classrooms->deleted) ?></td>
                <td><?= h($classrooms->created) ?></td>
                <td><?= h($classrooms->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Classrooms', 'action' => 'view', $classrooms->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Classrooms', 'action' => 'edit', $classrooms->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Classrooms', 'action' => 'delete', $classrooms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classrooms->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
