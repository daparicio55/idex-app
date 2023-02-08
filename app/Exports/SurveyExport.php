<?php

namespace App\Exports;

use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SurveyExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $survey = Survey::findOrFail($this->id);
        return view('exports.survey',compact('survey'));
    }
}
