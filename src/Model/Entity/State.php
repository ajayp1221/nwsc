<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * State Entity.
 *
 * @property int $id
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property string $name
 * @property string $image
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $banner_image
 * @property string $slug
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\City[] $cities
 * @property \App\Model\Entity\School[] $schools
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\Teacher[] $teachers
 * @property \App\Model\Entity\User[] $users
 */
class State extends Entity
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
    
    protected function _getSlug($slug) {
        $slug = strtolower(\Cake\Utility\Inflector::slug($this->_properties['name']));
        $tbl = \Cake\ORM\TableRegistry::get('States');
        $i = 0;
        $query = $tbl->find()->where(['slug' => $slug, 'NOT' => ['id' => $this->_properties['id']]])->toArray();
        while (count($query)) {
            if (!preg_match('/-{1}[0-9]+$/', $slug)) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            }
            $query = $tbl->find()->where(['slug' => $slug, 'NOT' => ['id' => $this->_properties['id']]])->toArray();
        }
        $response = $tbl->updateAll(['slug' => $slug],['id' => $this->_properties['id']]);
        return $slug;
    }
}
