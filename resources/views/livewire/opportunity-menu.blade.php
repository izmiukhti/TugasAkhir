<div>
    @if ($isHome)
        <div class="section-header">
            <h1>Opportunity Management</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Opportunity List</h2>
            <p class="section-lead">In this section you can manage opportunity data such as adding, changing and deleting.</p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="search" placeholder="Search Opportunity" wire:model.live.debounce.250ms="search">
                        </div>
                        <div class="col-4 text-right">
                            <button wire:click.prevent="create()" class="btn btn-primary">Create</button>
                        </div>
                    </div>
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
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h4>Fullstack Developer - Internship</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th id="open-registration">Open Registration</th>
                                        <th id="open-date">20 December 2024</th>
                                    </tr>
                                    <tr>
                                        <th id="close-registration">Close Registration</th>
                                        <th id="close-date">25 December 2024</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="row">
                                <div class="col-6 text-center">
                                    <div class="alert alert-light">
                                        <p><strong>Jumlah Click</strong></p>
                                        <h4>1024</h4>
                                    </div>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="alert alert-light">
                                        <p><strong>Jumlah Applicant</strong></p>
                                        <h4>185</h4>
                                    </div>
                                </div>
                            </div>
                            <p>Created Date : 14 Agustus 2024</p>
                            <a href="#" class="btn btn-block btn-icon icon-left btn-outline-info"><i class="fas fa-info-circle"></i> Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h4>IT Technical Writer - Internship</h4>
                        </div>
                            <div class="card-body">
                            
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
