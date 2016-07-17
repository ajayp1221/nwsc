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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Result Category</label>
                                        <?php echo $this->Form->input('resultcategories',[
                                            'option'=>$resultcategories,'label' =>false,'div'=>FALSE,'class'=>'form-control select2','style' => 'width:100%'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Classroom</label>
                                        <?php echo $this->Form->input('classrooms',[
                                            'option' => $classrooms,'label' => false,'div'=>false,'class' => 'form-control select2','style' => 'width:100%'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Subject</label>
                                        <?php echo $this->Form->input('subjects',[
                                            'option' => $subjects,'label' => false,'div'=>false,'class' => 'form-control select2','style' => 'width:100%'
                                        ]);?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Add Mark In Subject</button>
                    </div>
                    <?= $this->Form->end() ?>
                    <?php echo $this->element('footer');?>
                </div>
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jsform'); ?>