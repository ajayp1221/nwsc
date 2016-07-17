<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

use Cake\Auth\DefaultPasswordHasher;
/**
 * Teacher Entity.
 *
 * @property int $id
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property int $area_id
 * @property \App\Model\Entity\Area $area
 * @property int $state_id
 * @property \App\Model\Entity\State $state
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property string $address
 * @property int $pincode
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $mobile
 * @property string $image
 * @property string $dob
 * @property string $salary
 * @property string $slug
 * @property string $lat
 * @property string $long
 * @property string $device_token
 * @property string $deviceid
 * @property int $status
 * @property int $deleted
 * @property string $created
 * @property string $modified
 * @property \App\Model\Entity\Studentattendance[] $studentattendances
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\Teacherattendance[] $teacherattendances
 * @property \App\Model\Entity\Teachersalary[] $teachersalaries
 * @property \App\Model\Entity\Timetable[] $timetables
 * @property \App\Model\Entity\Classroom[] $classrooms
 */
class Teacher extends Entity
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
    
    protected $_virtual = [
        'android_api_img_large','android_api_img_medium'
    ];
    /**
     * Slug
     */
    
    protected function _getSlug($slug) {
        
        $slug = strtolower(\Cake\Utility\Inflector::slug($this->_properties['first_name'] . "-" . $this->_properties['last_name']));
        $tbl = \Cake\ORM\TableRegistry::get('Teachers');
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
    
    protected function _setPassword($password){
        return (new \Cake\Auth\DefaultPasswordHasher)->hash($password);
    }
    protected function _setCreated($created){
        return $created->timestamp;
    }
    protected function _setModified($modified){
        return $modified->timestamp;
    }
    protected function _getAndroidApiImgLarge(){
        $path = Router::url('/', true);
        if($this->_properties['image']){
            return $path.DS."upload".DS."teachers".DS."720-".$this->_properties['image'];
        }else{
            return $path."img".DS."user.jpg";
        }
    }
    protected function _getAndroidApiImgMedium(){
        $path = Router::url('/', true);
        if($this->_properties['image']){
            return $path.DS."upload".DS."teachers".DS."80-".$this->_properties['image'];
        }else{
            return $path."img".DS."user.jpg";
        }
    }
    protected function _getFullName() {
        return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
    }
}
