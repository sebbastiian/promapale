<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Nombre de la Tienda -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nombretienda" value="{{ __('Nombre de la Tienda') }}" />
            <x-input id="nombretienda" type="text" class="mt-1 block w-full" wire:model="state.nombretienda" autocomplete="nombretienda" />
            <x-input-error for="nombretienda" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
        <!-- Apellido -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apellido" value="{{ __('Apellido') }}" />
            <x-input id="apellido" type="text" class="mt-1 block w-full" wire:model="state.apellido" required />
            <x-input-error for="apellido" class="mt-2" />
        </div>

        <!-- Telefono -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="telefono" value="{{ __('Telefono') }}" />
            <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model="state.telefono" required />
            <x-input-error for="telefono" class="mt-2" />
        </div>

        <!-- Direccion -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="direccion" value="{{ __('Direccion') }}" />
            <x-input id="direccion" type="text" class="mt-1 block w-full" wire:model="state.direccion" required />
            <x-input-error for="direccion" class="mt-2" />
        </div>

        <!-- Documento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="documento" value="{{ __('Documento') }}" />
            <x-input id="documento" type="text" class="mt-1 block w-full" wire:model="state.documento" required />
            <x-input-error for="documento" class="mt-2" />
        </div>

        <!-- Tipo Documento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="tipodocumento" value="{{ __('Tipo de Documento') }}" />
            <x-input id="tipodocumento" type="text" class="mt-1 block w-full" wire:model="state.tipodocumento" required />
            <x-input-error for="tipodocumento" class="mt-2" />
        </div>

        <!-- Sueldo -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="sueldo" value="{{ __('Sueldo') }}" />
            <x-input id="sueldo" type="hidden" class="mt-1 block w-full" wire:model="state.sueldo" required />
            <x-input-error for="sueldo" class="mt-2" />
        </div>

        {{-- <!-- Estado -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="estado" value="{{ __('Estado') }}" />
            <x-input id="estado" type="text" class="mt-1 block w-full" wire:model="state.estado"  />
            <x-input-error for="estado" class="mt-2" />
        </div> --}}

        <!-- Roles ID -->
        <div class="col-span-6 sm:col-span-4">
            {{-- <x-label for="roles_id" value="{{ __('Roles ID') }}" /> --}}
            <x-input id="roles_id" type="hidden" class="mt-1 block w-full" wire:model="state.roles_id" required />
            <x-input-error for="roles_id" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
