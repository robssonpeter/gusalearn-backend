<?php

namespace App\Filament\Resources\LessonSections;

use App\Filament\Resources\LessonSections\Pages\CreateLessonSection;
use App\Filament\Resources\LessonSections\Pages\EditLessonSection;
use App\Filament\Resources\LessonSections\Pages\ListLessonSections;
use App\Filament\Resources\LessonSections\Schemas\LessonSectionForm;
use App\Filament\Resources\LessonSections\Tables\LessonSectionsTable;
use App\Models\LessonSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LessonSectionResource extends Resource
{
    protected static ?string $model = LessonSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|\UnitEnum|null $navigationGroup = 'Curriculum';

    protected static ?string $navigationLabel = 'Lesson Sections';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return LessonSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonSectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListLessonSections::route('/'),
            'create' => CreateLessonSection::route('/create'),
            'edit'   => EditLessonSection::route('/{record}/edit'),
        ];
    }

    // ── Data pack / unpack ────────────────────────────────────────────────

    public static function unpackSectionData(array $data): array
    {
        $d = $data['data'] ?? [];

        switch ($data['section_type'] ?? '') {
            case 'content':
                // Unpack visual sub-fields within each topic
                $topics = $d['topics'] ?? [];
                $data['topics'] = array_map(function (array $topic): array {
                    $visual = $topic['visual'] ?? [];
                    $topic['visual_type']       = $visual['type'] ?? '';
                    $topic['visual_keys']       = $visual['keys'] ?? [];
                    $topic['visual_labels']     = $visual['labels'] ?? [];
                    $topic['visual_caption_en'] = $visual['caption_en'] ?? '';
                    $topic['visual_caption_sw'] = $visual['caption_sw'] ?? '';
                    unset($topic['visual']);
                    return $topic;
                }, $topics);
                break;

            case 'quiz':
                $data['passing_pct'] = $d['passing_pct'] ?? 67;
                $data['questions']   = $d['questions'] ?? [];
                break;

            case 'practice':
                $data['exercises'] = $d['exercises'] ?? [];
                break;

            case 'music_activity':
                $data['act_title_en']        = $d['title_en'] ?? '';
                $data['act_title_sw']        = $d['title_sw'] ?? '';
                $data['act_instructions_en'] = $d['instructions_en'] ?? '';
                $data['act_instructions_sw'] = $d['instructions_sw'] ?? '';
                $data['act_target_note']     = $d['target_note'] ?? '';
                break;
        }

        return $data;
    }

    public static function packSectionData(array $data): array
    {
        switch ($data['section_type'] ?? '') {
            case 'content':
                $topics = $data['topics'] ?? [];
                $data['data'] = [
                    'topics' => array_map(function (array $topic): array {
                        $visualType = $topic['visual_type'] ?? '';
                        $visual = $visualType ? ['type' => $visualType] : null;

                        if ($visualType === 'highlight_keys') {
                            $visual['keys']       = $topic['visual_keys'] ?? [];
                            $visual['labels']     = $topic['visual_labels'] ?? [];
                            $visual['caption_en'] = $topic['visual_caption_en'] ?? '';
                            $visual['caption_sw'] = $topic['visual_caption_sw'] ?? '';
                        }

                        return [
                            'title_en' => $topic['title_en'] ?? '',
                            'title_sw' => $topic['title_sw'] ?? '',
                            'body_en'  => $topic['body_en'] ?? '',
                            'body_sw'  => $topic['body_sw'] ?? '',
                            'visual'   => $visual,
                        ];
                    }, $topics),
                ];
                break;

            case 'quiz':
                $data['data'] = [
                    'passing_pct' => (int) ($data['passing_pct'] ?? 67),
                    'questions'   => $data['questions'] ?? [],
                ];
                break;

            case 'practice':
                $data['data'] = ['exercises' => $data['exercises'] ?? []];
                unset($data['exercises']);
                break;

            case 'music_activity':
                $data['data'] = [
                    'title_en'        => $data['act_title_en'] ?? '',
                    'title_sw'        => $data['act_title_sw'] ?? '',
                    'instructions_en' => $data['act_instructions_en'] ?? '',
                    'instructions_sw' => $data['act_instructions_sw'] ?? '',
                    'target_note'     => $data['act_target_note'] ?? 'C',
                ];
                break;

            default:
                $data['data'] = [];
        }

        // Remove virtual fields — only save real model columns
        foreach (['topics', 'passing_pct', 'questions',
                  'act_title_en', 'act_title_sw',
                  'act_instructions_en', 'act_instructions_sw', 'act_target_note'] as $key) {
            unset($data[$key]);
        }

        return $data;
    }
}
