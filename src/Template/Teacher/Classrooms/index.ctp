<?php echo $this->element('css/csstable'); ?>
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php echo $this->element('header'); ?>
        <?php echo $this->element('side'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="col-md-12 center">
                    <?= $this->Flash->render() ?>
                </div>
                <h1>
                    Classroom List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Classroom</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Classroom Table</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><?= $this->Paginator->sort('name') ?></th>
                                            <th><?= $this->Paginator->sort('section') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($classrooms as $classroom): ?>
                                            <?php ($classroom->slug) ?>
                                            <tr>
                                                <td><?= h($classroom->name) ?></td>
                                                <td><?= h($classroom->section) ?></td>
                                                <td class="actions">
                                                    <?= $this->Html->link(__('List Timetable'), ['action' => 'timetablelist', $classroom->slug], ['class' => 'btn bg-olive btn-flat margin']) ?>
                                                    <?= $this->Html->link(__('Add Student'), ['controller' => 'students', 'action' => 'add', $classroom->slug], ['class' => 'btn bg-olive btn-flat margin']) ?>
                                                    <?= $this->Html->link(__('Student List'), ['controller' => 'students', 'action' => 'index', $classroom->slug], ['class' => 'btn bg-olive btn-flat margin']) ?>
                                                    <?= $this->Html->link(__('Take Attendance'), ['action' => 'attendance', $classroom->slug], ['class' => 'btn bg-olive btn-flat margin']) ?>
                                                    <?= $this->Html->link(__('Student Leave List'), ['controller' => 'studentleaves','action' => 'index', $classroom->slug], ['class' => 'btn bg-olive btn-flat margin']) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box -->
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('next') . ' >') ?>
                            </ul>
                            <p><?= $this->Paginator->counter() ?></p>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable'); ?>
]