<?php
namespace App\Model\Table;

use App\Model\Entity\Teacher;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Teachers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schools
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $Areas
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsToMany $Classrooms
 * @property \Cake\ORM\Association\HasMany $Studentattendances
 * @property \Cake\ORM\Association\HasMany $Students
 * @property \Cake\ORM\Association\HasMany $Teacherattendances
 * @property \Cake\ORM\Association\HasMany $Teachersalaries
 * @property \Cake\ORM\Association\HasMany $Timetables
 * @property \Cake\ORM\Association\HasMany $Teacherleaves
 * @property \Cake\ORM\Association\HasMany $Studentleaves
 * @property \Cake\ORM\Association\HasMany $Seenotifications
 * @property \Cake\ORM\Association\HasMany $Events
 */
class TeachersTable extends Table
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

        $this->table('teachers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Areas', [
            'foreignKey' => 'area_id',
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
        $this->hasMany('Studentattendances', [
            'foreignKey' => 'teacher_id',
            'dependent' => true
        ]);
        $this->hasMany('Seenotifications', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'teacher_id',
            'dependent' => true
        ]);
        $this->hasMany('Teacherattendances', [
            'foreignKey' => 'teacher_id',
            'dependent' => true
        ]);
        $this->hasMany('Teachersalaries', [
            'foreignKey' => 'teacher_id',
            'dependent' => true
        ]);
        $this->hasMany('Timetables', [
            'foreignKey' => 'teacher_id',
            'dependent' => true
        ]);
        $this->hasMany('Studentleaves', [
            'foreignKey' => 'teacher_id',
            'dependent' => true
        ]);
        $this->hasMany('Teacherleaves', [
            'foreignKey' => 'teacher_id',
            'dependent' => true
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'teacher_id',
            'dependent' => true
        ]);
        $this->belongsToMany('Classrooms', [
            'foreignKey' => 'teacher_id',
            'targetForeignKey' => 'classroom_id',
            'joinTable' => 'classrooms_teachers',
            'dependent' => true
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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['school_id'], 'Schools'));
        $rules->add($rules->existsIn(['area_id'], 'Areas'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }
    
    public function beforeSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity,$options =[]){
        if($entity['img']['error']=='0'){
            if($entity['image']){
                unlink("upload/teachers/".$entity['image']);
                unlink("upload/teachers/720-".$entity['image']);
                unlink("upload/teachers/80-".$entity['image']);
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
            $destination = "upload/teachers/".$entity['img']['name'];
            $filename = $entity['img']['tmp_name'];
            move_uploaded_file($filename, $destination);
            $uploadDir = "upload/teachers";
            $moveToDir = "upload/teachers/";
            $resize = new \App\Common\Resize();
            $resize->createthumbnail($entity['img']['name'],"720","720",$uploadDir,$moveToDir);
            $resize->createthumbnail($entity['img']['name'],"80","80",$uploadDir,$moveToDir);
        }
        return $entity;
    }
    
    public function validationPassword(Validator $validator )
    {
        $validator
            ->add('old_password','custom',[
                'rule'=>  function($value, $context){
                    $user = $this->get($context['data']['id']);
                    if ($user) {
                        if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                            return true;
                        }
                    }
                    return false;
                },
                'message'=>'The old password does not match the current password!',
            ])
            ->notEmpty('old_password');
        $validator
            ->add('password1', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'The password have to be at least 6 characters!',
                ]
            ])
            ->add('password1',[
                'match'=>[
                    'rule'=> ['compareWith','password2'],
                    'message'=>'The passwords does not match!',
                ]
            ])
            ->notEmpty('password1');
        $validator
            ->add('password2', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'The password have to be at least 6 characters!',
                ]
            ])
            ->add('password2',[
                'match'=>[
                    'rule'=> ['compareWith','password1'],
                    'message'=>'The passwords does not match!',
                ]
            ])
            ->notEmpty('password2');
         return $validator;
    }
}
