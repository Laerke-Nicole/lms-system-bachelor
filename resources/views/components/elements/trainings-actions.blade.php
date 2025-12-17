<x-blocks.table-actions :showRoute="route('trainings.show', $training->id)"
                        :editRoute="!in_array($training->status, ['Completed', 'Expiring']) ? route('trainings.edit', $training->id) : null"
                        :deleteRoute="auth()->user()->role === 'admin' && !in_array($training->status, ['Completed', 'Expiring']) ? route('trainings.destroy', $training->id) : null">

    {{--                        the button to participate in training --}}
    <x-blocks.training-participation-link :training="$training" />

    {{--                        show course material --}}
    <x-blocks.training-course-materials-link :training="$training" />

    {{--                         show test --}}
    <x-blocks.training-test-link :training="$training" />

    {{--                         show evaluation --}}
    <x-blocks.training-evaluation-link :training="$training" />

    {{--                         show signature page if the user completed evalution and didnt sign yet --}}
    <x-blocks.training-signature-link :training="$training" />

</x-blocks.table-actions>
