<?php
namespace App\Model\Table;

use App\Model\Entity\Seenotification;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Seenotifications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Notifications
 * @property \Cake\ORM\Association\BelongsTo $Guardians
 * @property \Cake\ORM\Association\BelongsTo $Students
 * @property \Cake\ORM\Association\BelongsTo $Teachers
 * @property \Cake\ORM\Association\BelongsTo $Guardiandeviceids
 */
class SeenotificationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('seenotifications');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Notifications', [
            'foreignKey' => 'notification_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Guardians', [
            'foreignKey' => 'guardian_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Teachers', [
            'foreignKey' => 'teacher_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Guardiandeviceids', [
            'foreignKey' => 'guardiandeviceid_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }
}
