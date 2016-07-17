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
                    Add Mark In Subject
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Result</li>
                </ol>
            </section>
            <section class="content">
                <!-- SELECT2 EXAMPLE -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select Result Category, Class & Subject</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                        </div>
                    </div><!-- /.box-header -->
                    <?= $this->Form->create(NULL) ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b><label>Student Name</label> </b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                     <?php
                                    $totalMark = 100;
                                    if(@$classroom->students[0]->results[0]->total_mark){
                                        $totalMark = $classroom->students[0]->results[0]->total_mark;
                                    }?>
                                    <label>Total Mark </label>
                                    <input type="text" value="<?= $totalMark?>" name="total_mark" class="form-control" />
                                </div>
                            </div>
                            <?php $i = 1;foreach ($classroom->students as $student): ?>
                            <div class="col-md-12">
                                
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo "<b>$i - </b>";?>
                                        <?php if($student->image){?>
                                            <img src="<?php echo $student->api_img_medium; ?>" alt="<?= $student->full_name?>"/>
                                        <?php }else{?>
                                            <img src="/img/user.jpg" height="50" width="50" alt="<?= $student->full_name?>"/>
                                        <?php }?>
                                        <?php echo $student->full_name;?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo $this->Form->input("result.$i.get_marks",[
                                            'value' => @$student->results[0]->get_marks,
                                            'label' =>false,'div'=>FALSE,'class'=>'form-control','style' => 'width:100%'
                                        ]);
                                        echo $this->Form->input("result.$i.student_id",['value' => $student->id,'type' => 'hidden']);?> 
                                    </div>
                                </div>
                             </div>
                            <?php $i++;endforeach; ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Save Student Mark</button>
                    </div>
                    <?= $this->Form->end() ?>
                    <?php echo $this->element('footer');?>
                </div>
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable');?>