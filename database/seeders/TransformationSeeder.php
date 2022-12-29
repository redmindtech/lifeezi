<?php

namespace Database\Seeders;

use App\Models\TransformationPlan;
use Illuminate\Database\Seeder;

class TransformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->transformationName();
        foreach($data as $value) {
            TransformationPlan::create($value);
        }
        
    }

    public function transformationName() {
        return [
            ['name' => 'Weight Loss', 'span' => 'weight_loss'],
            ['name' => 'Diabetes Mgmt', 'span' => 'diabetes_mgmt'],
            ['name' => 'Thyroid', 'span' => 'thyroid'],
            ['name' => 'Cholesterol Mgmt', 'span' => 'cholesterol_mgmt'],
            ['name' => 'Hair Fall', 'span' => 'hair_fall'],
            ['name' => 'Stamina Building', 'span' => 'stamina_building'],
            ['name' => 'Uric Acid & Creatinine', 'span' => 'uric_acid_and_creatinine'],
            ['name' => 'PCOS', 'span' => 'PCOS'],
            ['name' => 'Irregular Periods', 'span' => 'irregular_periods'],
            ['name' => 'Vitamins & Minerals deficiency', 'span' => 'vitamins_and_minerals_deficiency'],
            ['name' => 'Others', 'span' => 'others'],
        ];
    }
}
