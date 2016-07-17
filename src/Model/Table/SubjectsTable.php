<?php
namespace App\Model\Table;

use App\Model\Entity\Subject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subjects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schools
 * @property \Cake\ORM\Association\HasMany $Results
 * @property \Cake\ORM\Association\HasMany $Timetables
 * @property \Cake\ORM\Association\HasMany $Examstables
 */
class SubjectsTable extends Table
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

        $this->table('subjects');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'subject_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Timetables', [
            'foreignKey' => 'subject_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Examstables', [
            'foreignKey' => 'subject_id',
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->add('deleted', 'valid', ['rule' => 'numeric'])
            ->requirePresence('deleted', 'create')
            ->notEmpty('deleted');

        return $validator;
    }
}
