<div class="px-4 py-2 mt-4">

    @push('myjs')
        <script>
            function printdiv() {
            var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
            var footer_str = '</body></html>';
            var new_str = document.getElementById('print').innerHTML;
            var div_style_head = '<div style="height: 188px; width: 287px; margin-left: 40px; margin-top: 20px">';
            var div_style_foot = '</div>';
            var old_str = document.body.innerHTML;
            document.body.innerHTML = header_str + div_style_head  + new_str + div_style_foot  + footer_str;
            window.print();
            document.body.innerHTML = old_str;
            return false;
            }
        </script>
    @endpush


    <!--
    <div class="flex gap-2">
        <x-inputs.number wire:model="barcode" placeholder="BarCode" />
        <x-button outline label="Buscar" wire:click="search" />
    </div>
    -->

    <!-- search select by API -->
    <div class="flex gap-2">
        <x-select
            wire:model="barcode"
            placeholder="Producto"
            :async-data="route('api.barcodes.index')"
            option-label="name"
            option-value="id"
        />
        <x-button outline label="Buscar" wire:click="search" />
    </div>

    @if ( $barcode != null )
    <div class="grid grid-cols-3 gap-4 mt-4 w-3/12">
        <div class="col-span-3">
            <x-input placeholder="Cantidad" wire:model="qty" />
        </div>
        <div>
            <x-input placeholder="UM" wire:model="um" />
        </div>
        <div>
            <button type="button" wire:click="up" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">UP</button>
        </div>
      </div>

    @endif


    <!-- print barcode -->
    @if ( $barcode != null )
        <div id="print" class="mt-4 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    
            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">STANDARD FOODS</h5>
            <div class="flex gap-2 justify-between">
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">{{ $printcode['name'] }}</h5>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">| {{ \Carbon\Carbon::now()->toDateString() }} |</h5>
            </div>
            <div class="flex gap-2 justify-between">
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Cantidad: {{ $qty }}</h5>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">| {{ $um }} |</h5>
            </div>
            <div class="items-center">
                <img class="h-12" src="data:image/png;base64, {{ DNS1D::getBarcodePNG( $printcode['code'] , 'C39') }} " alt="Barcode"> 
            </div>
            <div class="text-center mt-2">
                {{ $printcode['code'] }}
            </div>
        </div>
    @endif  

    @if ( $barcode != null )
        <button type="button" onclick="printdiv()" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Imprimir</button>
    @endif     
</div>
