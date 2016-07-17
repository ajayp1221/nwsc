<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;

/**
 * User Entity.
 *
 * @property int $id
 * @property int $ownerid
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $mobile
 * @property string $image
 * @property string $slug
 * @property string $role
 * @property string $address
 * @property int $area_id
 * @property \App\Model\Entity\Area $area
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property int $state_id
 * @property \App\Model\Entity\State $state
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $pincode
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\School[] $schools
 */
class User extends Entity
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
    
    protected $_virtual = [
        'api_img_large','api_img_medium'
    ];
    protected function _getApiImgLarge(){
        $path = Router::url('/', true);
        return $path.DS."upload".DS."users".DS."720-".$this->_properties['image'];
    }
    protected function _getApiImgMedium(){
        $path = Router::url('/', true);
        return $path.DS."upload".DS."users".DS."80-".$this->_properties['image'];
    }
    /**
     * HashPassword
     */
    
    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }
    
    /**
     * Slug
     */
    
    protected function _getSlug($slug) {
        $slug = strtolower(\Cake\Utility\Inflector::slug($this->_properties['first_name'] . "-" . $this->_properties['last_name']));
        $tbl = \Cake\ORM\TableRegistry::get('Users');
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
    protected function _setCreated($created){
        return $created->timestamp;
    }
    protected function _setModified($modified){
        return $modified->timestamp;
    } 
}
