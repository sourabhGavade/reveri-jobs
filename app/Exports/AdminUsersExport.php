<?php

namespace App\Exports;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminUsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @var Builder
     */
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Date',
            'Job Position',
            'Industry',
            'CV Status',
        ];
    }

    /**
     * @param User $user
     */
    public function map($user): array
    {
        $nameParts = [$user->first_name, $user->middle_name, $user->last_name];
        $fullName = trim(implode(' ', array_filter($nameParts)));

        return [
            $user->id,
            $fullName,
            $user->email,
            optional($user->created_at)->format('Y-m-d'),
            $user->getCareerLevel('career_level'),
            $user->getIndustry('industry'),
            ((int) $user->profile_cvs_count > 0) ? 'Uploaded' : 'Not Uploaded',
        ];
    }
}
