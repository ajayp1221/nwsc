<?php
namespace App\Model\Table;

use App\Model\Entity\Homework;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Homeworks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schools
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 * @property \Cake\ORM\Association\BelongsTo $Classrooms
 * @property \Cake\ORM\Association\BelongsTo $Teachers
 * @property \Cake\ORM\Association\HasMany $Homeworkquestions
 */
class HomeworksTable extends Table
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

        $this->table('homeworks');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
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
        $this->hasMany('Homeworkquestions', [
            'foreignKey' => 'homework_id',
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
            ->requirePresence('session', 'create')
            ->notEmpty('session');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

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
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        $rules->add($rules->existsIn(['classroom_id'], 'Classrooms'));
        $rules->add($rules->existsIn(['teacher_id'], 'Teachers'));
        return $rules;
    }
    public function beforeSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity,$options =[]){
        if($entity['img']['error']=='0'){
            $ext = pathinfo($entity['csv']['name'], PATHINFO_EXTENSION);
            $imgName = rand(0,100).time().'.'.$ext;
            $entity['image'] = $imgName;
            $entity['csv']['name'] = $imgName;
        }
        return $entity;
    }
    public function afterSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity,$options =[]){
        if($entity['img']['error']=='0'){
            $destination = "upload/homeworks/".$entity['csv']['name'];
            $filename = $entity['csv']['tmp_name'];
            move_uploaded_file($filename, $destination);
        }
        return $entity;
    }
}
