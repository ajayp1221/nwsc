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
    <?= $this->Form->create($student, ['type' => 'file']) ?>
        
        <?php $i = 0;
            foreach($subjects as $subject){
                if(!@$subject->results[0]->total_mark){@$subject->results[0]->total_mark = 100;}
                echo "<legend>$subject->name</legend>";
                echo "<fieldset>";
                echo $this->Form->input("result.$i.name",['value' => $subject->name,'label' => FALSE,'readonly']);
                echo $this->Form->input("result.$i.get_marks",['value' => @$subject->results[0]->get_marks]);
                echo $this->Form->input("result.$i.total_mark",['value' => $subject->results[0]->total_mark]);
                echo $this->Form->input("result.$i.subject_id",['value' => $subject->id,'type'=>'hidden']);
                echo "</fieldset>";
                $i++;
            }
        ?>
    <?= $this->Form->button(__('Save')) ?>
<?php echo $this->element('footer');?>
                </div>
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable');?>