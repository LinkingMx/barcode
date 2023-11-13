<div class="px-4 py-2 mt-4">

    @push('myjs')
        <script>
            function printdiv() {
            var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
            var footer_str = '</body></html>';
            var new_str = document.getElementById('print').innerHTML;
            var div_style_head = '<div style="height: 287px; width: 188px; margin-left: 40px; margin-top: 20px">';
            var div_style_foot = '</div>';
            var old_str = document.body.innerHTML;
            document.body.innerHTML = header_str + div_style_head  + new_str + div_style_foot  + footer_str;
            window.print();
            document.body.innerHTML = old_str;
            return false;
            }
        </script>
    @endpush
    <!--<h2 class="mb-2">Buscar codigo de Barras</h2>-->
    <div class="flex gap-2">
        <x-inputs.number wire:model="barcode" placeholder="BarCode" />
        <x-button outline label="Buscar" wire:click="search" />
    </div>

    <!-- print barcode -->
    @if ( $barcode != null )

        @if ( $printcode->isEmpty() )
            <p>No se encontró producto con ese coódigo</p>
            @else
            <div id="print" class="mt-4 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        
                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">STANDARD FOODS</h5>
                <div class="flex gap-2 justify-between">
                    <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">{{ $printcode[0]['name'] }}</h5>
                    <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">| {{ \Carbon\Carbon::now()->toDateString() }} |</h5>
                </div>
                <div class="items-center">
                    <img class="h-12" src="data:image/png;base64, {{ DNS1D::getBarcodePNG( $printcode[0]['code'] , 'C39') }} " alt="Barcode"> 
                </div>
            </div>
            <button onclick="printdiv()">Print</button>
        @endif
    @endif  
</div>
