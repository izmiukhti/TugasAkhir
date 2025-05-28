<!DOCTYPE html>
<html>

<head>
    <title>Hasil CV Screening</title>
</head>

<body>
    <h2>Halo {{ $applicant->fullname }},</h2>

    {{-- Logika ini akan bekerja dengan baik karena $result sekarang akan menjadi 'lolos' jika decission_id adalah 2 atau 3 --}}
    @if ($result === 'lolos')
        <p>Selamat! Kamu dinyatakan <strong>lolos</strong> dalam tahap <strong>CV Screening</strong>.</p>
        <p>Kami akan menghubungi kamu untuk tahapan selanjutnya.</p>
    @else
        <p>Terima kasih telah melamar. Setelah meninjau CV kamu, kami memutuskan kamu <strong>belum lolos</strong> pada
            tahap ini.</p>
        <p>Semangat terus, dan semoga sukses untuk kesempatan berikutnya!</p>
    @endif

    <br>
    <p>Salam,</p>
    <p>Tim HRD CareerApp</p>
</body>

</html>
