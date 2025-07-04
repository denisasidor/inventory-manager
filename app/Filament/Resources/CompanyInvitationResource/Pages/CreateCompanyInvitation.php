<?php

namespace App\Filament\Resources\CompanyInvitationResource\Pages;

use App\Filament\Resources\CompanyInvitationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use App\Mail\CompanyInvitationMail;
use Illuminate\Support\Facades\Mail;

class CreateCompanyInvitation extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['company_id'] = auth()->user()->company_id;
        $data['token'] = Str::random(40);
        $data['expires_at'] = now()->addDays(7);

        return $data;
    }

    protected function afterCreate(): void
    {
        Mail::to($this->record->email)->send(new CompanyInvitationMail($this->record));
    }
    protected static string $resource = CompanyInvitationResource::class;
}
