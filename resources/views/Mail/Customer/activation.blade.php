<x-mail::message>
    # Aktivasi Pelanggan

    Dear {{ $for->name }} - {{ $for->role }},


    Data pelanggan atas nama {{ $interaction->customer_name }} dengan tipe pelanggan {{ $interaction->type }} telah
    dilakukan proses aktivasi.

    Dengan itu data pelanggan ini sudah berjalan dalam penggunaan layanannya dan teraktivasi.


    Thanks & Regards,

    {{ $sender->name }} - {{ $sender->role }}
</x-mail::message>
