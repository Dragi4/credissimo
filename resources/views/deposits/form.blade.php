@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-success">
        <div>{{ Session::get('message') }}</div>
    </div>
@endif

@foreach ($clients as $client)
    <div>
        <h2>
            {{ $client->name }}
        </h2>
        @foreach ($client->accounts as $account)
        <div class="account">
            <form action="{{ URL::to("/deposits-add/" . $account->id) }}" method="post">
                @csrf
                <div class="caption">Account number</div>
                <div class="account-info">
                    {{ $account->bank_account }}
                </div>
                <div class="caption">Deposit amount</div>
                <div class="account-info">
                    {{ number_format($account->deposits->sum('deposit'), 2) }}
                </div>
                <div class="caption">Make deposit</div>
                <div class="account-info">
                    <input type="text" name="deposit_amount">
                </div>
                <div class="account-info" style="text-align: left;">BGN</div>
                <div class="account-info">
                    <button>Deposit</button>
                </div>
            </form>
        </div>
        @endforeach
    </div>
@endforeach