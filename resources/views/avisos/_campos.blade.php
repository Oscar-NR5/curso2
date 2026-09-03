<div class="field">
    <label class="field-label" for="titulo">Título</label>
    <input id="titulo" name="titulo" value="{{ old('titulo', $post->titulo ?? '') }}" class="field-input" @error('titulo') aria-invalid="true" @enderror>
    @error('titulo') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label class="field-label" for="categoria_id">Categoría</label>
    <select id="categoria_id" name="categoria_id" class="field-input" @error('categoria_id') aria-invalid="true" @enderror>
        <option value="">Elige una categoría...</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" @selected(old('categoria_id', $post->categoria_id ?? '') == $categoria->id)>{{ $categoria->nombre }}</option>
        @endforeach
    </select>
    @error('categoria_id') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label class="field-label" for="contenido">Contenido</label>
    <textarea id="contenido" name="contenido" rows="4" class="field-input" @error('contenido') aria-invalid="true" @enderror>{{ old('contenido', $post->contenido ?? '') }}</textarea>
    @error('contenido') <p class="field-error">{{ $message }}</p> @enderror
</div>

<button class="button form-submit">{{ $submitLabel }}</button>