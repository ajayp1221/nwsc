<?php
namespace App\Model\Table;

use App\Model\Entity\Classroom;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classrooms Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schools
 * @property \Cake\ORM\Association\HasMany $Results
 * @property \Cake\ORM\Association\HasMany $Schoolfees
 * @property \Cake\ORM\Association\HasMany $Studentfees
 * @property \Cake\ORM\Association\HasMany $Students
 * @property \Cake\ORM\Association\HasMany $StudentsSchoolfees
 * @property \Cake\ORM\Association\HasMany $Timetables
 * @property \Cake\ORM\Association\HasMany $Studentattendances
 * @property \Cake\ORM\Association\HasMany $Events
 * @property \Cake\ORM\Association\HasMany $Examstables
 * @property \Cake\ORM\Association\HasMany $Mobilelocals
 * @property \Cake\ORM\Association\HasMany $Homeworks
 * @property \Cake\ORM\Association\BelongsToMany $Teachers
 */
class ClassroomsTable extends Table
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

        $this->table('classrooms');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Schoolfees', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentfees', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('StudentsSchoolfees', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Timetables', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentattendances', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Examstables', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Mobilelocals', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Homeworks', [
            'foreignKey' => 'classroom_id',
            'dependent' => TRUE
        ]);
        $this->belongsToMany('Teachers', [
            'foreignKey' => 'classroom_id',
            'targetForeignKey' => 'teacher_id',
            'joinTable' => 'classrooms_teachers'
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
        return $rules;
    }
}
