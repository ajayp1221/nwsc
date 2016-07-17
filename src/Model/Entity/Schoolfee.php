<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schoolfee Entity.
 *
 * @property int $id
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property int $classroom_id
 * @property \App\Model\Entity\Classroom $classroom
 * @property string $month
 * @property int $fee
 * @property string $session
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\Schoolfeeothercharge[] $schoolfeeothercharges
 * @property \App\Model\Entity\Studentfee[] $studentfees
 */
class Schoolfee extends Entity
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
        return time();
    }
    protected function _setModified($modified){
        return time();
    } 
}
