<?php
namespace App\Model\Table;

use App\Model\Entity\Student;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schools
 * @property \Cake\ORM\Association\BelongsTo $Classrooms
 * @property \Cake\ORM\Association\BelongsTo $Teachers
 * @property \Cake\ORM\Association\BelongsTo $Areas
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $Results
 * @property \Cake\ORM\Association\HasMany $Seenotifications
 * @property \Cake\ORM\Association\HasMany $Studentattendances
 * @property \Cake\ORM\Association\HasMany $Studentfees
 * @property \Cake\ORM\Association\HasMany $Studentleaves
 * @property \Cake\ORM\Association\BelongsToMany $Guardians
 * @property \Cake\ORM\Association\BelongsToMany $Schoolfees
 * @property \Cake\ORM\Association\BelongsToMany $Studentfees
 */
class StudentsTable extends Table
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

        $this->table('students');
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
        $this->belongsTo('Teachers', [
            'foreignKey' => 'teacher_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Areas', [
            'foreignKey' => 'area_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Seenotifications', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentattendances', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentfees', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentleaves', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->belongsToMany('Guardians', [
            'foreignKey' => 'student_id',
            'targetForeignKey' => 'guardian_id',
            'joinTable' => 'guardians_students'
        ]);
        $this->belongsToMany('Schoolfees', [
            'foreignKey' => 'student_id',
            'targetForeignKey' => 'schoolfee_id',
            'joinTable' => 'students_schoolfees'
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
            ->requirePresence('session', 'create')
            ->notEmpty('session');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->integer('gender')
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');
        
        $validator
            ->requirePresence('dob', 'create')
            ->notEmpty('dob');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->requirePresence('father_name', 'create')
            ->notEmpty('father_name');

        $validator
            ->requirePresence('mother_name', 'create')
            ->notEmpty('mother_name');

        $validator
            ->requirePresence('guardian_mobile_1', 'create')
            ->notEmpty('guardian_mobile_1');

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
//        $rules->add($rules->isUnique(['email']));
//        $rules->add($rules->existsIn(['school_id'], 'Schools'));
//        $rules->add($rules->existsIn(['classroom_id'], 'Classrooms'));
//        $rules->add($rules->existsIn(['teacher_id'], 'Teachers'));
//        $rules->add($rules->existsIn(['area_id'], 'Areas'));
//        $rules->add($rules->existsIn(['city_id'], 'Cities'));
//        $rules->add($rules->existsIn(['state_id'], 'States'));
//        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }
    
    public function beforeSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity,$options =[]){
        if($entity['img']['error']=='0'){
            if($entity['image']){
                unlink("upload/students/".$entity['image']);
                unlink("upload/students/720-".$entity['image']);
                unlink("upload/students/80-".$entity['image']);
            }
            $ext = pathinfo($entity['img']['name'], PATHINFO_EXTENSION);
            $imgName = rand(0,100).time().'.'.$ext;
            $entity['image'] = $imgName;
            $entity['img']['name'] = $imgName;
        }
        return $entity;
    }
    public function afterSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity,$options =[]){
        if($entity['img']['error']=='0'){
            $destination = "upload/students/".$entity['img']['name'];
            $filename = $entity['img']['tmp_name'];
            move_uploaded_file($filename, $destination);
            $uploadDir = "upload/students";
            $moveToDir = "upload/students/";
            $resize = new \App\Common\Resize();
            $resize->createthumbnail($entity['img']['name'],"720","720",$uploadDir,$moveToDir);
            $resize->createthumbnail($entity['img']['name'],"80","80",$uploadDir,$moveToDir);
        }
        return $entity;
    }
}
