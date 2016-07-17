<?php
namespace App\Model\Table;

use App\Model\Entity\Messagesmslog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Messagesmslogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Messagelogs
 */
class MessagesmslogsTable extends Table
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

        $this->table('messagesmslogs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Messagelogs', [
            'foreignKey' => 'messagelog_id',
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

        $validator
            ->requirePresence('model_name', 'create')
            ->notEmpty('model_name');

        $validator
            ->integer('modelid')
            ->requirePresence('modelid', 'create')
            ->notEmpty('modelid');

        $validator
            ->requirePresence('mobile_number', 'create')
            ->notEmpty('mobile_number');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['messagelog_id'], 'Messagelogs'));
        return $rules;
    }
}
