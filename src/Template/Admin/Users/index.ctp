<?php echo $this->element('side');?>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('ownerid') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('first_name','Name') ?></th>
                <th><?= $this->Paginator->sort('mobile') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $usrTbl = Cake\ORM\TableRegistry::get('Users');foreach ($users as $user): ?>
            <?php $addedBy = $usrTbl->find()->select(['id','slug','first_name','last_name'])->where(['ownerid' => $user->ownerid])->first();?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td>
                    <?= $this->Html->link($addedBy->first_name." ". $addedBy->last_name,['controller' =>'users','action'=>'view', $addedBy->slug])?>
                </td>
                <td><?= $user->email ?></td>
                <td><?= $user->first_name." ".$user->last_name?></td>
                <td><?= $user->mobile?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->slug]) ?>
                    <?php if($authUser['role'] == "ADMIN"){?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->slug]) ?>
                        <?php  $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                    <?php }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
