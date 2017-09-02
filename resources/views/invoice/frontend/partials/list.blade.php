<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Invoices</div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>amount</th>
                    <th>due_date</th>
                    <th>remarks</th>
                    <th>files</th>
                    <th>created</th>
                    <th>modified</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($invoices as $invoice)
                    @can('view', $invoice)
                        <td>{{ $invoice->id }}</td>
                        <td><a href="{{ route($invoiceRoute, $invoice) }}">{{ $invoice->title }}</a></td>
                        <td>{{ $invoice->amount }}</td>
                        <td>{{ $invoice->due_date }}</td>
                        <td>{{ $invoice->remarks }}</td>
                        <td>
                            @if($invoice->hasMedia('invoices'))
                                @foreach($invoice->getMedia('invoices') as $file)
                                    <a href="{{ route($fileRoute, ['invoice' => $invoice,'id' => $file->id]) }}" target="_blank">{{ $file->file_name }}</a><br/>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $invoice->created_at }}</td>
                        <td>{{ $invoice->modified_at }}</td>
                    @endcan
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>