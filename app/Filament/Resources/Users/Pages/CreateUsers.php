<?php

namespace App\Filament\Resources\Users\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Users\UsersResource;

class CreateUsers extends CreateRecord
{
    protected static string $resource = UsersResource::class;
}
