<?php

namespace App\Filament\Resources\LessonSections\Pages;

use App\Filament\Resources\LessonSections\LessonSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLessonSection extends CreateRecord
{
    protected static string $resource = LessonSectionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return LessonSectionResource::packSectionData($data);
    }
}
