<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Classroom Entity.
 *
 * @property int $id
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property string $name
 * @property string $section
 * @property string $slug
 * @property int $status
 * @property int $deleted
 * @property string $created
 * @property string $modified
 * @property \App\Model\Entity\Result[] $results
 * @property \App\Model\Entity\Schoolfee[] $schoolfees
 * @property \App\Model\Entity\Studentfee[] $studentfees
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\StudentsSchoolfee[] $students_schoolfees
 * @property \App\Model\Entity\Timetable[] $timetables
 * @property \App\Model\Entity\Teacher[] $teachers
 */
class Classroom extends Entity
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
    
    protected $_virtual = ['class_name'];

    protected function _getClassName() {
        return $this->_properties['name'] . ' - ' . $this->_properties['section'];
    }
    
    protected function _getSlug($slug) {
        $slug = strtolower(\Cake\Utility\Inflector::slug($this->_properties['name']."-".$this->_properties['section']));
        $tbl = \Cake\ORM\TableRegistry::get('Classrooms');
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
}
