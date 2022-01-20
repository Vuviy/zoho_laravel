
@if($errors->any())
    @foreach($errors->all() as $error)
        {{$error}}
    @endforeach
@endif
@if(session('access_token'))
    <form action="{{ route('add-deal') }}" method="post">
        @csrf
        <input type="hidden" value="{{session('access_token')}}" name="access_token">
        <h1>Create Deal:</h1>
        <div>
            <label for="Deal_Name">Deal Name</label>
            <input type="text" id ="client_secret" name="deal_name">
        </div>
        <div>
            <label for="Stage">Stage</label>
            <select name="stage" id="Stage">
                <option value="Qualification">Qualification</option>
                <option value="Needs Analysis">Needs Analysis</option>
                <option value="Value Proposition">Value Proposition</option>
                <option value="Identify Decision Makers">Identify Decision Makers</option>
                <option value="Proposal/Price Quote">Proposal/Price Quote</option>
                <option value="Negotiation/Review">Negotiation/Review</option>
                <option value="Closed Won">Closed Won</option>
                <option value="Closed Lost">Closed Lost</option>
                <option value="Closed-Lost to Competition">Closed-Lost to Competition</option>
            </select>
        </div>
        <div>
            <label for="Pipeline">Pipeline</label>
            <input type="text" id ="Pipeline" name="pipeline">
        </div>
        <h1>Create Task:</h1>
        <div>
            <label for="Subject">Subject</label>
            <select name="subject" id="Subject">
                <option value="Email">Email</option>
                <option value="Call">Call</option>
                <option value="Meeting">Meeting</option>
                <option value="Send Letter">Send Letter</option>
                <option value="Product Demo">Product Demo</option>
            </select>
        </div>

        <input type="submit">
    </form>
@endif

