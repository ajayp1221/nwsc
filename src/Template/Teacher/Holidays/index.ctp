<?php echo $this->element('css/cssform'); ?>
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
                    Holiday List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Holiday</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Session Holiday List</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><?= $this->Paginator->sort('title') ?></th>
                                            <th><?= $this->Paginator->sort('reason') ?></th>
                                            <th><?= $this->Paginator->sort('date') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($holidays as $holiday): ?>
                                        <tr>
                                            <td><?= $holiday->title ?></td>
                                            <td><?= h($holiday->reason) ?></td>
                                            <td><?= ($holiday->date) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable');?>