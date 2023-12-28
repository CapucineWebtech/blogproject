<form method="POST" action="">
    @csrf
    @method($user->id?'PUT':'POST')
    <div class="mb-3">
        <label for="name" class="form-label">Votre pseudo</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ isset($user) ? old('name', $user['name']) : '' }}">
        @error('name')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ isset($user) ? old('email', $user['email']) : '' }}">
        @error('email')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"/>
        @error('password')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"/>
    </div>
    <button type="submit" class="btn btn-primary blog-btn blog-btn-right">Enregistrer</button>
</form>
