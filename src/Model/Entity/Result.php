<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity.
 *
 * @property int $id
 * @property int $resultcategory_id
 * @property \App\Model\Entity\Resultcategory $resultcategory
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property int $classroom_id
 * @property \App\Model\Entity\Classroom $classroom
 * @property int $student_id
 * @property \App\Model\Entity\Student $student
 * @property int $subject_id
 * @property \App\Model\Entity\Subject $subject
 * @property int $get_marks
 * @property int $total_mark
 * @property string $session
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 */
class Result extends Entity
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
    protected function _setCreated($created){
        return $created->timestamp;
    }
    protected function _setModified($modified){
        return $modified->timestamp;
    }
}
