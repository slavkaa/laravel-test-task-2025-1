<form id="registration-form" class="centered-form" method="POST" action="{{ route('registration.create_hash') }}">
    @csrf

    <label>Username:</label>
    <input type="text" name="username" value="{{ old('username') }}">
    <div id="username-error" class="form-error"></div>

    <label>Phonenumber :</label>
    <input type="text" name="phonenumber" value="{{ old('phonenumber') }}">
    <div id="phonenumber-error"  class="form-error"></div>

    <button type="submit" value="create_hash">Register</button>
</form>

<a id="registration-link" class="hidden"></a>

@push('scripts')
    <script src="{{ asset('js/registration/functions.js') }}"></script>
    <script src="{{ asset('js/registration/get-registration-link.js') }}"></script>
@endpush
