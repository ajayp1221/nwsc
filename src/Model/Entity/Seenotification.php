<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Seenotification Entity.
 *
 * @property int $id
 * @property int $notification_id
 * @property \App\Model\Entity\Notification $notification
 * @property int $guardians_id
 * @property \App\Model\Entity\Guardian $guardian
 * @property int $student_id
 * @property \App\Model\Entity\Student $student
 * @property int $teacher_id
 * @property \App\Model\Entity\Teacher $teacher
 * @property int $is_seen
 * @property string $is_seen_date
 * @property int $created
 * @property int $modified
 */
class Seenotification extends Entity
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
