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
                    Student List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Student</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Student Table</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><?= $this->Paginator->sort('Image') ?></th>
                                            <th><?= $this->Paginator->sort('first_name', 'Name') ?></th>
                                            <!--<th> <label>Select Result Type</label> </th>-->
                                            <th class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($students as $student): $student->slug;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php if($student->image){?>
                                                        <img height="50" width="50" src="<?php echo $student->api_img_medium; ?>" alt="<?= $student->full_name?>"/>
                                                    <?php }else{?>
                                                        <img src="/img/user.jpg" height="50" width="50" alt="<?= $student->full_name?>"/>
                                                    <?php }?>
                                                </td>
                                                <td><?= $student->full_name ?></td>
                                                <?= $this->Form->create() ?>
<!--                                                <td> <?php /*echo $this->Form->input("resultcategories", [
                                                            'option' => $resultcategories, 'label' => FALSE,'div' =>false,'class'=> 'form-control'
                                                            ]) ?>
                                                    <?php echo $this->Form->button(__('Add Result'),['class' => 'btn bg-olive btn-flat margin']) ?>
                                                    <?php echo $this->Form->input("studentslug", ['value' => $student->slug, 'type' => 'hidden']) */?>
                                                </td>-->
                                                <?= $this->Form->end() ?>
                                                <td class="actions">
                                                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $student->slug], ['class' => 'btn bg-olive btn-flat margin']); ?>
                                                    <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $student->slug], ['class' => 'btn bg-olive btn-flat margin']); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box -->
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('next') . ' >') ?>
                            </ul>
                            <p><?= $this->Paginator->counter() ?></p>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable'); ?>
