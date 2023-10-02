<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-form.label id="name">Role Name</x-form.label>
                            <x-form.input name="name" :value="$role->name" placeholder="Name" />
                        </div>

                        <fieldset>
                            <legend>{{ __('Permissions') }}</legend>
                            @foreach (app('permissions') as $permission_code => $permission_name)
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ $permission_name }}
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="permissions[{{ $permission_code }}]" value="allow"
                                            @checked(($role_permissions[$permission_code] ?? '' ) == 'allow')>
                                        Allow
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="permissions[{{ $permission_code }}]" value="deny"
                                        @checked(($role_permissions[$permission_code] ?? '' ) == 'deny')>
                                        Deny
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="permissions[{{ $permission_code }}]"
                                            value="inherit" @checked(($role_permissions[$permission_code] ?? '' ) == 'inherit')>
                                        Inherit
                                    </div>
                                </div>
                            @endforeach
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pb-5 pt-3">
    <button class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
    <a href="{{ route('roles.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
</div>
