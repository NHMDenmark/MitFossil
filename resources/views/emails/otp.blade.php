<x-mail::message>
    <b>@lang('Hej!')</b>
    <br><br>
    @lang('Velkommen til MitFossil!')
    <br><br>
    @lang('Tak for at oprette dig som bruger på MitFossil og slutte dig til fællesskabet. Det er vigtigt at huske, at MitFossil kun er til indsendelse og identifikation af fossiler fundet i Danmark.')
    <br><br>
    @lang('Du mangler kun to skridt for at være helt klar. Bekræft din bruger ved at indtaste nedenstående adgangskode inde på MitFossil. Herefter skal du besvare nogle sikkerhedsspørgsmål og lave din egen adgangskode, og så er du klar!')

    <x-mail::button :url="$url" :color="'primary'">
        {{$otp}}
    </x-mail::button>

    @lang('Rigtig god fornøjelse!') {{ config('app.name') }}
</x-mail::message>
