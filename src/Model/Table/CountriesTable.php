<?php
namespace App\Model\Table;

use App\Model\Entity\Country;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 * @property \Cake\ORM\Association\HasMany $Schools
 * @property \Cake\ORM\Association\HasMany $States
 * @property \Cake\ORM\Association\HasMany $Students
 * @property \Cake\ORM\Association\HasMany $Teachers
 * @property \Cake\ORM\Association\HasMany $Users
 */
class CountriesTable extends Table
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

        $this->table('countries');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Schools', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('States', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Teachers', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'country_id'
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
}
