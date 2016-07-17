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
                    Fee Management
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
                                <div class="col-xs-2">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Classroom List</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($classrooms as $classroom): ?>
                                                <?php $active=""; if($classroom->id==$students->id){
                                                    $active="style='font-weight:bold;background:#FFEBEE'";
                                                }?>
                                                <tr>
                                                    <td <?=$active?>>
                                                        <a href="/teacher/classrooms/fee/<?= $classroom->slug?>" >
                                                            <?= strtoupper($classroom->name)." - ". strtoupper($classroom->section) ?>
                                                        </a>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xs-10">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Fee</th>
                                        </tr>
                                        <?php foreach ($students->students as $student){?>
                                            <tr>
                                                <td><?= $student->studentid?></td>
                                                <td>
                                                    <img height="50" width="50" src="<?php echo $student->api_img_medium; ?>" alt="<?= $student->full_name?>"/>
                                                </td>
                                                <td><?= $student->full_name?></td>
                                                <td><?= $student->father_name?></td>
                                                <td class="actions">
                                                    <?= $this->Html->link(__('Take Fee'), ['controller'=>'students','action' => 'fee', $student->slug], ['class' => 'btn bg-olive btn-flat margin']) ?>
                                                </td>
                                            </tr>
                                        <?php }?>  
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable'); ?>