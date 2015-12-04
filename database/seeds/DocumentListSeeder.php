<?php

use Illuminate\Database\Seeder;

class DocumentListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $document_list = array(
            array(
                'name' => 'Deployment Architecture'
            ),

            array(
                'name' => 'Technical Architecture'

            ),

            array(
                'name' => 'Service Catalogue'

            ),

            array(
                'name' => 'Integration Arhitecture'

            ),

            array(
                'name' => 'Capability Plan'

            )
        );

        foreach($document_list as $document){
            \App\DocumentList::create($document);
        }
    }

}
