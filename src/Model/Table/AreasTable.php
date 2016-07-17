<?php
namespace App\Model\Table;

use App\Model\Entity\Area;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Areas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\HasMany $Schools
 * @property \Cake\ORM\Association\HasMany $Students
 * @property \Cake\ORM\Association\HasMany $Teachers
 * @property \Cake\ORM\Association\HasMany $Users
 */
class AreasTable extends Table
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

        $this->table('areas');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Schools', [
            'foreignKey' => 'area_id'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'area_id'
        ]);
        $this->hasMany('Teachers', [
            'foreignKey' => 'area_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'area_id'
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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        return $rules;
    }
}
