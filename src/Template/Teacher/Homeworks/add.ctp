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
                    Homework Add
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="/teacher/homeworks">Homework</a></li>
                    <li class="active">Add-Homewrok</li>
                </ol>
            </section>
            <section class="content">
                <!-- SELECT2 EXAMPLE -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Questions</h3>
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
                                    <label>Homework Title</label>
                                    <?php echo $this->Form->input('title',['label' => false,'div' => false,'class' => 'form-control','required']);?>
                                </div><!-- /.form-group -->
                            </div>
                            <?php for($i=1;$i<=9;$i++){?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Question <?= $i;?></label>
                                    <?php echo $this->Form->input("questions.$i.question", [
                                        'label' => FALSE,'div' => false,'type' =>'textarea','class' => 'form-control'
                                        ]);?>
                                </div>
                            </div>
                            <?php $i++;} ?>
                            <!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Add New Homework</button>
                    </div>
                    <?= $this->Form->end() ?>
                    <?php echo $this->element('footer');?>
                </div><!-- /.box -->

            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jsform'); ?>
