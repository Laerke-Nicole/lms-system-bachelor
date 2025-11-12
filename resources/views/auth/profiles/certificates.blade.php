@extends('layouts.profile')

@section('profile-content')


    <h3>Certificates</h3>

{{--    @foreach ($certificates as $certificate)--}}
{{--        <tr>--}}
{{--            <td>{{ $certificate->training->course->title }}</td>--}}

{{--            <td>--}}
{{--                <x-blocks.table-actions :showRoute="route('companies.show', $certificate->id)"--}}
{{--                                        :editRoute="route('companies.edit', $certificate->id)"--}}
{{--                                        :deleteRoute="route('companies.destroy', $certificate->id)"/>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}


@endsection
