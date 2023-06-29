@php
    $invoice = 1;
@endphp
@if (count($invoices) > 0)
    @foreach ($invoices as $data)
        <tr>
            {{-- <td class="text-center"><strong>{{ $product++ }}</strong></td> --}}
            <td class="text-center">{{ Str::title($data->name) }}</td>
            <td class="text-center">{{ Str::title($data->sub_total) }}</td>
            <td class="text-center">{{ Str::title($data->sub_discount) }}</td>
            <td class="text-center">{{ Str::title($data->grand_total) }}</td>
            <td class="text-center">
                @if ($data->status == 1)
                    <label class="badge badge-gradient-success">Active</label>
                @else
                    <label class="badge badge-gradient-danger">De-Active</label>
                @endif
            </td>
            <td class="text-center">{{ $data->date }}</td>
            <td class="text-center">
                <a href="{{ route('print_invoice', $data->invoice_id) }}"
                    class="btn btn-sm btn-outline-success btn-icon-text">View</a>
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
