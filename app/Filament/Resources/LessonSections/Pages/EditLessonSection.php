<?php

namespace App\Filament\Resources\LessonSections\Pages;

use App\Filament\Resources\LessonSections\LessonSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLessonSection extends EditRecord
{
    protected static string $resource = LessonSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }

    /** Unpack the stored JSON data into virtual form fields */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return LessonSectionResource::unpackSectionData($data);
    }

    /** Repack virtual form fields back into the data JSON */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return LessonSectionResource::packSectionData($data);
    }
}
