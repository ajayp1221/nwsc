<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Homeworkquestion Entity.
 *
 * @property int $id
 * @property int $homework_id
 * @property \App\Model\Entity\Homework $homework
 * @property string $question
 * @property int $created
 * @property int $modified
 */
class Homeworkquestion extends Entity
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
                $this->_properties['question']
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
