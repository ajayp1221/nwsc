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
 * @property \Cake\ORM\Association\HasMany $Studentattendances
 * @property \Cake\ORM\Association\HasMany $Studentfees
 * @property \Cake\ORM\Association\HasMany $Seenotifications
 * @property \Cake\ORM\Association\BelongsToMany $Schoolfees
 * @property \Cake\ORM\Association\BelongsToMany $Guardians

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
        $this->hasMany('Studentattendances', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Seenotifications', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentfees', [
            'foreignKey' => 'student_id',
            'dependent' => TRUE
        ]);
        $this->belongsToMany('Schoolfees', [
            'foreignKey' => 'student_id',
            'targetForeignKey' => 'schoolfee_id',
            'joinTable' => 'students_schoolfees'
        ]);
        $this->belongsToMany('Guardians', [
            'foreignKey' => 'student_id',
            'targetForeignKey' => 'guardian_id',
            'joinTable' => 'guardians_students'
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
        $rules->add($rules->existsIn(['classroom_id'], 'Classrooms'));
//        $rules->add($rules->existsIn(['teacher_id'], 'Teachers'));
        $rules->add($rules->existsIn(['guardian_id'], 'Guardians'));
//        $rules->add($rules->existsIn(['area_id'], 'Areas'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
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

//    public function createthumbnail($image_name,$new_width,$new_height,$uploadDir,$moveToDir) {
//        $path = $uploadDir . '/' . $image_name;
//        $mime = getimagesize($path);
//        if ($mime['mime'] == 'image/png') {
//            $src_img = imagecreatefrompng($path);
//        }
//        if ($mime['mime'] == 'image/jpg') {
//            $src_img = imagecreatefromjpeg($path);
//        }
//        if ($mime['mime'] == 'image/jpeg') {
//            $src_img = imagecreatefromjpeg($path);
//        }
//        if ($mime['mime'] == 'image/pjpeg') {
//            $src_img = imagecreatefromjpeg($path);
//        }
//        $old_x = imageSX($src_img);
//        $old_y = imageSY($src_img);
//        if ($old_x > $old_y) {
//            $thumb_w = $new_width;
//            $thumb_h = $old_y * ($new_height / $old_x);
//        }
//        if ($old_x < $old_y) {
//            $thumb_w = $old_x * ($new_width / $old_y);
//            $thumb_h = $new_height;
//        }
//        if ($old_x == $old_y) {
//            $thumb_w = $new_width;
//            $thumb_h = $new_height;
//        }
//        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
//        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
//        $new_thumb_loc = $moveToDir .$new_height."-". $image_name;
//        if ($mime['mime'] == 'image/png') {
//            $result = imagepng($dst_img, $new_thumb_loc, 8);
//        }
//        if ($mime['mime'] == 'image/jpg') {
//            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
//        }
//        if ($mime['mime'] == 'image/jpeg') {
//            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
//        }
//        if ($mime['mime'] == 'image/pjpeg') {
//            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
//        }
//        imagedestroy($dst_img);
//        imagedestroy($src_img);
//        return $result;
//    }
}
