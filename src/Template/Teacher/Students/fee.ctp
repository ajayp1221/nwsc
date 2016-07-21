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
                    <?php echo $student->full_name?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Classroom</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-9">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Month</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?= $this->Form->create(NULL);?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php 
                                        $endMonth = 11;
                                        $feeStartMonth = $startmonth->value;
                                        if(@$studentfees){
                                            $endMonth = 11-count($studentfees);
                                            $cc = mktime(0, 0, 0, $feeStartMonth + count($studentfees), 1);
                                            $feeStartMonth = date("m", $cc);
                                        }
                                        $startMonth = $startmonth->value;
                                        for($c=0;$c<=$endMonth;$c++){
                                            $ts = mktime(0, 0, 0, $feeStartMonth + $c, 1);
                                            $monthName = date("m", $ts);
                                            ?>
                                            <div class="col-md-2">
                                                <input type ="checkbox" name="month[<?= $monthName?>]" value="<?= $monthName.":".$student->school_id.":".$student->classroom_id.":".$student->session ?>" onclick="selectmonth('<?= $monthName.":".$student->school_id.":".$student->classroom_id.":".$student->session ?>')" />
                                                <?php echo $month = date('F',$ts);?>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <?php if(count($studentfees)==12){echo "This session fees has been submitted successfully";}else{ ?>
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
                                            <input type="text" name="discount" placeholder="In Rupees" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Reason</label>
                                            <textarea name="reason" class="form-control" placeholder="Discount Reason"></textarea>
                                        </div>
                                    </div>
                                    <?php if($busfees){ ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Bus Fee (<?= $student->is_bus." K.M."?>)</label>
                                                <input type="text" name="busfee" class="form-control" />
                                            </div>
                                        </div>
                                    <?php }?>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right">Submit-Fee</button>
                                    </div>
                                <?php }?>
                                <?= $this->Form->end() ?>
                                <hr/>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Fee-Rs</th>
                                            <th>Fee discount</th>
                                            <?php if($student->is_bus){echo "<th>Bus Fees</th>"; }?>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($studentfees as $studentfee): ?>
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
                                                <?php if($studentfee->bus_fee){echo "<td>".$studentfee->bus_fee."</td>"; }?>
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
                    <div class="col-xs-3">
                        <div class="box box-primary">
                            <div class="box-body">
                                <?php if($busfees){?>
                                    <div class="box-header">
                                        <h3 class="box-title">Bus Fee</h3>
                                    </div>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Distance</th>
                                                <th>Fee</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($busfees as $busfee){?>
                                                <tr>
                                                    <td><?= $busfee->distance?>K.M.</td>
                                                    <td><?= $busfee->fee?>rs</td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                <?php }?>
                                <div class="box-header">
                                    <h3 class="box-title">Month</h3>
                                </div><!-- /.box-header -->
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($schoolfees as $schoolfee):if($feeStartMonth<=$schoolfee->month){?>
                                            <tr>
                                                <td>
                                                    <?= date('F', mktime(0, 0, 0, $schoolfee->month, 10)); ?>
                                                </td>
                                                <td>
                                                    <?= $schoolfee->fee ?>
                                                </td>
                                            </tr>
                                        <?php }endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    
    