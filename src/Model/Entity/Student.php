<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Student Entity.
 *
 * @property int $id
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property int $classroom_id
 * @property \App\Model\Entity\Classroom $classroom
 * @property int $teacher_id
 * @property \App\Model\Entity\Teacher $teacher
 * @property string $studentid
 * @property string $session
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $gender
 * @property string $password
 * @property string $app_pwd
 * @property int $is_app
 * @property string $image
 * @property string $mobile
 * @property string $dob
 * @property string $slug
 * @property string $address
 * @property int $area_id
 * @property \App\Model\Entity\Area $area
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property int $state_id
 * @property \App\Model\Entity\State $state
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $pincode
 * @property string $device_token
 * @property string $deviceid
 * @property string $father_name
 * @property string $mother_name
 * @property string $guardian_mobile_1
 * @property string $guardian_mobile_2
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\Result[] $results
 * @property \App\Model\Entity\Studentattendance[] $studentattendances
 * @property \App\Model\Entity\Seenotification[] $seenotifications
 * @property \App\Model\Entity\Studentfee[] $studentfees
 * @property \App\Model\Entity\Schoolfee[] $schoolfees
 * @property \App\Model\Entity\Guardian[] $guardians
 * @property \App\Model\Entity\Studentfees[] $studentfees
 */
class Student extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    /**
     * HashPassword
     */
    
    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }
    
    protected $_virtual = [
        'api_img_large','api_img_medium','full_name'
    ];
    
    protected function _getFullName() {
        return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
    }
    protected function _getApiImgLarge(){
        $path = Router::url('/', true);
        if($this->_properties['image']){
            return $path."upload".DS."students".DS."720-".$this->_properties['image'];
        }else{
            return $path."img".DS."user.jpg";
        }
    }
    protected function _getApiImgMedium(){
        $path = Router::url('/', true);
        if($this->_properties['image']){
            return $path."upload".DS."students".DS."80-".$this->_properties['image'];
        }else{
            return $path."img".DS."user-min.jpg";
        }
        
    }
    protected function _setCreated($created){
        return $created->timestamp;
    }
    protected function _setModified($modified){
        return $modified->timestamp;
    }
    /**
     * Slug
     */
    
    protected function _getSlug($slug) {
        $slug = strtolower(\Cake\Utility\Inflector::slug($this->_properties['first_name'] . "-" . $this->_properties['last_name']));
        $tbl = \Cake\ORM\TableRegistry::get('Students');
        $i = 0;
        $query = $tbl->find()->where(['slug' => $slug, 'NOT' => ['id' => $this->_properties['id']]])->toArray();
        while (count($query)) {
            if (!preg_match('/-{1}[0-9]+$/', $slug)) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            }
            $query = $tbl->find()->where(['slug' => $slug, 'NOT' => ['id' => $this->_properties['id']]])->toArray();
        }
        $response = $tbl->updateAll(['slug' => $slug],['id' => $this->_properties['id']]);
        return $slug;
    }
}
