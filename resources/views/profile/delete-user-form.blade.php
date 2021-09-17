<x-jet-action-section>
    <x-slot name="title">
        {{ __('Supprimer votre compte !') }}
    </x-slot>

    <x-slot name="description">
        {{ __("Supprimer votre compte d'une manière permanente.") }}
    </x-slot>

    <x-slot name="content">
        @if (Auth::user()->type == "doctor" || Auth::user()->type == "hospital")
            <div class="max-w-xl text-sm text-gray-600">
                {{ __("Même si votre compte est supprimé, nous conserverons tous les domments que vous avez redigé pour vos patients !") }}
                Les rendes-vous et les documents médicaux seront conservés
            </div>
        @endif
  
        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Supprimer mon compte') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Confirmer la suppression du compte en saisissant votre mot de passe. Attention le compte sera définitivement supprimé') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Annuler') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Confirmer') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
