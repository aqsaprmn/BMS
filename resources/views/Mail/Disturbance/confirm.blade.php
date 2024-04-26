<x-mail::message>
    # Konfirmasi Data Gangguan Baru

    Dear {{ $for->name }} - {{ $for->role }},


    Data gangguan baru dengan nomor "{{ $interaction->disturbance_no }}" atas pelanggan
    "{{ $interaction->internet_no }} -
    {{ $interaction->activation->customer->customer_name }}", terjadi pada
    {{ date('d-m-Y', strtotime($interaction->disturbance_date)) }}, dengan
    keluhan sebagai berikut:

    "{{ $interaction->complaint }}"

    telah dikonfirmasi kebenaran datanya.

    Dengan itu data gangguan ini sudah siap untuk dilanjutkan untuk melakukan proses "Pelaksanaan Pekerjaan Perbaikan".


    Thanks & Regards,

    {{ $sender->name }} - {{ $sender->role }}
</x-mail::message>
