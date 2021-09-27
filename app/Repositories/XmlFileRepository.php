<?php

namespace App\Repositories;

use App\Models\XmlFile;
use App\Repositories\Commons\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class XmlFileRepository extends AbstractEloquentRepository
{

    /**
     * Apply XML File by provided number
     *
     * @param string|null $number
     * @return $this
     */
    public function applyMeetingAgendaNumber(string $number = null): self
    {
        return $number ? $this->where('file_name_numeric', $number) : $this;
    }

    /**
     * Set model
     *
     * @return Model
     */
    protected function getModel(): Model
    {
        return resolve(XmlFile::class);
    }
}
