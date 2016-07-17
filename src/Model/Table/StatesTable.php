<?php
namespace App\Model\Table;

use App\Model\Entity\State;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * States Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $Cities
 * @property \Cake\ORM\Association\HasMany $Schools
 * @property \Cake\ORM\Association\HasMany $Students
 * @property \Cake\ORM\Association\HasMany $Teachers
 * @property \Cake\ORM\Association\HasMany $Users
 */
class StatesTable extends Table
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

        $this->table('states');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('Schools', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('Teachers', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'state_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('meta_title', 'create')
            ->notEmpty('meta_title');

        $validator
            ->requirePresence('meta_keywords', 'create')
            ->notEmpty('meta_keywords');

        $validator
            ->requirePresence('meta_description', 'create')
            ->notEmpty('meta_description');

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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }
}
