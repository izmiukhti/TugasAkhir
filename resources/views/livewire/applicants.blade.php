<div>
    @if ($isHome)
        <div class="section-header">
            <h1>Applicant Management</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Applicant List</h2>
            <p class="section-lead">In this section you can manage Applicants data such as adding, changing and deleting.
            </p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <!-- Kosong -->
                        </div>
                        <div class="col-4">
                            <input wire:model.live.debounce.250ms="search" type="text" class="form-control"
                                id="search" placeholder="Search Applicant">
                        </div>
                    </div>
                    <br>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                {{ session('success') }}
                            </div>
                        </div>
                        <br>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Marital</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicants as $index => $applicant)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $applicant->name }}</td>
                                    <td>{{ $applicant->email }}</td>
                                    <td>{{ $applicant->phone_number }}</td>
                                    <td>{{ $applicant->gender_id }}</td>
                                    <td>{{ $applicant->marital_id }}</td>
                                    <td>
                                        <div class="buttons">
                                            <a href="#" wire:click.prevent="detail({{ $applicant->id }})"
                                                class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $applicants->links() }}
                </div>
            </div>
        </div>
    @endif
    @if ($isDetail)
        <div class="section-header">
            <h1>Detail Applicant</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">applicant Detail</h2>
            <p class="section-lead">In this section you can show detail of applicant.</p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
