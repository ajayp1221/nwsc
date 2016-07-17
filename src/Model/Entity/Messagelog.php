<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Messagelog Entity.
 *
 * @property int $id
 * @property string $model_name
 * @property int $modelid
 * @property string $message
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\Messagesmslog[] $messagesmslogs
 */
class Messagelog extends Entity
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
