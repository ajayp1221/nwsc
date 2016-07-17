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
                    Changes In Students
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Students</li>
                </ol>
            </section>
            <section class="content">
                <!-- SELECT2 EXAMPLE -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $student->full_name;?></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                        </div>
                    </div><!-- /.box-header -->
                    <?= $this->Form->create($student, ['type' => 'file']);?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                        <?php echo $this->Form->input('first_name',[
                                            'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Last Name</label>
                                        <?php echo $this->Form->input('last_name',[
                                            'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mobile No</label>
                                        <?php echo $this->Form->input('mobile',[
                                            'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date Of Birth</label>
                                        <?php echo $this->Form->input('dob',[
                                            'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                        <?php echo $this->Form->input('address',[
                                            'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Area</label>
                                        <?php echo $this->Form->input('area_id',[
                                            'options' => $areas,'label' =>false,'div'=>FALSE,'class'=>'form-control select2','style' => 'width:100%'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>City</label>
                                        <?php echo $this->Form->input('city_id',[
                                            'options' => $cities,'label' =>false,'div'=>FALSE,'class'=>'form-control select2','style' => 'width:100%'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>State</label>
                                        <?php echo $this->Form->input('state_id',[
                                            'options' => $states,'label' =>false,'div'=>FALSE,'class'=>'form-control select2','style' => 'width:100%'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Country</label>
                                        <?php echo $this->Form->input('country_id',[
                                            'options' => $countries,'label' =>false,'div'=>FALSE,'class'=>'form-control select2','style' => 'width:100%'
                                        ]);?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pin Code</label>
                                        <?php echo $this->Form->input('pincode',[
                                             'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Father Name</label>
                                        <?php echo $this->Form->input('father_name',[
                                             'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                                <div class="form-group">
                                    <label>Mother Name</label>
                                        <?php echo $this->Form->input('mother_name',[
                                             'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                                <div class="form-group">
                                    <label>Guardian Email</label>
                                        <?php echo $this->Form->input('guardian.email',[
                                            'value' => $student->guardian->email,'label' =>false,'div'=>FALSE,'class'=>'form-control'
                                        ]);?>
                                </div>
                                <?php echo $this->Form->input('guardianidemail',[
                                    'value' => $student->guardian->id,'label' =>false,'div'=>FALSE,'class'=>'form-control','type' =>'hidden'
                                ]);?>
                                <div class="form-group">
                                    <label>Guardian Contact No</label>
                                    <?php echo $this->Form->input('guardian.mobile',[
                                        'value' => $student->guardian->mobile,'label' =>false,'div'=>FALSE,'class'=>'form-control',
                                    ]);?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                    <?= $this->Form->end() ?>
                    <?php echo $this->element('footer');?>
                </div>
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jsform'); ?>
