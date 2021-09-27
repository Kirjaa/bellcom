<?php

namespace Database\Seeders;

use App\Models\XmlFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class XmlSeeder extends Seeder
{

    const XML_DIRECTORY_PATH = 'xml';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->collectXmlFilesFromStorage();
    }

    /**
     * Collect XML Files from local storage and seed Database with them.
     * @return void
     */
    private function collectXmlFilesFromStorage(): void
    {
        $files = Storage::disk('public')->allFiles(self::XML_DIRECTORY_PATH);
        DB::table('xml_files')->delete();
        foreach($files as $file) {
            preg_match_all('!\d+!', basename($file), $matches);

            XmlFile::create(array(
                'file_name_full' => basename($file),
                'file_name_numeric' => (int) filter_var(basename($file), FILTER_SANITIZE_NUMBER_INT),
                'file_path' => Storage::url('app/public/'.$file),
            ));
        }
    }
}
