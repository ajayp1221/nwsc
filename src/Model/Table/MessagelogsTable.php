<?php
namespace App\Model\Table;

use App\Model\Entity\Messagelog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Messagelogs Model
 *
 * @property \Cake\ORM\Association\HasMany $Messagesmslogs
 */
class MessagelogsTable extends Table
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

        $this->table('messagelogs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Messagesmslogs', [
            'foreignKey' => 'messagelog_id'
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
            ->requirePresence('message', 'create')
            ->notEmpty('message');

        return $validator;
    }
}
