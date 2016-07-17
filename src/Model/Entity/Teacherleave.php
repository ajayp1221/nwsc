<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Teacherleave Entity.
 *
 * @property int $id
 * @property int $teacher_id
 * @property \App\Model\Entity\Teacher $teacher
 * @property string $session
 * @property string $title
 * @property string $reason
 * @property string $from
 * @property string $to
 * @property int $is_approved
 * @property int $created
 * @property int $modified
 * @property int $deleted
 */
class Teacherleave extends Entity
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
