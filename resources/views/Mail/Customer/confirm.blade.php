<x-mail::message>
    # Konfirmasi Data Pelanggan Baru

    Dear {{ $for->name }} - {{ $for->role }},


    Data pelanggan baru atas nama {{ $interaction->customer_name }} dengan tipe pelanggan {{ $interaction->type }} telah
    dikonfirmasi kebenaran datanya.

    Dengan itu data pelanggan ini sudah siap untuk dilanjutkan untuk melakukan proses "Penjadwalan Pemasangan".


    Thanks & Regards,

    {{ $sender->name }} - {{ $sender->role }}
</x-mail::message>
