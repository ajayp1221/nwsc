<?php
namespace App\Model\Table;

use App\Model\Entity\School;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Schools Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Areas
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $Settings
 * @property \Cake\ORM\Association\HasMany $Classrooms
 * @property \Cake\ORM\Association\HasMany $Holidays
 * @property \Cake\ORM\Association\HasMany $Resultcategories
 * @property \Cake\ORM\Association\HasMany $Results
 * @property \Cake\ORM\Association\HasMany $Schoolfees
 * @property \Cake\ORM\Association\HasMany $Studentattendances
 * @property \Cake\ORM\Association\HasMany $Studentfees
 * @property \Cake\ORM\Association\HasMany $Students
 * @property \Cake\ORM\Association\HasMany $StudentsSchoolfees
 * @property \Cake\ORM\Association\HasMany $Teacherattendances
 * @property \Cake\ORM\Association\HasMany $Teachers
 * @property \Cake\ORM\Association\HasMany $Teachersalaries
 * @property \Cake\ORM\Association\HasMany $Timetables
 * @property \Cake\ORM\Association\HasMany $Subjects
 * @property \Cake\ORM\Association\HasMany $Teacherleaves
 * @property \Cake\ORM\Association\HasMany $Studentleaves
 * @property \Cake\ORM\Association\HasMany $Homeworks
 * @property \Cake\ORM\Association\HasMany $Examstables
 * @property \Cake\ORM\Association\HasMany $Events
 * @property \Cake\ORM\Association\HasMany $Schoolspayments
 * @property \Cake\ORM\Association\HasMany $Schoolbusfees
 */
class SchoolsTable extends Table
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

        $this->table('schools');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
        $this->hasMany('Settings', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Classrooms', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Holidays', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Resultcategories', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Schoolfees', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentattendances', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentfees', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Examstables', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Teacherleaves', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Studentleaves', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('StudentsSchoolfees', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Teacherattendances', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Teachers', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Teachersalaries', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Timetables', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Subjects', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Homeworks', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Schoolspayments', [
            'foreignKey' => 'school_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Schoolbusfees', [
            'foreignKey' => 'school_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['area_id'], 'Areas'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }
    
    public function beforeSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity,$options =[]){
        if($entity['img']['error']=='0'){
            if($entity['image']){
                unlink("upload/schools/".$entity['image']);
                unlink("upload/schools/720-".$entity['image']);
                unlink("upload/schools/80-".$entity['image']);
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
            $destination = "upload/schools/".$entity['img']['name'];
            $filename = $entity['img']['tmp_name'];
            move_uploaded_file($filename, $destination);
            $uploadDir = "upload/schools";
            $moveToDir = "upload/schools/";
            $resize = new \App\Common\Resize();
            $resize->createthumbnail($entity['img']['name'],"720","720",$uploadDir,$moveToDir);
            $resize->createthumbnail($entity['img']['name'],"80","80",$uploadDir,$moveToDir);
        }
        return $entity;
    }

    public function createthumbnail($image_name,$new_width,$new_height,$uploadDir,$moveToDir) {
        $path = $uploadDir . '/' . $image_name;
        $mime = getimagesize($path);
        if ($mime['mime'] == 'image/png') {
            $src_img = imagecreatefrompng($path);
        }
        if ($mime['mime'] == 'image/jpg') {
            $src_img = imagecreatefromjpeg($path);
        }
        if ($mime['mime'] == 'image/jpeg') {
            $src_img = imagecreatefromjpeg($path);
        }
        if ($mime['mime'] == 'image/pjpeg') {
            $src_img = imagecreatefromjpeg($path);
        }
        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);
        if ($old_x > $old_y) {
            $thumb_w = $new_width;
            $thumb_h = $old_y * ($new_height / $old_x);
        }
        if ($old_x < $old_y) {
            $thumb_w = $old_x * ($new_width / $old_y);
            $thumb_h = $new_height;
        }
        if ($old_x == $old_y) {
            $thumb_w = $new_width;
            $thumb_h = $new_height;
        }
        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
        $new_thumb_loc = $moveToDir .$new_height."-". $image_name;
        if ($mime['mime'] == 'image/png') {
            $result = imagepng($dst_img, $new_thumb_loc, 8);
        }
        if ($mime['mime'] == 'image/jpg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        }
        if ($mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        }
        if ($mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        }
        imagedestroy($dst_img);
        imagedestroy($src_img);
        return $result;
    }
}
