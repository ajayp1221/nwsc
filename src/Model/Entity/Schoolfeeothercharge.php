<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schoolfeeothercharge Entity.
 *
 * @property int $id
 * @property int $schoolfee_id
 * @property \App\Model\Entity\Schoolfee $schoolfee
 * @property int $extra_charges
 * @property string $description
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 */
class Schoolfeeothercharge extends Entity
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
