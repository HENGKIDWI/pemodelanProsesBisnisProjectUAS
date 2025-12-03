<?php

namespace App\Filament\Resources\TanggunganResource\Pages;

use App\Filament\Resources\TanggunganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTanggungan extends EditRecord
{
    protected static string $resource = TanggunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
