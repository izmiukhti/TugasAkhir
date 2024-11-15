<div>
    <select wire:model="selectedOpportunityId">
        <option value="">Pilih Opportunity</option>
        @foreach ($opportunities as $opportunity)
            <option value="{{ $opportunity->id }}">{{ $opportunity->title }}</option>
        @endforeach
    </select>

    <h2>Daftar Pelamar</h2>
    @if ($applicants->isEmpty())
        <p>No applicants found.</p>
    @else
        @foreach ($applicants as $applicant)
            <div>
                <h5>{{ $applicant->name }}</h5>
                <p>Email: {{ $applicant->email }}</p>
                <p>Opportunity: {{ $applicant->opportunity->title }}</p>
                <p>Domisili: {{ $applicant->domicile_address }}</p>
            </div>
        @endforeach
    @endif



    <!-- Form untuk Detail dan Edit Applicant -->
    @if ($selectedApplicant)
        <h3>Detail Applicant</h3>
        <form wire:submit.prevent="save">
            <input type="hidden" wire:model="selectedApplicant.id">

            <label>Opportunity ID</label>
            <input type="text" wire:model="opportunity_id">

            <label>Nama</label>
            <input type="text" wire:model="name">

            <label>Email</label>
            <input type="email" wire:model="email">

            <label>Nomor Telepon</label>
            <input type="text" wire:model="phone_number">

            <label>Gender ID</label>
            <input type="number" wire:model="gender_id">

            <label>Tanggal Lahir</label>
            <input type="date" wire:model="birth_date">

            <label>Alamat Domisili</label>
            <input type="text" wire:model="domicile_address">

            <label>Religion ID</label>
            <input type="number" wire:model="religion_id">

            <label>Marital ID</label>
            <input type="number" wire:model="marital_id">

            <label>Education ID</label>
            <input type="number" wire:model="education_id">

            <label>Institution Pendidikan</label>
            <input type="text" wire:model="education_institution">

            <label>Jurusan</label>
            <input type="text" wire:model="majority">

            <label>GPA</label>
            <input type="text" wire:model="gpa">

            <label>Status Kelulusan</label>
            <input type="text" wire:model="graduate_status">

            <label>Tahun Kelulusan</label>
            <input type="text" wire:model="graduate_year">

            <label>Informasi dari</label>
            <input type="text" wire:model="information_from">

            <label>Link Portfolio</label>
            <input type="url" wire:model="portfolio_link">

            <label>CV File</label>
            <input type="text" wire:model="cv_file">

            <button type="submit">Simpan</button>
            <button type="button" wire:click="resetFields">Batal</button>
        </form>
    @endif
</div>
