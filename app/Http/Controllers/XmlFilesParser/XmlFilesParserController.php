<?php

namespace App\Http\Controllers\XmlFilesParser;

use App\Models\XmlFile;
use App\Repositories\XmlFileRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Mtownsend\XmlToArray\XmlToArray;
use Orchestra\Parser\Xml\Facade as XmlParser;


class XmlFilesParserController extends Controller
{

    private XmlFileRepository $xmlFileRepository;

    /**
     * XmlFilesParser Constructor
     *
     * @param XmlFileRepository $xmlFileRepository
     */
    public function __construct(XmlFileRepository $xmlFileRepository)
    {
        $this->xmlFileRepository = $xmlFileRepository;
    }

    /**
     * Set page view
     */
    public function showPage()
    {
        return view('xml');
    }

    /**
     * Search file in database and print it if found
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response|void
     */
    public function searchForXmlFile(Request $request){
        if($request->ajax()) {
            $xmlFile = $this->xmlFileRepository
                ->applyMeetingAgendaNumber($request->search)
                ->firstOrNull();

            if($xmlFile) {
                $xmlFileParse = XMLParser::load(base_path().$xmlFile->file_path);

                $xmlDataAll = $xmlFileParse->getContent();
                $xmlFile = [];

                foreach($xmlDataAll as $xmlDataSingle) {

                    if($xmlDataSingle['name'] == 'meeting') {
                        $xmlFile['type_name'] = (string) $xmlDataSingle['name'] ?? null;
                        foreach($xmlDataSingle->fields as $fields) {
                            $xmlFile['name'] = (string) $fields->field[0]['name'] ?? null;
                            $xmlFile['sysid'] = (string) $fields->field[1]['sysid'] ?? null;
                            $xmlFile['date'] = (string) $fields->field[2]['date'] ?? null;
                        }
                    }
                }

                return view('xml-response', compact('xmlFile'));

            } else {
                return view('xml-error', compact('xmlFile'));
            }
        }
    }

}
