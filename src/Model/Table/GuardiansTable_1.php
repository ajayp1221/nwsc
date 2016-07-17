<?php
namespace App\Model\Table;

use App\Model\Entity\Guardian;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Guardians Model
 *
 * @property \Cake\ORM\Association\HasMany $Seenotifications
 * @property \Cake\ORM\Association\HasMany $Guardiandeviceids
 * @property \Cake\ORM\Association\BelongsToMany $Students
 */
class GuardiansTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('guardians');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Seenotifications', [
            'foreignKey' => 'guardian_id',
            'dependent' => TRUE
        ]);
        $this->hasMany('Guardiandeviceids', [
            'foreignKey' => 'guardian_id',
            'dependent' => TRUE
        ]);
        $this->belongsToMany('Students', [
            'foreignKey' => 'guardian_id',
            'targetForeignKey' => 'student_id',
            'joinTable' => 'guardians_students'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');


        return $validator;
    }

}
