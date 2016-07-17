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
                    Change Password
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Password</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Change Password</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo $this->Form->create($teacher); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                                <?php echo $this->Form->input('old_password',[
                                                    'label' =>false,'div'=>FALSE,'class'=>'form-control','style' => 'width:100%'
                                                ]);?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>New Password</label>
                                                <?php echo $this->Form->input('password1',[
                                                    'label' => false,'div'=>false,'class' => 'form-control','style' => 'width:100%'
                                                ]);?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                                <?php echo $this->Form->input('password2',[
                                                    'label' => false,'div'=>false,'class' => 'form-control','style' => 'width:100%'
                                                ]);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right">Update Password</button>
                                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jsform'); ?>
