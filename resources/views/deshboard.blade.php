@extends("welcome")
@section("content")

    <div class="mt-3 mx-3">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <h4 class="card-body text-center fw-bold">Today sale report</h4>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2 class="card-body text-center">{{ $daily_sell_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <h4 class="card-body text-center fw-bold">Yesterday sale report</h4>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2 class="card-body text-center">{{ $yesterday_sell_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <h4 class="card-body text-center fw-bold">This month sale report</h4>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2 class="card-body text-center">{{ $monthly_sell_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <h4 class="card-body text-center fw-bold">Last month sale report</h4>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2 class="card-body text-center">{{ $prev_month_sell_count }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
