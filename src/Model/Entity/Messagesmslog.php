<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Messagesmslog Entity.
 *
 * @property int $id
 * @property string $model_name
 * @property int $modelid
 * @property int $messagelog_id
 * @property \App\Model\Entity\Messagelog $messagelog
 * @property string $mobile_number
 * @property string $api_response
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\Guardian $guardian
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Teacher $teacher
 */
class Messagesmslog extends Entity
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
