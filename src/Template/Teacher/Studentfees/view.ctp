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
                    Student Fees Record
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Fee</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="<?= $student->api_img_medium?>" alt="<?= $student->full_name?>">
                                </div><!-- /.widget-user-image -->
                                <h3 class="widget-user-username"><?= $student->full_name?></h3>
                                <h5 class="widget-user-desc"><?= ucfirst($student->classroom->class_name)?></h5>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                                    <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                                    <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                                    <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                                </ul>
                            </div>
                        </div><!-- /.widget-user -->
                    </div>
                    <?php foreach($student->studentfees as $studentfee){  ?>                        
                        <div class="col-md-12">
                            <!-- Box Comment -->
                            <div class="box box-widget">
                                <div class="box-header with-border">
                                    <div class="user-block">
                                        <div style="position: absolute;
                                            padding: 10px;
                                            color: aliceblue;
                                            font-size: 25px;
                                            font-weight: bold;
                                            background: rebeccapurple;border-radius: 50%;margin-top: -7px;"> 
                                            <?= substr(date("F",  strtotime($studentfee->date)),0,1)?>
                                        </div>
                                        <span class="username">
                                            <a href="#">
                                                <?= date("F",  strtotime($studentfee->date))?>
                                            </a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM Today</span>
                                    </div><!-- /.user-block -->
                                    <div class="box-tools">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <p><b>Fee - </b> <?= $studentfee->fee?></p>
                                    <p><b>Date - </b> <?= $studentfee->date?></p>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    <?php } ?>
                </div>          
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jsform'); ?>