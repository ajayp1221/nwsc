<?php
namespace App\Model\Entity;

use Cake\Routing\Router;
use Cake\ORM\Entity;

/**
 * School Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $name
 * @property string $current_session
 * @property string $description
 * @property string $image
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
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $lat
 * @property string $long
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\Classroom[] $classrooms
 * @property \App\Model\Entity\Holiday[] $holidays
 * @property \App\Model\Entity\Resultcategory[] $resultcategories
 * @property \App\Model\Entity\Result[] $results
 * @property \App\Model\Entity\Schoolfee[] $schoolfees
 * @property \App\Model\Entity\Studentattendance[] $studentattendances
 * @property \App\Model\Entity\Studentfee[] $studentfees
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\StudentsSchoolfee[] $students_schoolfees
 * @property \App\Model\Entity\Teacherattendance[] $teacherattendances
 * @property \App\Model\Entity\Teacher[] $teachers
 * @property \App\Model\Entity\Teachersalary[] $teachersalaries
 * @property \App\Model\Entity\Timetable[] $timetables
 * @property \App\Model\Entity\Subject[] $subjects
 */
class School extends Entity
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
     * Slug
     */
    
    protected function _getSlug($slug) {
        $slug = strtolower(\Cake\Utility\Inflector::slug(
                $this->_properties['state']['name']."-".$this->_properties['city']['name']."-".$this->_properties['name']
                ));
        $tbl = \Cake\ORM\TableRegistry::get('Schools');
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
    protected function _setCreated($created){
        return $created->timestamp;
    }
    protected function _setModified($modified){
        return $modified->timestamp;
    }
    protected $_virtual = [
        'api_img_large','api_img_medium'
    ];
    protected function _getApiImgLarge(){
        $path = Router::url('/', true);
        return $path.DS."upload".DS."schools".DS."720-".$this->_properties['image'];
    }
    protected function _getApiImgMedium(){
        $path = Router::url('/', true);
        return $path.DS."upload".DS."schools".DS."80-".$this->_properties['image'];
    }
}
