<form method="POST" action="">
    @csrf
    @method($category->id?'PUT':'POST')
    <div class="mb-3">
        <label for="name" class="form-label">Nom de la catégorie :</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ isset($category) ? old('name', $category['name']) : '' }}">
        @error('name')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary blog-btn blog-btn-right">Enregistrer</button>
</form>
