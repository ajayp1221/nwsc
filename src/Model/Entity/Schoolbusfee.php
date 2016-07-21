<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schoolbusfee Entity.
 *
 * @property int $id
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property string $session
 * @property int $fee
 * @property int $distance
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 */
class Schoolbusfee extends Entity
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
}
