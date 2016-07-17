<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Studentfee Entity.
 *
 * @property int $id
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property int $student_id
 * @property \App\Model\Entity\Student $student
 * @property int $schoolfee_id
 * @property \App\Model\Entity\Schoolfee $schoolfee
 * @property int $classroom_id
 * @property \App\Model\Entity\Classroom $classroom
 * @property int $fee
 * @property int $discount
 * @property string $date
 * @property string $session
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 */
class Studentfee extends Entity
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
    protected function _setCreated(){
        return time();
    }
    protected function _setModified(){
        return time();
    }
}
