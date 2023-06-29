@php
    $product = 1;
@endphp
@if (count($products) > 0)
    @foreach ($products as $data)
        <tr>
            {{-- <td class="text-center"><strong>{{ $product++ }}</strong></td> --}}
            <td class="text-center">{{ Str::title($data->name) }}</td>
            <td class="text-center">{{ Str::title($data->product_type) }}</td>
            <td class="text-center">{{ ($data->price) }}</td>
            <td class="text-center">
                @if ($data->status == 1)
                    <label class="badge badge-gradient-success">Active</label>
                @else
                    <label class="badge badge-gradient-danger">De-Active</label>
                @endif
            </td>
            <td class="text-center">{{ $data->date }}</td>
            <td class="text-center">
                <a href="{{ route('edit_product', $data->code) }}"
                    class="btn btn-sm btn-outline-success btn-icon-text">Edit</a>
                <button type="button" class="btn btn-sm btn-outline-danger btn-icon-text product_delete"
                    data-id="{{ $data->code }}">Delete</button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center">
            <h3>Data Not Avaliable</h3>
        </td>
    </tr>
@endif
