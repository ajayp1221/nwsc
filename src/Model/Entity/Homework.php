<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Homework Entity.
 *
 * @property int $id
 * @property int $school_id
 * @property \App\Model\Entity\School $school
 * @property int $subject_id
 * @property \App\Model\Entity\Subject $subject
 * @property int $classroom_id
 * @property \App\Model\Entity\Classroom $classroom
 * @property int $teacher_id
 * @property \App\Model\Entity\Teacher $teacher
 * @property string $session
 * @property string $title
 * @property string $description
 * @property string $file
 * @property int $created
 * @property int $modified
 * @property int $status
 * @property int $deleted
 */
class Homework extends Entity
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
        $slug = strtolower(\Cake\Utility\Inflector::slug(
                $this->_properties['title']."-".$this->_properties['classroom']['name']."-".$this->_properties['classroom']['section']
                ."-".$this->_properties['subject']['name']
                ));
        $tbl = \Cake\ORM\TableRegistry::get('Homeworks');
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
