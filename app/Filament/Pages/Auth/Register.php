<?php

namespace App\Filament\Pages\Auth;

use App\Models\Company;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;
use Spatie\Permission\Models\Role;

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getCompanyFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    private function getCompanyFormComponent()
    {
        return TextInput::make('company_name')
            ->label(__('Company Name'))
            ->required()
            ->maxLength(255)
            ->autofocus();

    }

    protected function handleRegistration(array $data): \Illuminate\Database\Eloquent\Model
    {
        $companyId = Company::create(['name'=>$data['company_name']])->id;
        $user = parent::handleRegistration([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'company_id' => $companyId,
        ]);
        $adminRole = Role::findOrCreate('admin');
        $user->assignRole($adminRole);
        return $user;
    }

}
