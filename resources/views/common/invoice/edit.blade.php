<button onclick="addInvoice(); return false" class="btn btn-green">Add invoice</button>
<div id="invoices">
    @foreach ($invoices as $index=>$invoice)
        @include('common.invoice.form')
    @endforeach
</div>


@section('javascript-bottom')
    <script type="text/javascript">
        var numInvoices = {{ $invoices->count() }};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addInvoice() {
            var url = '{{ route($prefix.".invoice.ajax.add") }}';

            jQuery.ajax({
                url: url,
                data: {num_invoices: numInvoices},
                method: 'POST',
                success: function (data, textstatus, jqHdr) {
                    $('#invoices').append(data);
                    numInvoices++;
                }
            });
        }

        function delInvoice(index) {
            var url = '{{ route($prefix.".invoice.ajax.delete") }}';
            if (numInvoices > 0) {
                jQuery.ajax({
                    url: url,
                    data: {num_invoices: numInvoices},
                    method: 'POST',
                    success: function (data, textstatus, jqHdr) {
                        $('#invoice' + index).remove();
                        numInvoices++;
                    }
                });
            }

        }
    </script>
@endsection