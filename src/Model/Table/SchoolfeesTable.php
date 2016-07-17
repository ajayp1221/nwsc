<?php
namespace App\Model\Table;

use App\Model\Entity\Schoolfee;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Schoolfees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schools
 * @property \Cake\ORM\Association\BelongsTo $Classrooms
 * @property \Cake\ORM\Association\HasMany $Schoolfeeothercharges
 * @property \Cake\ORM\Association\HasMany $Studentfees
 */
class SchoolfeesTable extends Table
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

        $this->table('schoolfees');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Classrooms', [
            'foreignKey' => 'classroom_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Schoolfeeothercharges', [
            'foreignKey' => 'schoolfee_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentfees', [
            'foreignKey' => 'schoolfee_id',
            'dependent' => TRUE
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
            ->requirePresence('month', 'create')
            ->notEmpty('month');

        $validator
            ->integer('fee')
            ->requirePresence('fee', 'create')
            ->notEmpty('fee');

        $validator
            ->requirePresence('session', 'create')
            ->notEmpty('session');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['school_id'], 'Schools'));
        $rules->add($rules->existsIn(['classroom_id'], 'Classrooms'));
        return $rules;
    }
}
