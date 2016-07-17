<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Guardian Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $app_pwd
 * @property string $email
 * @property string $mobile
 * @property string $slug
 * @property int $is_app
 * @property int $status
 * @property string $device_token
 * @property string $deviceid
 * @property int $deleted
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\Student[] $students
 */
class Guardian extends Entity
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
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }
    protected function _setCreated($created){
        return $created->timestamp;
    }
    protected function _setModified($modified){
        return $modified->timestamp;
    }
}
