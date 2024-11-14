<?php

namespace App\Exports;

use App\Models\Package;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PackagesExport implements FromCollection, WithHeadings
{

    protected $packages;

    public function __construct(Collection $packages)
    {
        $this->packages = $packages;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->packages;
    }
    public function headings(): array
    {
        return [
            'ID',
            'Tracking Code',
            'Store Name',
            'Package Name',
            'Package Status',
            'Client Full Name',
            'Client Phone',
            'Client Phone 2',
            'Wilaya',
            'Commune',
            'Delivery Type',
        ];
    }
}
