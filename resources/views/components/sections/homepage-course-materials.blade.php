<h4 class="mb-3">Training materials</h4>
@foreach($courses as $material)
    <a href="{{ route('sections.course-materials', $material->id) }}">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <img src="{{ uploads_url($material->image) ?? 'images/placeholder.png' }}"
                     alt="{{ $material->title }}"
                     class="h-100 w-100 object-fit-cover">
            </div>

            <div class="col-lg-8">
                <p>{{ $material->title }}</p>
            </div>
        </div>
    </a>
    <hr>
@endforeach
