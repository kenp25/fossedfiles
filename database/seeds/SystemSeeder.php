<?php

use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $systems = array(
            array(
                'name' => 'ECW',
                'primary_owner' => 'Abdul',
                'secondary_support' => 'JM/Ebenezer'

            ),

            array(
                'name' => 'SDP',
                'primary_owner' => 'Issa'

            ),

            array(
                'name' => 'CBS',
                'primary_owner' => 'David',
                'secondary_support' => 'Naivedya'

            ),

            array(
                'name' => 'Concierge',
                'primary_owner' => 'David',
                'secondary_support' => 'Naivedya'

            ),

            array(
                'name' => 'Smartapp',
                'primary_owner' => 'David',
                'secondary_support' => 'Naivedya'

            ),

            array(
                'name' => 'FLYTXT',
                'primary_owner' => 'Gaurav_T'

            ),

            array(
                'name' => 'LCMS',
                'primary_owner' => 'Gaurav_T'

            ),

            array(
                'name' => 'BIB',
                'primary_owner' => 'Henry'

            ),

            array(
                'name' => 'SUBEX',
                'primary_owner' => 'Henry'

            ),

            array(
                'name' => 'ICB',
                'primary_owner' => 'JM'

            ),

            array(
                'name' => 'Roaming',
                'primary_owner' => 'JM'

            ),

            array(
                'name' => 'MACH',
                'primary_owner' => 'JM'

            ),

            array(
                'name' => 'NRTDE',
                'primary_owner' => 'JM'

            ),

            array(
                'name' => 'IFS',
                'primary_owner' => 'Henry'

            ),

            array(
                'name' => 'SAGE',
                'primary_owner' => 'Henry'

            ),
            array(
                'name' => 'DMS',
                'primary_owner' => 'David'

            ),

            array(
                'name' => 'SharePoint',
                'primary_owner' => 'David'

            ),

            array(
                'name' => 'MPOS/ISL',
                'primary_owner' => 'Gaurav_T'

            ),

            array(
                'name' => 'Aspect',
                'primary_owner' => 'David',
                'secondary_support' => 'JM'


            ),

            array(
                'name' => 'EMA',
                'primary_owner' => 'Mirza/Guarva_S'

            ),

            array(
                'name' => 'EMM',
                'primary_owner' => 'Mirza/Guarva_S'

            ),

            array(
                'name' => 'Tertial',
                'primary_owner' => 'Mirza/Guarva_S'

            ),

            array(
                'name' => 'OCS',
                'primary_owner' => 'Mirza/Guarva_S'

            ),

            array(
                'name' => 'DMS',
                'primary_owner' => 'David',
                'secondary_support' => 'Issa'

            ),

            array(
                'name' => 'SharePoint',
                'primary_owner' => 'David',
                'secondary_support' => 'Issa'

            ),
            array(
                'name' => 'ESF',
                'primary_owner' => 'Issa'

            ),

            array(
                'name' => 'EVD',
                'primary_owner' => 'Henry',
                'secondary_support' => 'Jacob'

            ),

            array(
                'name' => 'PPMS',
                'primary_owner' => 'Henry',
                'secondary_support' => 'Jacob'

            ),

            array(
                'name' => 'VMS',
                'primary_owner' => 'Henry',
                'secondary_support' => 'Jacob'

            ),

            array(
                'name' => 'Remedy',
                'primary_owner' => 'Naivedya'

            ),

            array(
                'name' => 'Qmatic',
                'primary_owner' => 'Gaurav_T'

            ),



        );

        foreach($systems as $system){
            \App\System::create($system);
        }
    }
}

