<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Studentattendance Entity.
 *
 * @property int $id
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property int $student_id
 * @property \App\Model\Entity\Student $student
 * @property int $teacher_id
 * @property \App\Model\Entity\Teacher $teacher
 * @property string $attendance
 * @property string $session
 * @property int $status
 * @property int $deleted
 * @property string $date
 * @property int $created
 * @property int $modified
 */
class Studentattendance extends Entity
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
