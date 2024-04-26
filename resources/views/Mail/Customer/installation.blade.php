<x-mail::message>
    # Penjadwalan Pemasangan

    Dear {{ $for->name }} - {{ $for->role }},


    Data pelanggan baru atas nama {{ $interaction->customer_name }} dengan tipe pelanggan {{ $interaction->type }} telah
    dilakukan proses penjadwalan pemasangan.

    Dengan itu data pelanggan ini sudah siap untuk dilanjutkan untuk melakukan proses "Penentuan Alat".


    Thanks & Regards,

    {{ $sender->name }} - {{ $sender->role }}
</x-mail::message>
