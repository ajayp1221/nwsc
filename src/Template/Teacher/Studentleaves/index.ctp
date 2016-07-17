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
                    Leave List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Leave</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Leave Table</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><?= $this->Paginator->sort('name') ?></th>
                                            <th><?= $this->Paginator->sort('from_date','Leave Date') ?></th>
                                            <th><?= $this->Paginator->sort('reason') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($studentleaves as $studentleave): ?>
                                            <tr>
                                                <td><?= h($studentleave->student->full_name) ?></td>
                                                <td><?= h($studentleave->from_date) ?></td>
                                                <td><?= h($studentleave->reason) ?></td>
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