<x-mail::message>
    # Penentuan Selesai Pekerjaan

    Dear {{ $for->name }} - {{ $for->role }},


    Data gangguan dengan nomor "{{ $interaction->disturbance_no }}" atas pelanggan "{{ $interaction->internet_no }} -
    {{ $interaction->activation->customer->customer_name }}", terjadi pada
    {{ date('d-m-Y', strtotime($interaction->disturbance_date)) }}, dengan keluhan
    sebagai berikut:

    "{{ $interaction->complaint }}"

    telah menentukan selesai pelaksanaan pekerjaan perbaikan atas gangguan tersebut.

    Dengan itu data ganngguan ini sudah siap untuk dilanjutkan untuk melakukan proses "Dinyatakan Selesai".


    Thanks & Regards,

    {{ $sender->name }} - {{ $sender->role }}
</x-mail::message>
