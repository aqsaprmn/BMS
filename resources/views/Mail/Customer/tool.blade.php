<x-mail::message>
    # Penentuan Alat

    Dear {{ $for->name }} - {{ $for->role }},


    Data pelanggan baru atas nama {{ $interaction->customer_name }} dengan tipe pelanggan {{ $interaction->type }} telah
    dilakukan proses penentuan alat.

    Dengan itu data pelanggan ini sudah siap untuk dilanjutkan untuk melakukan proses "Aktivasi".


    Thanks & Regards,

    {{ $sender->name }} - {{ $sender->role }}
</x-mail::message>
