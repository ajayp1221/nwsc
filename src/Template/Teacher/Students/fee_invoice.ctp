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
                    <?php echo $student->full_name ?>
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
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php foreach ($fees as $fee) {
                                            $count = 1;
                                            ?>
                                            <div class="printable">
                                                <div class="box-header">
                                                    <button onclick="printMe($(this).parents('.printable'));" class="btn btn-info pull-right">Print</button>
                                                    <h3 class="box-title">
                                                        <?php $ts = mktime(0, 0, 0, $fee->schoolfee->month, 1);
                                                        echo date('F', $ts);
                                                        ?>
                                                    </h3>
                                                </div>
                                                <div class="col-md-12 print-12">
                                                    <h3 class="text-center print-center"><?= $student->school->name ?></h3><hr/>
                                                    <div class="text-left print-left">
                                                        Receipt No. - <span class="print-text-normal"><?= $fee->receipt_no ?></span>
                                                        <div class="text-right print-right">
                                                            Date- <span class="print-text-normal"><?= $fee->date?></span>
                                                        </div>
                                                    </div>
                                                    <div class="text-left print-left">
                                                        Name- <span class="print-text-normal"><?= $student->full_name ?></span>
                                                        <div class="text-right print-right">
                                                            Month- <span class="print-text-normal">
                                                                <?php $ts = mktime(0, 0, 0, $fee->schoolfee->month, 1);
                                                                    echo date('F', $ts);
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="text-left print-left">
                                                        Admission No- <span class="print-text-normal"><?= $student->studentid?></span><br/><br/>
                                                    </div>
                                                    <div class="text-left print-left">
                                                        Class- <span class="print-text-normal"><?= $student->classroom->class_name?></span>
                                                    </div>
                                                    <br/><br/>
                                                </div>
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Details</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($fee->schoolfee->schoolfeeothercharges as $schoolfee) { ?>
                                                            <tr>
                                                                <td class="print-center"><?= $count++; ?></td>
                                                                <td class="print-center"><?= $schoolfee->description ?></td>
                                                                <td class="print-center"><?= $schoolfee->extra_charges ?></td>
                                                                
                                                            </tr>
                                                        <?php } ?>
                                                        <?php if(@$fee->bus_fee){?>
                                                                <tr>
                                                                    <td class="print-center"><?= $count++; ?></td>
                                                                    <td class="print-center">Bus Fee</td>
                                                                    <td class="print-center"><?= $fee->bus_fee ?></td>
                                                                </tr>
                                                        <?php }?>
                                                            
                                                                
                                                            
                                                        <tr>
                                                            <td></td>
                                                            <td class="print-center">Discount - <?= $fee->reason ?></td>
                                                            <td class="print-center"><?= "-".$fee->discount ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td class="print-center">Total Fee</td>
                                                            <td class="print-center"><?= $fee->fee ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="text-right print-right">
                                                    Signature <br/> <span class="print-text-normal"><?= date('d-F-Y')?></span>
                                                </div>
                                            </div>
                                            <hr/>
                                        <?php } ?>
                                    </div>
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
<script type="text/html" id="printCss">
    <style type="text/css">
/*        table{
            width: 100%; 
            border: 1px dashed;
        }
        table td {
            padding: 5px;
            border-bottom: 1px dotted;
            border-right: 1px dotted;
        }*/
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
        }
        button {
            display:none;
        }
        .box-title{
            display:none;
        }
        .print-center{
            text-align: center;
        }
        .print-left{
            text-align: left;
        }
        .print-right{
            text-align: right;
        }
        .print-text-normal{
            font-weight: normal;
        }
        .print-top-10{
            margin-top: -10px;
        }
    </style>
</script>
<script type="text/javascript">
    function printMe(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = el.html() + $('#printCss').html();
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>

