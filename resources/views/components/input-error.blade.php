@props(['for'])

@error($for)
     <div class="alert alert-danger">{{ $message }}</div>
@enderror
