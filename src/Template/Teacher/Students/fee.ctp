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
                                <h3 class="box-title">Month</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?= $this->Form->create(NULL);?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if($student->studentfees[0]->schoolfee->month){
                                            $sessionstartmonth = $student->studentfees[0]->schoolfee->month+1;
                                        }else{
                                            $sessionstartmonth = $startmonth->value;
                                        }
                                        for($i = $sessionstartmonth; $i<=12;$i++){?>
                                            <div class="col-md-2">
                                                <input type ="checkbox" name="month[<?= $i?>]" value="<?= $i.":".$student->school_id.":".$student->classroom_id.":".$student->session ?>" onclick="selectmonth('<?= $i.":".$student->school_id.":".$student->classroom_id.":".$student->session ?>')" />
                                                <?php echo $month = date('F', mktime(0, 0, 0, $i, 10)); ?>
                                            </div>
                                        <?php }for($j = 1; $j<$startmonth->value;$j++){?>
                                            <div class="col-md-2">
                                                <input type ="checkbox" name="month[<?= $j?>]" value="<?= $i.":".$student->school_id.":".$student->classroom_id.":".$student->session ?>" onclick="selectmonth('<?= $j.":".$student->school_id.":".$student->classroom_id.":".$student->session ?>')" />
                                                <?php echo $month = date('F', mktime(0, 0, 0, $j, 10));?>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fee</label>
                                        <input type="text" name="fee" class="form-control" />
                                        <input type="hidden" name="student_id" value="<?= $student->id?>" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="text" name="discount" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Reason</label>
                                        <input type="text" name="resaon" class="form-control" />
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right">Submit-Fee</button>
                                </div>
                                <?= $this->Form->end() ?>
                                <hr/>
                                <div class="box-header">
                                    <h3 class="box-title">Fee Record</h3>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Fee-Rs</th>
                                            <th>Fee discount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($student->studentfees as $studentfee): ?>
                                            <tr>
                                                <td>
                                                    <?= $monthName = date('F', mktime(0, 0, 0, $studentfee->schoolfee->month, 10)); ?>
                                                </td>
                                                <td>
                                                    <?= $studentfee->fee ?>
                                                </td>
                                                <td>
                                                    <?= $studentfee->discount ?>
                                                </td>
                                                <td>
                                                    <?= date("d-M-Y", strtotime($studentfee->date)) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable'); ?>
<script type="text/javascript">
    function selectmonth(id){
//        alert(id);
    }
</script>
    
    