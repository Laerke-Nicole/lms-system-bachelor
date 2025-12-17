<div>
{{--    filtering btns with active and inactive state --}}
    @include('components/elements/trainings-filter')

    <x-blocks.trainings-table-head :filter="$filter">
{{--        body of the table --}}
        @include('components/blocks/trainings-table-body')
    </x-blocks.trainings-table-head>

    <x-elements.pagination :items="$this->trainings"/>
</div>
