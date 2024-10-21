<div>
    @if ($isHome)
        <div class="section-header">
            <h1>Opportunity Management</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Opportunity List</h2>
            <p class="section-lead">In this section you can manage opportunity data such as adding, changing and
                deleting.</p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="search" placeholder="Search Opportunity"
                                wire:model.live.debounce.250ms="search">
                        </div>
                        <div class="col-4 text-right">
                            <button wire:click.prevent="create()" class="btn btn-primary">Create</button>
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
                    @endif
                </div>
            </div>
            <div class="row">
                @foreach ($opportunities as $item)
                    <div class="col-4">
                        <div class="card card-info">
                            <div class="card-header">
                                <h4>{{ $item->name }}</h4>
                            </div>
                            <div class="card-body">
                                <p>Range Application : {{ $item->start_date }} - {{ $item->end_date }}</p>
                                <p>Created Date : {{ $item->created_at }}</p>
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <div class="alert alert-light">
                                            <p><strong>Jumlah Click</strong></p>
                                            <h4>{{ $item->clicked }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="alert alert-light">
                                            <p><strong>Jumlah Applicant</strong></p>
                                            <h4>0</h4>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" wire:click="detail('{{ $item->id }}')"
                                    class="btn btn-block btn-icon icon-left btn-outline-info"><i
                                        class="fas fa-info-circle"></i> Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card">
                <div class="card-body">
                    {{ $opportunities->links() }}
                </div>
            </div>
        </div>
    @endif
    @if ($isDetail)
        <div class="section-header">
            <h1>Detail Opportunity</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Opportunity Detail</h2>
            <p class="section-lead">In this section you can show detail of Opportunity.</p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{$opportunity->name}}</h3>
                            <p>{{$opportunity->location}}, {{$opportunity->schema->name}} | Created Date : {{$opportunity->created_at}} <br> Division : {{$opportunity->division->name}} | Category : {{$opportunity->category->name}} <br>Open Date : {{$opportunity->start_date}} | Close Date : {{$opportunity->end_date}}</p>
                            <p></p>
                            {{-- <div class="badges">
                                <span class="badge badge-success">Aktif</span>
                            </div> --}}
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <div class="alert alert-light">
                                        <p><strong>Jumlah Click</strong></p>
                                        <h4>{{ $opportunity->clicked }}</h4>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <div class="alert alert-light">
                                        <p><strong>Jumlah Applicant</strong></p>
                                        <h4>0</h4>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <div class="alert alert-light">
                                        <p><strong>Jumlah Quota</strong></p>
                                        <h4>{{ $opportunity->quota }}</h4>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <a href="#" wire:click.prevent="home()" class="btn btn-sm btn-block btn-outline-primary icon-left"><i class="fas fa-arrow-left"></i> Back</a>
                                    <a href="#" wire:click.prevent="information('{{$opportunity->id}}')" class="btn btn-sm btn-block btn-outline-dark icon-left"><i class="fas fa-info-circle"></i> Detail</a>
                                    <a href="#" wire:click.prevent="update('{{$opportunity->id}}')" class="btn btn-sm btn-block btn-outline-warning icon-left"><i class="far fa-edit"></i> Update</a>
                                    <a href="#" wire:click.prevent="delete('{{$opportunity->id}}')" class="btn btn-sm btn-block btn-outline-danger icon-left"><i class="fas fa-times"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($isCreate)
        <div class="section-header">
            <h1>Create Opportunity</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create Opportunity</h2>
            <p class="section-lead">In this section you can create Opportunity.</p>
            <div class="card">
                <form wire:submit.prevent="store">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea wire:model="description" style="height: 150px" class="form-control" id="description"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="job_description">Job Description</label>
                            <textarea wire:model="job_description" style="height: 150px" class="form-control" id="job_description"></textarea>
                            @error('job_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="job_requirement">Job Requirement</label>
                            <textarea wire:model="job_requirement" style="height: 150px" class="form-control" id="job_requirement"></textarea>
                            @error('job_requirement')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quotas">Quotas</label>
                                    <input type="number" class="form-control" id="quotas" wire:model="quotas">
                                    @error('quotas')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" wire:model="location">
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Division</label>
                                    <select wire:model="division" class="form-control select2">
                                        <option value="">Pilih Division</option> <!-- Opsi default kosong -->
                                        @foreach ($divisions as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('division')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select wire:model="category" class="form-control select2">
                                        <option value="">Pilih Kategori</option> <!-- Opsi default kosong -->
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Schema</label>
                                    <select wire:model="schema" class="form-control select2">
                                        <option value="">Pilih Schema</option> <!-- Opsi default kosong -->
                                        @foreach ($schemas as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('schema')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="open_date">Open Registration Date</label>
                                    <input type="date" class="form-control" id="open_date"
                                        wire:model="open_date">
                                    @error('open_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="close_date">Close Registration Date</label>
                                    <input type="date" class="form-control" id="close_date"
                                        wire:model="close_date">
                                    @error('close_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="#" wire:click="home()" class="btn btn-primary">Back</a>
                            <button class="submit btn btn-success">Save</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($isInformation)
        <div class="section-header">
            <h1>Detail Opportunity Information</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detail Opportunity Information</h2>
            <p class="section-lead">In this section you can show detail Opportunity.</p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2"><a href="#" wire:click="detail('{{ $opportunity->id }}')"
                                class="btn btn-sm btn-block btn-outline-primary icon-left"><i
                                    class="fas fa-arrow-left"></i> Back</a></div>
                    </div>
                    <br>
                    <h5>General Information</h5>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Opportunity Name</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $opportunity->name }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Opportunity Description</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <textarea class="form-control" style="height: 150px" disabled>{{ $opportunity->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Job Description</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <textarea class="form-control" style="height: 150px" disabled>{{ $opportunity->job_description }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Job Requirements</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <textarea class="form-control" style="height: 150px" disabled>{{ $opportunity->job_requirements }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Division</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    value="{{ $opportunity->division->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Category</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    value="{{ $opportunity->category->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Quota Opportunity</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{ $opportunity->quota }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Location Opportunity</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $opportunity->location }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Schema Opportunity</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $opportunity->schema->name }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Registration Period</strong></p>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <input type="date" class="form-control" value="{{ $opportunity->start_date }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <input type="date" class="form-control" value="{{ $opportunity->end_date }}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endif
    @if ($isUpdate)
        <div class="section-header">
            <h1>Update Opportunity Information</h1>
        </div>
        <form wire:submit.prevent="update">
        <div class="section-body">
            <h2 class="section-title">Update Opportunity Information</h2>
            <p class="section-lead">In this section you can update detail of Opportunity.</p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2"><a href="#" wire:click="detail('{{ $opportunity->id }}')"
                                class="btn btn-sm btn-block btn-outline-primary icon-left"><i
                                    class="fas fa-arrow-left"></i> Back</a></div>
                    </div>
                    <br>
                    <h5>General Information</h5>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Opportunity Name</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" wire:model="update_name">
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Opportunity Description</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <textarea wire:model="update_description" id="description" class="form-control" style="height: 150px"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Job Description</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <textarea wire:model="update_job_description" id="job_description" class="form-control" style="height: 150px"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Job Requirements</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <textarea wire:model="update_job_requirement" id="job_requirement" class="form-control" style="height: 150px"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Division</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    value="{{ $opportunity->division->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Category</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    value="{{ $opportunity->category->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Quota Opportunity</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{ $opportunity->quota }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Location Opportunity</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $opportunity->location }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Schema Opportunity</strong></p>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $opportunity->schema->name }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <p><strong>Registration Period</strong></p>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <input type="date" class="form-control" value="{{ $opportunity->start_date }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <input type="date" class="form-control" value="{{ $opportunity->end_date }}"
                                    disabled>
                            </div>
                            <div>
                                <button wire:click="save({{ $opportunity->id }})">Edit</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    @endif
</div>